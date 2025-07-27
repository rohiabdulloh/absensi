<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportLateExport implements FromView, ShouldAutoSize
{
    public $date, $classname, $year, $datareport;

    public function __construct($date, $classname, $year, $datareport){
        $this->date = $date;
        $this->classname = $classname;
        $this->year = $year;
        $this->datareport = $datareport;
    }

    public function view(): View
    {
        return view('livewire.pages.report.report-late-excel', [
            'date' => $this->date,
            'classname' => $this->classname,
            'year' => $this->year,
            'datareport' => $this->datareport,
        ]);
    }
}
