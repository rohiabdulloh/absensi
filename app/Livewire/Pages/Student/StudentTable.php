<?php

namespace App\Livewire\Pages\Student;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use App\Models\Student;

class StudentTable extends DataTableComponent
{
    protected $model = Student::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setBulkActions([
            'deleteSelected' => 'Hapus',
        ]);
        $this->setBulkActionConfirms([ 'deleteSelected']);
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
        // Ambil data Student dengan relasi ke user
        return Student::query()->with('user');
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
            Column::make("Jenis Kelamin", "gender")
                ->format(function ($value) {
                    return $value == 'M' ? 'L' : ($value == 'F' ? 'P' : $value);
                })
                ->sortable()->searchable()->collapseOnMobile(),
            Column::make("HP Orang Tua", "parent_hp")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Tahun Masuk", "year_entry")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Dibuat", "created_at")->sortable()->deselected()->collapseOnMobile(),
            Column::make("Diedit", "updated_at")->sortable()->deselected()->collapseOnMobile(),
            Column::make("Aksi", "id")->view('livewire.pages.student.student-action')->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        { 
            Student::find($item)->delete();
        }
        $this->clearSelected();
    }
}
