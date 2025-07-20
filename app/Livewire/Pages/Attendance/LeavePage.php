<?php

namespace App\Livewire\Pages\Attendance;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Period;

class LeavePage extends Component
{
    public $year;

    public function mount(){  
        $this->setYear();
    }

    public function render()
    {
        return view('livewire.pages.leave.absent-page')->layout('layouts.app');
    }

    
    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }


}
