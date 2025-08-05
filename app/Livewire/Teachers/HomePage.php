<?php
namespace App\Livewire\Teachers;

use Livewire\Component;
use Carbon\Carbon;
use Auth;

use App\Models\User;
use App\Models\Teacher;
use App\Models\TeacherClass;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Period;
use App\Models\Setting;
use App\Models\Attendance;

class HomePage extends Component
{
    public $teacher;
    public $classroom;
    public $year;
    public $presentCount = 0;
    public $absentCount = 0;

    public function render()
    {
        $activePeriod = Period::where('is_active', 'Y')->first();
        $year = $activePeriod ? $activePeriod->year_start : date('Y');

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        if($teacher){
            $this->teacher = $teacher;
            $teacherClass = TeacherClass::with('classroom')
            ->where('teacher_id', $teacher->id)
            ->where('year', $year)
            ->first();

            $this->classroom = $teacherClass ? $teacherClass->classroom : null;

            if ($teacherClass) {
                // Ambil semua siswa di kelas tersebut untuk tahun ajaran itu
                $studentIds = StudentClass::where('class_id', $teacherClass->class_id)
                    ->where('year', $year)
                    ->pluck('student_id');

                $today = Carbon::today();

                // Hitung jumlah hadir hari ini
                $this->presentCount = Attendance::whereIn('student_id', $studentIds)
                    ->whereDate('date', $today)
                    ->whereNotIn('status', ['A','I','S']) 
                    ->count();

                // Hitung jumlah absen (total siswa - yang hadir)
                $this->absentCount = $studentIds->count() - $this->presentCount;
            }
        }
       
        return view('livewire.teachers.home-page')->layout('layouts.app');
    }

}
