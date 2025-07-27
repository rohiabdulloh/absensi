<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportPresentStudentExport implements FromView, ShouldAutoSize
{
    public $month, $student, $year, $datareport;

    public function __construct($month, $student, $year, $datareport){
        $this->month = $month;
        $this->student = $student;
        $this->year = $year;
        $this->datareport = $datareport;
    }

    public function view(): View
    {
        return view('livewire.pages.report.report-present-student-excel', [
            'month' => $this->month,
            'student' => $this->student,
            'year' => $this->year,
            'datareport' => $this->datareport,
        ]);
    }
}
