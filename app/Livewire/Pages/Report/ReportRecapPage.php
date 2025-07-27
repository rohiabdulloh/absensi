<?php

namespace App\Livewire\Pages\Report;

use Livewire\Component;
use DB;
use Carbon\Carbon;

use App\Models\Attendance;
use App\Models\Period;
use App\Models\Classroom;
use App\Models\Student;

use App\Exports\ReportPresentExport;
use Maatwebsite\Excel\Facades\Excel;   
use PDF;

class ReportRecapPage extends Component
{

    public $date_start, $date_end, $year, $class;
    public $periods = [];
    public $classrooms = [];
    public $datareport = [];

    public function mount(){
        $this->date_start = Carbon::now()->startOfMonth()->toDateString();
        $this->date_end = now()->toDateString();
        $this->setYear();
    }

    public function render()
    {        
        $this->classrooms = Classroom::all();
        $this->periods = Period::all();

        $students = Student::select(
                'students.id',
                'students.nis as student_nis',
                'students.name as student_name',
                'classrooms.name as class_name',
                DB::raw("SUM(CASE WHEN attendances.status = 'I' THEN 1 ELSE 0 END) as izin"),
                DB::raw("SUM(CASE WHEN attendances.status = 'S' THEN 1 ELSE 0 END) as sakit"),
                DB::raw("SUM(CASE WHEN attendances.status = 'A' THEN 1 ELSE 0 END) as alfa"),
                DB::raw("SUM(CASE WHEN attendances.status = 'T' THEN 1 ELSE 0 END) as terlambat")
            )
            ->join('student_classes', function ($join) {
                $join->on('students.id', '=', 'student_classes.student_id')
                    ->where('student_classes.year', $this->year);
            })
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->join('attendances', 'students.id', '=', 'attendances.student_id')
            ->where('classrooms.id', $this->class)
            ->whereBetween('attendances.date', [$this->date_start, $this->date_end])
            ->groupBy('students.id', 'students.nis', 'students.name', 'classrooms.name')
            ->get();

        $this->datareport = $students;
        return view('livewire.pages.report.report-recap-page')->layout('layouts.app');
    }

    public function exportExcel($datareport)
    {
        $class = Classroom::find($this->class);
        $classname = $class->name ?? '-';
        $excel = new ReportPresentExport($this->date_start, $classname, $this->year, $datareport);
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
        
    public function updatedDateEnd(){
        $this->setYear();
    }

    public function setYear(){
        $this->year = date('Y', strtotime($this->date_end));
    }
}
