<?php

namespace App\Livewire\Pages\Student;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

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

    public $file_import;

    public $classrooms = [];
    public $periods = [];

    public function render()
    {
        $this->classrooms = Classrooms::all();
        $this->periods = Periods::all();
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

        $user = null;

        if ($student->user_id) {
            $user = User::find($student->user_id);
        }

        if (!$user) {
            $username = $this->nis;
            $user = User::where('username', $username)->first();

            if (!$user) {
                $user = User::create([
                    'username' => $username,
                    'name' => $this->name,
                    'email' => $username . '@example.com', 
                    'password' => Hash::make('password123'),
                ]);
            }
        }

        // Set user_id ke student
        $student->user_id = $user->id;
        $student->nis = $this->nis;
        $student->name = $this->name;
        $student->gender = $this->gender;
        $student->year_entry = $this->year_entry;

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
        return Excel::download($export, 'Data_Students.xlsx');
    }

    // Export PDF
    public function exportPDF()
    {
        $students = Student::all();
        $pdf = PDF::loadView('livewire.pages.student.student-pdf', compact('students'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Data_Students.pdf');
    }

    // Download Format Excel
    public function downloadFormat()
    {
        $format = new StudentFormat();
        return Excel::download($format, 'Format_Data_Students.xlsx');
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
