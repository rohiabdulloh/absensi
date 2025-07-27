<?php

namespace App\Livewire\Pages\Report;

use Livewire\Component;

use App\Models\Attendance;
use App\Models\Period;
use App\Models\Classroom;

use App\Exports\ReportPresentExport;
use Maatwebsite\Excel\Facades\Excel;   
use PDF;

class ReportPresentPage extends Component
{

    public $date, $year, $class;
    public $periods = [];
    public $classrooms = [];
    public $datareport = [];

    public function mount(){
        $this->date = now()->toDateString();
        $this->setYear();
    }

    public function render()
    {        
        $this->classrooms = Classroom::all();
        $this->periods = Period::all();

        $attendances = Attendance::select(
                'attendances.*', 
                'students.nis as student_nis', 
                'students.name as student_name', 
                'classrooms.name as class_name')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->join('student_classes', function ($join) {
                $join->on('students.id', '=', 'student_classes.student_id')
                    ->where('student_classes.year', $this->year);
            })
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->where('classrooms.id', $this->class)            
            ->whereDate('attendances.date', $this->date)
            ->get();

        $this->datareport = $attendances;
        return view('livewire.pages.report.report-present-page')->layout('layouts.app');
    }

    public function exportExcel($datareport)
    {
        $class = Classroom::find($this->class);
        $classname = $class->name ?? '-';
        $excel = new ReportPresentExport($this->date, $classname, $this->year, $datareport);
        return Excel::download($excel, 'Laporan Data Presensi.xlsx');
    }

    public function exportPDF($datareport)
    {
        $class = Classroom::find($this->class);
        $classname = $class->name ?? '-';
        $date = $this->date;
        $year = $this->year;

        $pdf = PDF::loadView('livewire.pages.report.report-present-pdf',  
            compact('datareport','date','classname', 'year'))
            ->setPaper('legal', 'landscape');        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Laporan Data Presensi.pdf');
    }
        
    public function updatedDate(){
        $this->setYear();
    }

    public function setYear(){
        $this->year = date('Y', strtotime($this->date));
    }
}
