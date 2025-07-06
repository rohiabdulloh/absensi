<?php

namespace App\Livewire\Pages\Period;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use App\Models\Period;

class PeriodTable extends DataTableComponent
{
    protected $model = Period::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('year_start', 'desc');
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
        return Period::query();
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
            Column::make('Tahun Ajaran', 'year_start')
                ->format(fn ($value, $row) => $row->year_start . '/' . $row->year_end)
                ->sortable()
                ->searchable(),
            Column::make('Year End', 'year_end')
                ->hideIf(true),
            Column::make('Active', 'is_active')->view('livewire.pages.period.period-active')->sortable(),
            Column::make('Created At', 'created_at')->sortable()->deselected()->collapseOnMobile(),
            Column::make('Updated At', 'updated_at')->sortable()->deselected()->collapseOnMobile(),
            Column::make('Actions', 'id')->view('livewire.pages.period.period-action')->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach ($this->getSelected() as $id) {
            Period::find($id)?->delete();
        }
        $this->clearSelected();
    }
}
