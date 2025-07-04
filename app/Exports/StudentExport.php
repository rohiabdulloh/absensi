<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Student;

class StudentExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('livewire.pages.student.student-excel', [
            'students' => Student::all()
        ]);
    }
}
