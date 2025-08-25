<?php

namespace App\Livewire\Pages\Attendance;

use Livewire\Component;
use Livewire\WithPagination;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Models\Attendance;
use App\Models\Setting;
class AttendanceMediaPage extends Component
{
    use WithPagination;

    public $selectedDate;
    public $absentType;
    public $idDelete;
    public $deleteMessage;
    public $canDelete = false;

    public function mount()
    {
        $this->absentType = 'checkin';
        $this->selectedDate = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.pages.attendance.attendance-media-page', [
            'attendances' => $this->getAttendances()->paginate(12),
        ])->layout('layouts.app');
    }

    public function getAttendances()
    {
        if($this->absentType == 'checkin'){
            return Attendance::with('student')
                ->where('date', $this->selectedDate)
                ->whereNotNull('image_in')
                ->where('image_in', '!=', '')
                ->orderBy('student_id');
        }else{
            return Attendance::with('student')
                ->where('date', $this->selectedDate)
                ->whereNotNull('image_out')
                ->where('image_out', '!=', '')
                ->orderBy('student_id');
        }
    }

    public function openConfirm($id){
        $this->idDelete = $id;
        $this->deleteMessage = "Apakah yakin akan menghapus foto?";
        $this->dispatch('open-confirm');
    }

    public function openConfirmAll(){
        $this->deleteMessage = "Apakah yakin akan menghapus semua foto?";
        $this->dispatch('open-confirm');
    }

    public function delete(){
        if($this->idDelete) $this->deletePhoto($this->idDelete);
        else $this->deleteAllPhoto();
    }

    public function deletePhoto($attendanceId)
    {
        $attendance = Attendance::find($attendanceId);
        $photo = $this->absentType=='checkin' ? $attendance->image_in : $attendance->image_out;
        
        if ($attendance && $photo) {
            if (Storage::disk('public')->exists('selfies/'.$photo)) {
                Storage::disk('public')->delete('selfies/'.$photo);
            }

            if($this->absentType=='checkin') $attendance->image_in = null;
            else $attendance->image_out = null;
            $attendance->save();

            $this->idDelete = null;
            $this->dispatch('show-message', msg: 'Foto berhasil dihapus');
        }
    }

    public function deleteAllPhoto()
    {
        $attendances = $this->getAttendances()->get();

        $dataCount = 0;
        foreach($attendances as $attendance){
            $photo = $this->absentType=='checkin' ? $attendance->image_in : $attendance->image_out;
            
            if ($attendance && $photo) {
                if (Storage::disk('public')->exists('selfies/'.$photo)) {
                    Storage::disk('public')->delete('selfies/'.$photo);
            
                    $dataCount++;
                }

                if($this->absentType=='checkin') $attendance->image_in = null;
                else $attendance->image_out = null;
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

    public function updatedSelectedDate(){
        $limit = Setting::getValue('delete_image_limit');

        if (!$this->selectedDate || !$limit) {
            $this->canDelete = false;
            return;
        }

        $selectedDate = Carbon::parse($this->selectedDate);
        $now = Carbon::now();

        $diffInDays = $now->diffInDays($selectedDate, false);
        
        $this->canDelete = $diffInDays < -$limit;
    }
}
