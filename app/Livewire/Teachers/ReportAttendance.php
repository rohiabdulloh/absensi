<?php
namespace App\Livewire\Teachers;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\TeacherClass;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Period;
use App\Models\Attendance;
use Auth;

class ReportAttendance extends Component
{
    public $yearStart;
    public $classroomName = '-';
    public $students = [];

    public function mount()
    {
        $this->yearStart = Period::where('is_active', 'Y')->first()?->year_start ?? now()->year;
        $this->loadData();
    }

    public function loadData()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        $teacherClass = TeacherClass::with('classroom')
            ->where('teacher_id', $teacher->id)
            ->where('year', $this->yearStart)
            ->first();

        if (!$teacherClass) return;

        $this->classroomName = $teacherClass->classroom->name ?? '-';

        $students = Student::whereIn('id', function ($query) use ($teacherClass) {
                $query->select('student_id')
                    ->from('student_classes')
                    ->where('class_id', $teacherClass->class_id)
                    ->where('year', $this->yearStart);
            })->orderBy('name')->get();

        $this->students = $students->map(function ($student) {
            $attendances = Attendance::where('student_id', $student->id)
                ->whereYear('date', $this->yearStart)
                ->selectRaw("
                    SUM(status = 'H') as total_h,
                    SUM(status = 'I') as total_i,
                    SUM(status = 'S') as total_s,
                    SUM(status = 'A') as total_a
                ")
                ->first();

            return [
                'nis' => $student->nis,
                'name' => $student->name,
                'h' => $attendances->total_h ?? 0,
                'i' => $attendances->total_i ?? 0,
                's' => $attendances->total_s ?? 0,
                'a' => $attendances->total_a ?? 0,
            ];
        });
    }

    public function render()
    {
        return view('livewire.teachers.report-page')->layout('layouts.app');
    }
}
