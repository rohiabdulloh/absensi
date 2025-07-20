<?php

namespace App\Livewire\Pages\Attendance;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Carbon\Carbon;

use App\Models\Student;
use App\Models\Period;

class AbsentTable extends DataTableComponent
{
    public $year;

    public function mount(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
    }

    public function builder(): Builder
    {
        $year = $this->year;
        $today = Carbon::today();
        $students = Student::whereDoesntHave('attendance', function ($query) use ($today) {
            $query->whereDate('date', $today); 
        })
        ->orWhereHas('attendance', function ($query) use ($today) {
            $query->whereDate('date', $today)->where('status', 'A'); 
        })
        ->with([
            'attendance',
            'classes' => function ($query) use ($year) {
                $query->where('year', $year);
            },
            'classes.classroom'
        ]);

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
            Column::make("NIS", "nis")->sortable()->searchable(),
            Column::make("Nama", "name")->sortable()->searchable(),
            Column::make("Kelas", "classes.classroom.name")->collapseOnMobile()->sortable(),
            Column::make("Status", "status")->sortable()->searchable()->collapseOnMobile(),
        ];
    }

}
