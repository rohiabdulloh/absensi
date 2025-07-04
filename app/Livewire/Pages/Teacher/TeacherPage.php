<?php

namespace App\Livewire\Pages\Teacher;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Teacher;
use App\Models\User;

use App\Imports\TeacherImport;
use App\Exports\TeacherExport;
use App\Exports\TeacherFormat;
use Maatwebsite\Excel\Facades\Excel;

class TeacherPage extends Component
{
    use WithFileUploads;

    public $idDelete;
    public $isEdit = false;

    // Form data
    public $id;
    public $user_id;
    public $nip;
    public $name;

    public function render()
    {
        return view('livewire.pages.teacher.teacher-page')->layout('layouts.app');
    }

    #[On('edit')]
    public function edit($id)
    {
        $teacher = Teacher::find($id);
        $this->isEdit = true;
        $this->fill([
            'id' => $teacher->id,
            'user_id' => $teacher->user_id,
            'nip' => $teacher->nip,
            'name' => $teacher->name,
        ]);
        $this->dispatch('open-modal');
    }

    public function save()
    {
        $this->validate([
            'nip' => 'required|unique:teachers,nip,' . $this->id,
            'name' => 'required|unique:teachers,name,' . $this->id,
        ]);

        if ($this->isEdit) {
            $teacher = Teacher::find($this->id);
        } else {
            $teacher = new Teacher();
        }

        // Jika data baru atau belum ada user_id, buat user baru
        if (!$teacher->user_id) {
            $user = User::firstOrCreate(
                ['name' => $this->name],
                [
                    'email' => strtolower(str_replace(' ', '', $this->name)) . '@example.com', 
                    'password' => bcrypt('password')
                ]
            );
            $teacher->user_id = $user->id;
        }

        $teacher->nip = $this->nip;
        $teacher->name = $this->name;
        $teacher->save();

        $this->isEdit = false;
        $this->dispatch('refresh')->to(TeacherTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data teacher berhasil disimpan');
        $this->resetForm();
    }

    #[On('confirm')]
    public function confirm($id)
    {
        $this->idDelete = $id;
    }

    public function delete()
    {
        $teacher = Teacher::find($this->idDelete);
        if ($teacher) {
            $teacher->delete();
            $this->dispatch('refresh')->to(TeacherTable::class);
            $this->dispatch('show-message', msg: 'Data teacher berhasil dihapus');
        }
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function exportExcel()
    {
        return Excel::download(new TeacherExport(), 'Data Teacher.xlsx');
    }

    public function downloadFormat()
    {
        return Excel::download(new TeacherFormat(), 'Format Data Teacher.xlsx');
    }

    public function importTeacher()
    {
        $this->validate(['file_import' => 'required|file|mimes:xlsx,csv']);
        $file = $this->file_import;

        Excel::import(new TeacherImport(), $file);

        $this->dispatch('refresh')->to(TeacherTable::class);
        $this->dispatch('close-import');
        $this->dispatch('show-message', msg: 'Data teacher berhasil di-import!');
        $this->resetForm();
    }
}
