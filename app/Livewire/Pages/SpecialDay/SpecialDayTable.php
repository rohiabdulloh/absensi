<?php

namespace App\Livewire\Pages\SpecialDay;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use App\Models\SpecialDay;

class SpecialDayTable extends DataTableComponent
{
    protected $model = SpecialDay::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('date', 'desc');
        $this->setBulkActions([
            'deleteSelected' => 'Hapus',
        ]);
        $this->setBulkActionConfirms(['deleteSelected']);
        $this->setBulkActionConfirmMessage('deleteSelected', 'Apakah yakin akan menghapus data terpilih?');
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return ['class' => 'dark:bg-gray-900 py-5 text-end pr-8'];
            }
            return ['default' => true, 'class' => 'dark:bg-gray-900 py-5'];
        });
    }

    public function builder(): Builder
    {
        return SpecialDay::query();
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
            Column::make('Tanggal', 'date')
                ->format(fn ($value, $row) => \Carbon\Carbon::parse($row->date)->format('d-m-Y'))
                ->sortable()
                ->searchable(),

            Column::make('Tipe', 'type')
                ->format(fn ($value) => match($value) {
                    'OFF' => 'Hari Libur',
                    'FM' => 'Gangguan Sistem',
                    'HB' => 'Hari Besar',
                    default => ucfirst($value),
                })
                ->sortable()
                ->searchable(),

            Column::make('Deskripsi', 'description')
                ->sortable()
                ->searchable(),

            Column::make('Dibuat', 'created_at')
                ->format(fn ($value) => \Carbon\Carbon::parse($value)->format('d-m-Y H:i'))
                ->deselected()
                ->collapseOnMobile()
                ->sortable(),

            Column::make('Diubah', 'updated_at')
                ->format(fn ($value) => \Carbon\Carbon::parse($value)->format('d-m-Y H:i'))
                ->deselected()
                ->collapseOnMobile()
                ->sortable(),

            Column::make('Aksi', 'id')
                ->view('livewire.pages.special-day.special-day-action') // kamu bisa buat view ini nanti
                ->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach ($this->getSelected() as $id) {
            SpecialDay::find($id)?->delete();
        }

        $this->clearSelected();
    }
}
