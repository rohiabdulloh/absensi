<?php

namespace App\Livewire\Pages\Report;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Attendance;
use App\Models\Period;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Setting;

use App\Exports\ReportPresentExport;
use Maatwebsite\Excel\Facades\Excel;   
use PDF;

class ReportPresentStudentPage extends Component
{

    public $month, $year, $class, $student;
    public $saturdayOff = true;

    public $monthList = [];
    public $classrooms = [];
    public $students = [];
    public $periods = [];
    public $datareport = [];

    public function mount(){
        $this->saturdayOff = Setting::getValue('saturday_off');
        $this->date = now()->toDateString();
        $this->month = (int) date('m');
        $this->setYear();
        
        $this->monthList = [
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
        ];
    }

    public function render()
    {        
        $this->periods = Period::all();
        $this->classrooms = Classroom::all();

        $start = Carbon::createFromDate($this->year, $this->month, 1);
        $end = $start->copy()->endOfMonth();
        $student = Student::find($this->student);

        $dates = [];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        $attendances = Attendance::where('student_id', $student?->id)
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->get()
            ->keyBy('date');

        $this->datareport = collect($dates)->map(function ($date) use ($attendances) {
            $record = $attendances[$date] ?? null;

            return [
                'date' => $date,
                'check_in' => $record->check_in ?? '-',
                'check_out' => $record->check_out ?? '-',
                'status' => $record->status ?? '-',
            ];
        })->toArray();

        return view('livewire.pages.report.report-present-student-page')->layout('layouts.app');
    }

    public function updatedClass(){
        $this->student = null;
        $year = $this->year;
        $class = $this->class;
        $this->students = Student::whereHas('classes', function ($query) use ($year, $class) {
            $query->where('student_classes.year', $year)
                ->where('classrooms.id', $class);
        })->get();
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
  
    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }
}
