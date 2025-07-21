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
        $attendances = Attendance::query()
            ->select('attendances.*', 'students.nis as student_nis', 'students.name as student_name', 'classrooms.name as class_name')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->join('student_classes', function ($join) {
                $join->on('students.id', '=', 'student_classes.student_id')
                    ->where('student_classes.year', $this->year);
            })
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->when($this->class != 0, function ($query) {
                $query->where('classrooms.id', $this->class);
            })
            
            ->whereDate('attendances.date', now()->toDateString());
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
            Column::make("Masuk", "check_in")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Pulang", "check_out")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Status", "status")
                ->label(function ($row) {
                    $status = strtoupper($row->status);

                    // Mapping warna Tailwind berdasarkan status
                    $color = match ($status) {
                        'H' => 'text-black',
                        'A' => 'text-red-500 font-bold',
                        'I' => 'text-purple-500 font-bold',
                        'S' => 'text-green-500 font-bold',
                        default => 'text-orange-500 font-bold',
                    };

                    return "<span class=\"font-semibold {$color}\">" . e($status) . "</span>";
                })
                ->html()
                ->sortable()
                ->collapseOnMobile(),
        ];
    }

}
