<?php

namespace App\Livewire\Pages\Attendance;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use App\Models\Student;
use App\Models\Attendance;

use DB;

class AbsentTable extends DataTableComponent
{
    public $year;

    public function mount($year){
        $this->year = $year;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
    }

    public function builder(): Builder
    {
        $year = $this->year;
        $today = now()->toDateString();
        $students = Student::query()
            ->select(
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
            ->leftJoin('attendances', function ($join) use ($today) {
                $join->on('students.id', '=', 'attendances.student_id')
                     ->whereDate('attendances.date', $today);
            })
            ->where(function ($query) {
                $query->whereNull('attendances.id')
                      ->orWhere('attendances.status', 'A');
            });

        return $students;
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
        $this->clearSelected();
    }

    public function columns(): array
    { 
        return [
            Column::make("NIS")
                ->label(fn($row) => $row->student_nis)
                ->sortable()
                ->searchable(),

            Column::make("Nama")
                ->label(fn($row) => $row->student_name)
                ->sortable()
                ->searchable(),

            Column::make("Kelas")
                ->label(fn($row) => $row->class_name)
                ->sortable()
                ->searchable(),

            Column::make("Status")
                ->label(function ($row) {
                    if (!is_null($row->attendance_status)) {
                        return "<span class='bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded'>Terkirim</span>";
                    } else {
                        return "<span class='bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded'>Belum</span>";
                    }
                })
                ->html()
                ->collapseOnMobile(),
        ];
    }

}
