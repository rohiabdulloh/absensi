<?php
namespace App\Livewire\Fronts;

use Livewire\Component;
use Carbon\Carbon;
use Auth;

use App\Models\User;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Period;
use App\Models\Setting;
use App\Models\Attendance;

class HomePage extends Component
{
    public $student;
    public $classroom;
    public $todayCheckIn = null;
    public $todayCheckOut = null;
    public $year;

    public $now;
    public $checkin_time;
    public $checkin_start;
    public $checkin_end;
    public $checkout_start;
    public $checkout_end;

    public $activator;
    public $isActive = false;
    public $presentScreen = 0;
    public $longitude;
    public $latitude;
    public $userLatitude;
    public $userLongitude;

    public $isLoading = true;

    public function mount()
    {
        $this->setYear();
        $this->checkin_time = Carbon::createFromFormat('H:i', Setting::getValue('checkin_time'))->format('H:i:s');
        $this->checkin_start = Carbon::createFromFormat('H:i', Setting::getValue('checkin_start'))->format('H:i:s');
        $this->checkin_end = Carbon::createFromFormat('H:i', Setting::getValue('checkin_end'))->format('H:i:s');
        $this->checkout_start = Carbon::createFromFormat('H:i', Setting::getValue('checkout_start'))->format('H:i:s');
        $this->checkout_end = Carbon::createFromFormat('H:i', Setting::getValue('checkout_end'))->format('H:i:s');

        $this->longitude = Setting::getValue('absen_longitude');
        $this->latitude = Setting::getValue('absen_latitude');
        $activator = Setting::getValue('button_activator');
        if($activator == 2){
            $this->isActive = $this->isLocalNetwork();
        }elseif($activator == 1){
            $this->activator = 1;
        }else{            
            $this->isActive = true;
        }
        
    }

    public function render()
    {
        $activePeriod = Period::where('is_active', 'Y')->first();
        $year = $activePeriod ? $activePeriod->year_start : date('Y');

        $student = Student::where('user_id', Auth::user()->id)->first();
        if($student){
            $this->student = $student;
            $this->classroom = StudentClass::with('classroom')
                ->where('student_id', $student->id)
                ->where('year', $year)
                ->first();

            // Ambil data attendance hari ini
            $today = now()->toDateString();
            $attendance = Attendance::where('student_id', $student->id)
                                    ->where('date', $today)
                                    ->first();

            if ($attendance) {
                $this->todayCheckIn = $attendance->check_in;
                $this->todayCheckOut = $attendance->check_out;
            } else {
                $this->todayCheckIn = null;
                $this->todayCheckOut = null;
            }
        }

        $this->now = now()->format('H:i:s');
       
        return view('livewire.fronts.home-page')->layout('layouts.app');
    }

    function isLocalNetwork()
    {
        $ip = request()->ip();
        return (
            preg_match('/^10\./', $ip) ||
            preg_match('/^192\.168\./', $ip) ||
            preg_match('/^172\.(1[6-9]|2[0-9]|3[0-1])\./', $ip) ||
            $ip === '127.0.0.1'
        );
    }

    public function checkIn()
    {
        $method = Setting::getValue('present_method');
        
        if($method==1) return $this->redirect('/siswa/selfie/checkin', navigate:true);
        elseif($method==2) return $this->redirect('/siswa/selfie/checkin', navigate:true);
        else $this->handleCheckIn(null, $this->year);
    }

    public static function handleCheckIn($filename, $year)
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        if (!$student) return;

        $now = Carbon::now();
        $today = $now->toDateString();

        // Cek apakah sudah presensi hari ini
        $attendance = Attendance::where('student_id', $student->id)->where('date', $today)->first();
        
        $checkinTime = Setting::getvalue('checkin_time') ?? "07:00";
        $checkinTimeCarbon = Carbon::parse($today . ' ' . $checkinTime);

        $status = $now->gt($checkinTimeCarbon) ? 'T' : 'H'; // T = Terlambat, H = Hadir

        Attendance::create([
            'student_id' => $student->id,
            'date'       => $today,
            'check_in'   => $now->format('H:i:s'),
            'check_out'  => null,
            'status'     => $status,
            'year'       => $year,
            'image_in'       => $filename,
        ]);
    }

    public function checkOut(){
        $method = Setting::getValue('present_method');
        if($method==1) return $this->redirect('/siswa/selfie/checkout', navigate:true);
        elseif($method==2) return $this->redirect('/siswa/selfie/checkout', navigate:true);
        else $this->dispatch('open-confirm');
    }


    public function confirm()
    {
        $this->handleCheckout(null, $this->year);
    }

    public static function handleCheckout($filename, $year)
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        if (!$student) return;

        $now = Carbon::now();
        $today = $now->toDateString();

        $attendance = Attendance::where('student_id', $student->id)->where('date', $today)->first();

        if ($attendance) {
            $attendance->check_out = $now->format('H:i:s');
            $attendance->image_out = $filename;
            $attendance->save();
        } else {
            // Belum ada record presensi sama sekali hari ini, tetap buat record baru dengan status TAM
            Attendance::create([
                'student_id' => $student->id,
                'date'       => $today,
                'check_in'   => null,
                'check_out'  => $now->format('H:i:s'),
                'status'     => 'TAM',
                'year'       => $year,
                'image_out'  => $filename,
            ]);

        }
        
    }

    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }

    public function updatedUserLatitude()
    {
        if($this->activator == 1) $this->checkLocation();
    }

    public function updatedUserLongitude()
    {
        if($this->activator == 1) $this->checkLocation();
    }

    public function checkLocation()
    {
        if ($this->userLatitude && $this->userLongitude) {
            $distance = $this->calculateDistance(
                $this->latitude,
                $this->longitude,
                $this->userLatitude,
                $this->userLongitude
            );

            $radius = Setting::getValue('absen_radius') ?? 50; 
            $this->isActive = $distance <= $radius;
            $this->isLoading = false;
        }
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // in meters
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $deltaLat = deg2rad($lat2 - $lat1);
        $deltaLon = deg2rad($lon2 - $lon1);

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos($lat1) * cos($lat2) *
             sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }
}
