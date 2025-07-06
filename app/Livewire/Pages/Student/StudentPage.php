<?php

namespace App\Livewire\Pages\Student;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Period;
use App\Models\User;

use App\Imports\StudentImport;
use App\Exports\StudentFormat;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class StudentPage extends Component
{
    use WithFileUploads;

    public $idDelete;
    public $isEdit = false;

    // Form data
    public $id;
    public $user_id;
    public $nis;
    public $name;
    public $gender;
    public $year_entry;
    public $parent_hp;

    public $file_import;

    public $classrooms = [];
    public $periods = [];

    public function mount(){
        $this->gender = 'M';
    }

    public function render()
    {
        $this->classrooms = Classroom::all();
        $this->periods = Period::all();
        return view('livewire.pages.student.student-page')->layout('layouts.app');
    }

    #[On('edit')]
    public function edit($id)
    {
        $student = Student::find($id);
        $this->isEdit = true;

        $this->fill([
            'id'         => $student->id,
            'nis'        => $student->nis,
            'name'       => $student->name,
            'gender'     => $student->gender,
            'year_entry' => $student->year_entry,
            'parent_hp'  => $student->parent_hp,
        ]);

        $this->dispatch('open-modal');
    }

    public function save()
    {
        $this->validate([
            'nis'        => 'required|unique:students,nis,' . $this->id,
            'name'       => 'required',
            'gender'     => 'required|in:M,F',
            'year_entry' => 'required|digits:4|integer',
        ]);

        if ($this->isEdit) {
            $student = Student::find($this->id);
        } else {
            $student = new Student();
        }        

        $user = User::firstOrCreate(
            ['username' => $this->nis],
            [
                'name' => $this->name, 
                'email' => $this->nis . '@gmail.com', 
                'password' => bcrypt($this->nis)
            ]
        );

        // Set user_id ke student
        $student->user_id = $user->id;
        $student->nis = $this->nis;
        $student->name = $this->name;
        $student->gender = $this->gender;
        $student->year_entry = $this->year_entry;
        $student->parent_hp = $this->parent_hp;

        if ($this->isEdit) {
            $student->update();
        } else {
            $student->save();
        }

        $this->isEdit = false;

        // Refresh table, close modal, show message, reset form
        $this->dispatch('refresh')->to(StudentTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data siswa berhasil disimpan');
        $this->resetForm();
    }


    #[On('confirm')]
    public function confirm($id)
    {
        $this->idDelete = $id;
    }

    public function delete()
    {
        $student = Student::find($this->idDelete);
        if ($student) {
            $student->delete();
            $this->dispatch('refresh')->to(StudentTable::class);
            $this->dispatch('show-message', msg: 'Data siswa berhasil dihapus');
        }
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    // Export Excel
    public function exportExcel()
    {
        $export = new StudentExport();
        return Excel::download($export, 'Data_Siswa.xlsx');
    }

    // Export PDF
    public function exportPDF()
    {
        $students = Student::all();
        $pdf = PDF::loadView('livewire.pages.student.student-pdf', compact('students'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Data_Siswa.pdf');
    }

    // Download Format Excel
    public function downloadFormat()
    {
        $format = new StudentFormat();
        return Excel::download($format, 'Format_Data_Siswa.xlsx');
    }

    // Import Excel
    public function importStudent()
    {
        $this->validate([
            'file_import' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new StudentImport(), $this->file_import);

        $this->dispatch('refresh')->to(StudentTable::class);
        $this->dispatch('close-import');
        $this->dispatch('show-message', msg: 'Data siswa berhasil diimport!');
        $this->resetForm();
    }
}
