<?php

namespace App\Livewire\Pages\Report;

use Livewire\Component;

use App\Models\Attendance;
use App\Models\Period;
use App\Models\Classroom;
use App\Models\Student;

use App\Exports\ReportAbsentExport;
use Maatwebsite\Excel\Facades\Excel;   
use PDF;

class ReportAbsentPage extends Component
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

        $students = Student::select(
                'students.id',
                'students.nis as student_nis',
                'students.name as student_name',
                'classrooms.name as class_name',
                'attendances.status as attendance_status'
            )
            ->join('student_classes', function ($join) {
                $join->on('students.id', '=', 'student_classes.student_id')
                    ->where('student_classes.year', $this->year);
            })
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->join('attendances', function ($join) {
                $join->on('students.id', '=', 'attendances.student_id')
                     ->whereDate('attendances.date', $this->date);
            })
            ->when($this->class != 0, function ($query) {
                $query->where('classrooms.id', $this->class);
            })
            ->whereNull('attendances.check_in')
            ->get();

        $this->datareport = $students;
        return view('livewire.pages.report.report-absent-page')->layout('layouts.app');
    }

    public function exportExcel($datareport)
    {
        $class = Classroom::find($this->class);
        $classname = $class->name ?? '-';
        $excel = new ReportAbsentExport($this->date, $classname, $this->year, $datareport);
        return Excel::download($excel, 'Laporan Data Siswa Absen.xlsx');
    }

    public function exportPDF($datareport)
    {
        $class = Classroom::find($this->class);
        $classname = $class->name ?? '-';
        $date = $this->date;
        $year = $this->year;

        $pdf = PDF::loadView('livewire.pages.report.report-absent-pdf',  
            compact('datareport','date','classname', 'year'))
            ->setPaper('legal', 'landscape');        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Laporan Data Siswa Absen.pdf');
    }
        
    public function updatedDate(){
        $this->setYear();
    }

    public function setYear(){
        $this->year = date('Y', strtotime($this->date));
    }
}
