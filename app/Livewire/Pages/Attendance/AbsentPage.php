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
    public function sendMessageSelected($studentids){
        $students = Student::whereIn('id', $studentids)->get();

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
                if($this->sendWhatsapp($student->parrent_hp, $student->name)) $existing->update(['msg_sent'=>'Y']);
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
        
        $telepon  = str_replace('+62', '62', $hp);
       
        $curl = curl_init();
        $token = env('WABLAS_APIKEY');
        $secret_key = env('WABLAS_SECRETKEY');
        $data = [
            'phone' => $telepon,
            'message' => $message,
        ];
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
}
