<?php
namespace App\Livewire\Pages\Teacher;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use Livewire\Attributes\On;

class TeacherClassTable extends DataTableComponent
{
    public $year;

    public function mount($year){
        $this->year = $year;
    }
    
    public function configure(): void
    {
        $this->setPrimaryKey('classrooms.id');
        $this->setDefaultSort('classrooms.name', 'asc');
        $this->setThAttributes(fn(Column $column) => ['class' => 'dark:bg-gray-900 py-5']);
    }

    public function builder(): Builder
    {
        return Classroom::query()
            ->leftJoin('teacher_classes', function ($join) {
                $join->on('classrooms.id', '=', 'teacher_classes.class_id')
                    ->where('teacher_classes.year', '=', $this->year);
            })
            ->leftJoin('teachers', 'teacher_classes.teacher_id', '=', 'teachers.id')
            ->select(
                'classrooms.id as id',
                'classrooms.name as classroom_name',
                'teachers.name as teacher_name',
                'teachers.nip as teacher_nip'
            );
    }

    public function columns(): array
    {
        return [
            Column::make('Kelas', 'classroom_name')
                ->label(fn($row) => $row->classroom_name ?? '-')
                ->sortable()
                ->searchable(),

            Column::make('Nama Wali Kelas', 'teacher_name')
                ->label(fn($row) => $row->teacher_name ?? '-')
                ->html()
                ->sortable()
                ->searchable(),

            Column::make('NIP', 'teacher_nip')
                ->label(fn($row) => $row->teacher_nip ?? '-')
                ->sortable()
                ->searchable(),

            Column::make('Aksi', 'id')
                ->view('livewire.pages.teacher.teacher-class-action')
                ->collapseOnMobile(),
        ];
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

}
