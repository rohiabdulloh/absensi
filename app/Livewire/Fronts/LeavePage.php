<?php
namespace App\Livewire\Fronts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

use App\Models\Leave;
use App\Models\Student;

class LeavePage extends Component
{
    use WithFileUploads;

    public $idDelete;
    public $isEdit = false;
    
    // Data untuk form    
    public $id;   
    public $student_id; 
    public $date;
    public $date_start;
    public $date_end;
    public $type;
    public $description;
    public $types = ['S'=> 'Sakit', 'I' => 'Izin'];

    public $photo; 
    public $filePhoto;

    public $leaves = [];

    public function mount()
    {
        // Ambil student_id dari user yang login
        $this->student_id = Auth::user()->student->id;
    }

    public function render()
    {
        $this->leaves = Leave::where('student_id', $this->student_id)
            ->orderBy('date', 'desc')
            ->get();

        return view('livewire.fronts.leave-page')->layout('layouts.app');
    }

    // Mengambil data edit ketika tombol edit diklik
    public function edit($id)
    {
        $leave = Leave::find($id);
        $this->isEdit = true;
        $this->fill([
            "id" => $leave->id,
            "student_id" => $leave->student_id,
            "date" => $leave->date,
            "date_start" => $leave->date_start,
            "date_end" => $leave->date_end,
            "type" => $leave->type,
            "description" => $leave->description,
            "photo" => $leave->attachment,
        ]);
        $this->dispatch('open-modal');
    }

    // Menyimpan data form input/edit
    public function save()
    {
        // Menerapkan validasi data
        $this->validate([
            'student_id' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'type' => 'required',
            'description' => 'required',
            'filePhoto' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:1024',
        ]);

        if($this->filePhoto){
            $namafile = time()."_".$this->filePhoto
                 ->getClientOriginalName();
            $this->filePhoto->storeAs('/leave', $namafile, 'public');
         }else{
            $namafile = null;
         }

        // Menyimpan data sesuai dengan status form (input/edit)
        if ($this->isEdit) {
            $leave = Leave::find($this->id);
        } else {
            $leave = new Leave;
        }

        $leave->student_id = $this->student_id;
        $leave->date = date('Y-m-d');
        $leave->date_start = $this->date_start;
        $leave->date_end = $this->date_end;
        $leave->type = $this->type;
        $leave->description = $this->description;

        if($namafile) $leave->attachment = $namafile; 

        if ($this->isEdit) {
            $leave->update();
        } else {
            $leave->save();
        }

        $this->isEdit = false;
        
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Pengajuan tidak masuk berhasil disimpan');
        $this->resetForm();
    }

    // Menyimpan id yang akan dihapus
    public function confirm($id)
    {
        $this->idDelete = $id;
    }

    // Menghapus data sesuai id tersimpan
    public function delete()
    {
        $leave = Leave::find($this->idDelete);
        if ($leave) {
            $leave->delete();
            $this->dispatch('show-message', msg: 'Pengajuan tidak masuk berhasil dihapus');
        }
    }

    // Mereset form
    public function resetForm()
    {
        $this->resetValidation();
        $this->resetExcept(['leaves', 'student_id']); 
    }
}
