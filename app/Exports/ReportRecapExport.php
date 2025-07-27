<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportRecapExport implements FromView, ShouldAutoSize
{
    public $date_start, $date_end, $classname, $year, $datareport;

    public function __construct($date_start, $date_end, $classname, $year, $datareport){
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->classname = $classname;
        $this->year = $year;
        $this->datareport = $datareport;
    }

    public function view(): View
    {
        return view('livewire.pages.report.report-absent-excel', [
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'classname' => $this->classname,
            'year' => $this->year,
            'datareport' => $this->datareport,
        ]);
    }
}
