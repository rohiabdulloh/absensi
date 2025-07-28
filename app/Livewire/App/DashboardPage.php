<?php
namespace App\Livewire\App;

use Livewire\Component;
use Carbon\Carbon;
use DB;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Leave;
use App\Models\Classroom;
use App\Models\Period;
class DashboardPage extends Component
{
    public $student;
    public $students = [];

    public function render()
    {
        //Persiapan data chart
        $today = now()->toDateString();
        $activePeriod = Period::where('is_active', 'Y')->first();
        $year = $activePeriod ? $activePeriod->year_start : date('Y');
        $start = $year . '-07-01';
        $end = ($year + 1) . '-06-30';

        $dataChart = DB::table('attendances')
            ->selectRaw("MONTH(attendances.date) as month")
            ->selectRaw("SUM(CASE WHEN status = 'S' THEN 1 ELSE 0 END) as sakit")
            ->selectRaw("SUM(CASE WHEN status = 'I' THEN 1 ELSE 0 END) as izin")
            ->selectRaw("SUM(CASE WHEN status = 'A' THEN 1 ELSE 0 END) as alfa")
            ->whereBetween('attendances.date', [$start, $end])
            ->groupBy(DB::raw('MONTH(attendances.date)'))
            ->orderBy(DB::raw('MONTH(attendances.date)'))
            ->get();
        $bulanChart = ['Jul','Agu','Sep','Okt','Nov','Des','Jan','Feb','Mar','Apr','Mei','Jun'];
        $izin = array_fill(0, 12, 0);
        $sakit = array_fill(0, 12, 0);
        $alfa  = array_fill(0, 12, 0);

        foreach ($dataChart as $row) {
            $monthIndex = $row->month >= 7 ? $row->month - 7 : $row->month + 5;
            $sakit[$monthIndex] = $row->sakit;
            $izin[$monthIndex]  = $row->izin;
            $alfa[$monthIndex]  = $row->alfa;
        }

        //Siswa absen
        $absent = Student::select(
                'students.nis as student_nis',
                'students.name as student_name',
                'classrooms.name as class_name',
            )
            ->join('student_classes', function ($join) use ($year) {
                $join->on('students.id', '=', 'student_classes.student_id')
                    ->where('student_classes.year', $year);
            })
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->leftJoin('attendances', function ($join) use ($today) {
                $join->on('students.id', '=', 'attendances.student_id')
                     ->whereDate('attendances.date', $today);
            })
            ->where(function ($query) {
                $query->whereNull('attendances.id')
                      ->orWhere('attendances.status', 'A');
            });

        $absentCount = $absent->count();
        $absentStudents = $absent->limit(10)->get();

        //Data widget        
        $leaveCount = Leave::where('status', 'Menunggu')->count();
        $widget = [
            ['label'=>'Data Siswa', 'color'=>'bg-purple-500', 'icon'=>'fas-user-graduate', 'label-color'=>'bg-purple-400', 
                'link'=>'/admin/siswa',
                'data' => Student::count()
            ],
            ['label'=>'Data Guru', 'color'=>'bg-blue-500', 'icon'=>'fas-user-tie', 'label-color'=>'bg-blue-400', 
                'link'=>'/admin/guru',
                'data' => Teacher::count()
            ],
            ['label'=>'Pengajuan Ijin', 'color'=>'bg-amber-500', 'icon'=>'fas-envelope', 'label-color'=>'bg-amber-400', 
                'link'=>'/admin/presensi/ijin',
                'data' => $leaveCount
            ],
            ['label'=>'Siswa Absen', 'color'=>'bg-green-500', 'icon'=>'fas-user-times', 'label-color'=>'bg-green-400', 
                'link'=>'/admin/presensi/absen',
                'data' => $absentCount
            ],
        ];
       
        return view('livewire.app.dashboard', [
            'widget' => $widget,
            'absentStudents' => $absentStudents,
            'label' => $bulanChart,
            'izin' => $izin,
            'sakit' => $sakit,
            'alfa' => $alfa,
        ])->layout('layouts.app');
    }
}
