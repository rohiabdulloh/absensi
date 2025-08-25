<?php

namespace App\Livewire\Pages\Attendance;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AttendanceMediaPage extends Component
{
    use WithPagination;

    public $selectedDate;
    public $absentType;

    public function mount()
    {
        $this->absentType = 'checkin';
        $this->selectedDate = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.pages.attendance.attendance-media-page', [
            'attendances' => $this->attendances,
        ])->layout('layouts.app');
    }

    public function getAttendancesProperty()
    {
        if($this->absentType == 'checkin'){
            return Attendance::query()
                ->with('student')
                ->where('created_at', $this->selectedDate)
                ->whereNotNull('image_in')
                ->where('image_in', '!=', '')
                ->orderBy('student_id')
                ->paginate(12);
        }else{
            return Attendance::query()
                ->with('student')
                ->where('created_at', $this->selectedDate)
                ->whereNotNull('image_out')
                ->where('image_out', '!=', '')
                ->orderBy('student_id')
                ->paginate(12);
        }
    }

    public function deletePhoto($attendanceId)
    {
        $attendance = Attendance::find($attendanceId);
        $photo = $this->absentType=='chekin' ? $attendance->image_in : $attendance->image_out;
        if ($attendance && $photo) {
            if (Storage::disk('public')->exists($photo)) {
                Storage::disk('public')->delete($photo);
            }

            $attendance->photo = null;
            $attendance->save();

            $this->dispatch('show-message', msg: 'Foto berhasil dihapus');
        }
    }

    public function deleteAllPhoto()
    {
        $attendances = $this->attendances;

        $dataCount = 0;
        foreach($attendances as $attendance){
            $photo = $this->absentType=='chekin' ? $attendance->image_in : $attendance->image_out;
            if ($attendance && $photo) {
                if (Storage::disk('public')->exists($photo)) {
                    Storage::disk('public')->delete($photo);
                    $dataCount++;
                }

                $attendance->photo = null;
                $attendance->save();
            }
        }

        $this->dispatch('show-message', msg: $dataCount.' foto berhasil dihapus');
    }

    public function resetFilters()
    {
        $this->selectedDate = Carbon::now()->format('Y-m-d');
        $this->absentType = 'checkin';
    }

}
