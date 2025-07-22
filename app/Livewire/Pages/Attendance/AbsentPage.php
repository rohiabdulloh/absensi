<?php

namespace App\Livewire\Pages\Attendance;

use Livewire\Component;
use Livewire\Attributes\On;
use DB;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Period;

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

    public function sendWhatsapp(){
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

    private function insertAttendance($students){    
        foreach($students as $student){
            $existing = Attendance::where('student_id', $student->id)
                ->whereDate('date', now()->toDateString())
                ->first();

            $attendanceData = [
                'student_id' => $student->id,
                'date'       => now()->toDateString(),
                'status'     => 'A',
                'year'       => $this->year,
            ];

            if (!$existing)  Attendance::create($attendanceData);
        }
        
        $this->dispatch('refresh')->to(AbsentTable::class);
    }
    
    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }


}
