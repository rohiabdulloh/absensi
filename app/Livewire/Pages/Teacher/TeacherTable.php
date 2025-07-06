<?php

namespace App\Livewire\Pages\Teacher;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use App\Models\Teacher;

class TeacherTable extends DataTableComponent
{
    protected $model = Teacher::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('nip', 'asc');
        $this->setBulkActions([
            'deleteSelected' => 'Hapus',
        ]);
        $this->setBulkActionConfirms(['deleteSelected']);
        $this->setBulkActionConfirmMessage('deleteSelected', 'Apakah yakin akan menghapus data terpilih?');
        $this->setThAttributes(fn(Column $column) => ['class' => 'dark:bg-gray-900 py-5']);
    }

    public function builder(): Builder
    {
        return Teacher::query();
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
            Column::make('NIP', 'nip')->sortable()->searchable(),
            Column::make('Nama Guru', 'name')->sortable()->searchable(),
            Column::make('Created At', 'created_at')->sortable()->deselected()->collapseOnMobile(),
            Column::make('Updated At', 'updated_at')->sortable()->deselected()->collapseOnMobile(),
            Column::make('Actions', 'id')->view('livewire.pages.teacher.teacher-action')->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach ($this->getSelected() as $id) {
            Teacher::find($id)?->delete();
        }
        $this->clearSelected();
    }
}
