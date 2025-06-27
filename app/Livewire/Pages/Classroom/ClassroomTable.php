<?php

namespace App\Livewire\Pages\Classroom;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On; 
use App\Models\Classroom;

class ClassroomTable extends DataTableComponent
{
    protected $model = Classroom::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');

        $this->setBulkActions([
            'deleteSelected' => 'Hapus',
        ]);
        $this->setBulkActionConfirms(['deleteSelected']);
        $this->setBulkActionConfirmMessage('deleteSelected', 'Apakah yakin akan menghapus data terpilih?');

        $this->setThAttributes(function(Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'dark:bg-gray-900 py-5 text-end pr-8',
                ];
            }

            return [
                'default' => true,
                'class' => 'dark:bg-gray-900 py-5',
            ];
        });
    }

    public function builder(): Builder
    {
        return Classroom::query();
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    public function columns(): array
    {
        return [
            Column::make("Grade", "grade")->sortable()
                ->searchable(),
            Column::make("Classroom Name", "name")->sortable()
                ->searchable(),
            Column::make("Created At", "created_at")
                ->sortable()->deselected()->collapseOnMobile(),
            Column::make("Updated At", "updated_at")
                ->sortable()->deselected()->collapseOnMobile(),
            Column::make("Actions", "id")
                ->view('livewire.pages.classroom.classroom-action')->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach ($this->getSelected() as $item) { 
            Classroom::find($item)?->delete();
        }
        $this->clearSelected();
    }
}
