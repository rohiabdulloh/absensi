<?php

namespace App\Livewire\Fronts;

use Livewire\Component;
use Carbon\Carbon;
use Auth;
use App\Models\Period;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Setting;

class ReportPage extends Component
{
    public $month;
    public $year;
    public $monthList = [];
    public $attendanceData = [];
    public $saturdayOff;

    public function mount()
    {
        $this->saturdayOff = Setting::getValue('saturday_off');
        $this->setYear();
        $this->month = (int) date('m');

        // Urutan bulan ajaran: Juli - Juni
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

        $this->loadAttendance();
    }

    public function updatedMonth()
    {
        $this->loadAttendance();
    }

    public function setYear()
    {
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod?->year_start ?? date('Y');
    }

    public function loadAttendance()
    {
        $start = Carbon::createFromDate($this->year, $this->month, 1);
        $end = $start->copy()->endOfMonth();
        $student = Student::where('user_id', Auth::id())->first();

        $dates = [];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        $attendances = Attendance::where('student_id', $student?->id)
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->get()
            ->keyBy('date');

        $this->attendanceData = collect($dates)->map(function ($date) use ($attendances) {
            $record = $attendances[$date] ?? null;

            return [
                'date' => $date,
                'check_in' => $record->check_in ?? '-',
                'check_out' => $record->check_out ?? '-',
                'status' => $record->status ?? '-',
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.fronts.report-page')->layout('layouts.app');
    }
}
