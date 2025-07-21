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
        $students = Student::query()
            ->select(
                'students.id',
                'students.nis as student_nis',
                'students.name as student_name',
                'classrooms.name as class_name'
            )
            ->join('student_classes', function ($join) {
                $join->on('students.id', '=', 'student_classes.student_id')
                    ->where('student_classes.year', $this->year);
            })
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('attendances')
                    ->whereColumn('attendances.student_id', 'students.id')
                    ->whereDate('attendances.date', now()->toDateString());
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
        ];
    }

}
