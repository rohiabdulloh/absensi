<?php
namespace App\Livewire\Teachers;

use Livewire\Component;
use Carbon\Carbon;
use Auth;
use App\Models\Period;
use App\Models\Teacher;
use App\Models\TeacherClass;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Attendance;

class StudentAttendance extends Component
{
    public $students = [];
    public $attendanceRecords = [];
    public $classroomName = '';
    public $dateToday;

    public function mount()
    {
        $this->dateToday = Carbon::today()->format('Y-m-d');
        $this->loadData();
    }

    public function loadData()
    {
        $year = Period::where('is_active', 'Y')->first()?->year_start ?? now()->year;

        $teacher = Teacher::where('user_id', Auth::id())->first();
        $teacherClass = TeacherClass::with('classroom')
            ->where('teacher_id', $teacher->id)
            ->where('year', $year)
            ->first();

        if (!$teacherClass) return;

        $this->classroomName = $teacherClass->classroom->name ?? 'Tidak diketahui';

        // Ambil siswa dalam kelas yang diajar
        $this->students = Student::whereIn('id', function ($q) use ($teacherClass, $year) {
            $q->select('student_id')
              ->from('student_classes')
              ->where('class_id', $teacherClass->class_id)
              ->where('year', $year);
        })->orderBy('name')->get();

        // Ambil presensi hari ini
        $attendances = Attendance::whereIn('student_id', $this->students->pluck('id'))
            ->whereDate('date', $this->dateToday)
            ->get()
            ->keyBy('student_id');

        // Siapkan status
        foreach ($this->students as $student) {
            $this->attendanceRecords[$student->id] = $attendances[$student->id] ?? null;
        }
    }

    public function render()
    {
        return view('livewire.teachers.attendance-page')->layout('layouts.app');
    }
}
