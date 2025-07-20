<?php

namespace App\Livewire\Pages\Attendance;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Period;

class AttendancePage extends Component
{
    public $class;
    public $year;
    public $classrooms = [];

    public function mount(){  
        $this->class = 0;
        $this->setYear();
    }

    public function render()
    {
        $this->classrooms = Classroom::all();
        return view('livewire.pages.attendance.attendance-page')->layout('layouts.app');
    }

    
    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }


}
