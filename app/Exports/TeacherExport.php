<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Teacher;

class TeacherExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('livewire.pages.teacher.teacher-excel', [
            'teachers' => Teacher::all()
        ]);
    }
}