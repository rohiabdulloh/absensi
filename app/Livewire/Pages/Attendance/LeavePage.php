<?php

namespace App\Livewire\Pages\Attendance;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Classroom;
use App\Models\Period;

use Carbon\Carbon;

class LeavePage extends Component
{
    public $year;

    public function mount(){  
        $this->setYear();
    }

    public function render()
    {
        return view('livewire.pages.attendance.leave-page')->layout('layouts.app');
    }

    #[On('approve')]
    public function approve($id)
    {
        if(is_array($id)) $ids = $id;
        else $ids = [$id];

        foreach($ids as $id){
            $leave = Leave::find($id);
            $leave->status = "Disetujui";
            $leave->update();

            $startDate = Carbon::parse($leave->date_start);
            $endDate = Carbon::parse($leave->date_end);

            while ($startDate->lte($endDate)) {
                $existing = Attendance::where('student_id', $leave->student_id)
                    ->whereDate('date', $startDate)
                    ->first();

                 $attendanceData = [
                    'student_id' => $leave->student_id,
                    'date'       => $startDate->toDateString(),
                    'status'     => $leave->type,
                    'year'       => $this->year,
                    'leave_id'   => $leave->id,
                ];

                if (!$existing)  Attendance::create($attendanceData);
                else  $existing->update($attendanceData);

                $startDate->addDay();
            }
        }
        
        $this->dispatch('refresh')->to(LeaveTable::class);
    }

    #[On('reject')]
    public function reject($id)
    {
        if(is_array($id)) $ids = $id;
        else $ids = [$id];

        foreach($ids as $id){
            $leave = Leave::find($id);
            $leave->status = "Ditolak";
            $leave->update();

            $startDate = Carbon::parse($leave->date_start);
            $endDate = Carbon::parse($leave->date_end);

            while ($startDate->lte($endDate)) {
                $existing = Attendance::where('student_id', $leave->student_id)
                    ->whereDate('date', $startDate)
                    ->first();

                 $attendanceData = [
                    'student_id' => $leave->student_id,
                    'date'       => $startDate->toDateString(),
                    'status'     => 'A',
                    'year'       => $this->year,
                    'leave_id'   => $leave->id,
                ];

                if (!$existing)  Attendance::create($attendanceData);
                else  $existing->update($attendanceData);

                $startDate->addDay();
            }
        }

        $this->dispatch('refresh')->to(LeaveTable::class);
    }

    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }


}
