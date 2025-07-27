<?php

namespace App\Livewire\Pages\Attendance;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Carbon\Carbon;

use App\Models\Leave;
use App\Models\Period;

class LeaveTable extends DataTableComponent
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

        $this->setBulkActions([
            'setApproved' => 'Setujui',
            'setRejected' => 'Tolak',
        ]);
    }

    public function builder(): Builder
    {
        $year = $this->year;
        $today = Carbon::today();
        $students = Leave::with([
            'student',
            'student.classes' => function ($query) use ($year) {
                $query->wherePivot('year', $year);
            },
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
            Column::make("NIS", "student.nis")->sortable()->searchable(),
            Column::make("Nama", "student.name")->sortable()->searchable(),
            Column::make("Kelas", "student.classes.name")->collapseOnMobile()->sortable(),
            Column::make("Tanggal Mulai", "date_start")->collapseOnMobile()->sortable(),
            Column::make("Tanggal Selesai", "date_end")->collapseOnMobile()->sortable(),
            Column::make("Status", "status")->sortable()->searchable()->collapseOnMobile()
                ->format(function ($value, $row) {
                    $colors = [
                        'Disetujui'  => 'bg-green-500',
                        'Ditolak'   => 'bg-red-500',
                        'Menunggu'  => 'bg-gray-500',
                    ];

                    $color = $colors[$value] ?? 'bg-gray-500';

                    return "<span class='text-white text-xs font-semibold px-2 py-1 rounded {$color}'>{$value}</span>";
                })
                ->html(),
            Column::make("Aksi", "id")
                ->view('livewire.pages.attendance.leave-action')->collapseOnMobile(),
        ];
    }

    
    public function setApproved()
    {
        $this->dispatch('approve', $this->getSelected());
    }

    public function setRejected()
    {
        $this->dispatch('reject', $this->getSelected());
    }
}
