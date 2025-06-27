<?php

namespace App\Livewire\Pages\User;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On; 
use App\Models\User;
    
class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

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
        $users =  User::query()->role('superadmin');
        if(!request()->get('table-sorts')) $users = $users->orderBy('id', 'desc');
     
        return $users;
    }

    #[On('refresh')]
    public function refresh(){
        $this->dispatch('$refresh');
    }

    public function columns(): array
    {
        return [
            Column::make("Nama User", "name")->sortable()->searchable(),
            Column::make("Email", "email")->sortable()->searchable()->collapseOnMobile(),
            Column::make("Dibuat", "created_at")->sortable()->deselected()->collapseOnMobile(),
            Column::make("Diedit", "updated_at")->sortable()->deselected()->collapseOnMobile(),
            Column::make("Aksi", "id")->view('livewire.pages.user.user-action')->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        { 
           User::find($item)->delete();
        }
        $this->clearSelected();
    }
}
