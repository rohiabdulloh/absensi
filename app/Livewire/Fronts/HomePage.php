<?php
namespace App\Livewire\Fronts;

use Livewire\Component;
use Carbon\Carbon;
use Auth;

use App\Models\User;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Period;

class HomePage extends Component
{
    public $student;
    public $classroom;
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
        }
       
        return view('livewire.fronts.home-page')->layout('layouts.app');
    }
}
