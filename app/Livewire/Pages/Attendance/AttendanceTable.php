<?php

namespace App\Livewire\Pages\Attendance;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use App\Models\Student;
use App\Models\Attendance;

class AttendanceTable extends DataTableComponent
{
    public $class;
    public $year;

    public function mount($class, $year){
        $this->class = $class;
        $this->year = $year;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
    }

    public function builder(): Builder
    {
        $class = $this->class;
        $year = $this->year;
        $attendances = Attendance::query()->with([
            'student',
            'student.classes' => function ($query) use ($year) {
                $query->where('student_classes.year', $year);
            }
        ]);
        if ($class != 0) {
            $attendances->whereHas('student.classes', function ($query) use ($year, $class) {
                $query->where('student_classes.year', $year)
                    ->where('classrooms.id', $class);
            });
        }

        return $attendances;
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
            Column::make("NIS", "student.nis")->sortable()->searchable(),
            Column::make("Nama", "student.name")->sortable()->searchable(),
            Column::make("Kelas")
                ->label(function ($row) {
                    dd($row->student);
                    $class = $row->student?->classes->wherePivot('year', $this->year)->first();
                    return $class ? $class->name : '-';
                })
                ->collapseOnMobile()->sortable(),
            Column::make("Masuk", "check_in")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Pulang", "check_out")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Status", "status")->sortable()->searchable()->collapseOnMobile(),
        ];
    }

}
