<?php

namespace App\Livewire\Pages\Attendance;

use Livewire\Component;
use Livewire\Attributes\On;
use DB;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Period;
use App\Models\Setting;

class AbsentPage extends Component
{
    public $year;

    public function mount(){  
        $this->setYear();
    }

    public function render()
    {
        return view('livewire.pages.attendance.absent-page')->layout('layouts.app');
    }

    public function sendMessage(){
        $students = Student::select(
                'students.id',
                'students.nis as student_nis',
                'students.name as student_name',
            )
            ->join('student_classes', function ($join) {
                $join->on('students.id', '=', 'student_classes.student_id')
                    ->where('student_classes.year', $this->year);
            })
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('attendances')
                    ->whereColumn('attendances.student_id', 'students.id')
                    ->whereDate('attendances.date', now()->toDateString());
            })->get();

        $this->insertAttendance($students);
    }

    #[On('send-message')]
    public function sendMessageSelected($id){
        if(!is_array($id)) $id = [$id];
        $students = Student::whereIn('id', $id)->get();
   
        $this->insertAttendance($students);
    }

    private function insertAttendance($students){    
        foreach($students as $student){
            $existing = Attendance::where('student_id', $student->id)
                ->whereDate('date', now()->toDateString())
                ->first();


            if (!$existing){
                if($this->sendWhatsapp($student->parrent_hp, $student->name)) $msgsent = 'Y';
                else $msgsent = 'N';

                $attendanceData = [
                    'student_id' => $student->id,
                    'date'       => now()->toDateString(),
                    'status'     => 'A',
                    'year'       => $this->year,
                    'msg_sent'   => $msgsent,
                ];
                Attendance::create($attendanceData);
            }else{
                if($existing->msg_sent !== 'Y' && $this->sendWhatsapp($student->parent_hp, $student->name)){
                    $existing->update(['msg_sent'=>'Y']);
                }
            }
        }
        
        $this->dispatch('refresh')->to(AbsentTable::class);
    }
    
    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }

    private function sendWhatsapp($hp, $name){  
        $message = Setting::getValue('wa_message');
        $message = str_replace('[nama]', $name, $message);
        
        $telepon  = $this->formatNomorHP($hp);
       
        $curl = curl_init();
        $token = env('WABLAS_APIKEY');
        $secret_key = env('WABLAS_SECRETKEY');
        $data = [
            'phone' => $telepon,
            'message' => $message,
        ];
        dd($data);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token.$secret_key",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  "https://sby.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        
        $data = json_decode($result, true);
        
        if (!is_array($data) || !isset($data['status']) || $data['status'] !== true) {
            return false;
        }
        return true;
    }
    
    function formatNomorHP($nomor) {
        // Hilangkan spasi, tanda +, dan karakter non-digit
        $nomor = preg_replace('/\D/', '', $nomor);
    
        // Kalau diawali 0 → ganti jadi 62
        if (substr($nomor, 0, 1) === '0') {
            return '62' . substr($nomor, 1);
        }
        // Kalau diawali 62 → biarkan
        elseif (substr($nomor, 0, 2) === '62') {
            return $nomor;
        }
        // Kalau diawali 8 → tambahkan 62 di depan
        elseif (substr($nomor, 0, 1) === '8') {
            return '62' . $nomor;
        }
        // Selain itu → kembalikan apa adanya
        else {
            return $nomor;
        }
    }
}
