<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportPresentExport implements FromView, ShouldAutoSize
{
    public $date_start, $date_end, $datareport;

    public function __construct($date_start, $date_end, $datareport){
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->datareport = $datareport;
    }

    public function view(): View
    {
        return view('livewire.pages.report.report-present-excel', [
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'datareport' => $this->datareport,
        ]);
    }
}
