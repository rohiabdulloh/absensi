<?php

namespace App\Livewire\Pages\Worker;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On; 
use App\Models\Worker;
    
class WorkerTable extends DataTableComponent
{
    protected $model = Worker::class;

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
        $workers =  Worker::query()->with('division','department','position','status');
     
        return $workers;
    }

    #[On('refresh')]
    public function refresh(){
        $this->dispatch('$refresh');
        $this->clearSelected();
    }

    public function columns(): array
    { 
        return [
            Column::make("No ID", "noid")->sortable()->searchable(),
            Column::make("Nama Pekerja", "name")->sortable()->searchable(),
            Column::make("NIK", "nik")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Tanggal Lahir", "dob")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Telepon", "telp")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Alamat", "address")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Departemen", "department.name")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Tanggal Masuk", "start_work_at")->sortable()->deselected()->collapseOnMobile(),
            Column::make("No. Rekening", "bank_account")->sortable()->deselected()->collapseOnMobile(),
            Column::make("Dibuat", "created_at")->sortable()->deselected()->collapseOnMobile(),
            Column::make("Diedit", "updated_at")->sortable()->deselected()->collapseOnMobile(),
            Column::make("Aksi", "id")->view('livewire.pages.worker.worker-action')->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        { 
           Worker::find($item)->delete();
        }
        $this->clearSelected();
    }

}
