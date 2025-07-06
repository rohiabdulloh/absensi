<?php

namespace App\Livewire\Pages\Classroom;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Classroom;

class ClassroomPage extends Component
{
    public $idDelete;
    public $isEdit = false;

    // Data untuk form    
    public $id;   
    public $grade; 
    public $name;
    public $grades = [];

    public function mount(){
        $this->grades = [1=>'X',2=>'XI',3=>'XII'];
    }

    public function render()
    {
        return view('livewire.pages.classroom.classroom-page')->layout('layouts.app');
    }

    // Mengambil data edit ketika tombol edit diklik
    #[On('edit')]
    public function edit($id)
    {
        $classroom = Classroom::find($id);
        $this->isEdit = true;
        $this->fill([
            "id" => $classroom->id,
            "grade" => $classroom->grade,
            "name" => $classroom->name,
        ]);
        $this->dispatch('open-modal');
    }

    // Menyimpan data form input/edit
    public function save()
    {
        // Menerapkan validasi data
        $this->validate([
            'grade' => 'required',
            'name'  => 'required',
        ]);

        // Menyimpan data sesuai dengan status form (input/edit)
        if ($this->isEdit) {
            $classroom = Classroom::find($this->id);
        } else {
            $classroom = new Classroom;
        }

        $classroom->grade = $this->grade;
        $classroom->name  = $this->name;

        if ($this->isEdit) {
            $classroom->update();
        } else {
            $classroom->save();
        }

        $this->isEdit = false;   
        // Merefresh tabel, menutup modal, menampilkan alert dan mereset form
        $this->dispatch('refresh')->to(ClassroomTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data berhasil disimpan');   
        $this->resetForm();
    }

    // Menyimpan id yang akan dihapus
    #[On('confirm')]
    public function confirm($id)
    {
        $this->idDelete = $id;
    }

    // Menghapus data sesuai id tersimpan
    public function delete()
    {
        $classroom = Classroom::find($this->idDelete);
        if ($classroom) {
            $classroom->delete();
            $this->dispatch('refresh')->to(ClassroomTable::class);
            $this->dispatch('show-message', msg: 'Data berhasil dihapus');
        }
    }

    // Mereset form
    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}
