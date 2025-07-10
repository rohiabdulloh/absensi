<?php
namespace App\Livewire\Pages\Student;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentClass;
use Livewire\Attributes\On;

class StudentClassTable extends DataTableComponent
{
    public $year;
    public $class;

    public function mount($year, $class){
        $this->year = $year;
        $this->class = $class;
    }
    
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('name', 'asc');
        
        if($this->class != 0){       
            $this->setBulkActions([
                'moveSelected' => 'Pindah Kelas',
                'deleteSelected' => 'Hapus dari Kelas',
            ]);
            $this->setBulkActionConfirms([ 'deleteSelected']);
            $this->setBulkActionConfirmMessage('deleteSelected', 'Apakah yakin akan menghapus data terpilih?');
        }else{            
            $this->setBulkActions([
                'moveSelected' => 'Tambah ke Kelas',
            ]);
        }

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
        $class = $this->class;
        $year = $this->year;
        $students = Student::query()->with(['classes', 'classes.classroom']);
        if ($class == 0) {
            // Siswa yang TIDAK memiliki kelas pada tahun tertentu
            $students->whereDoesntHave('classes', function ($query) use ($year) {
                $query->where('year', $year);
            });
        } else {
            // Siswa yang ADA dalam kelas tertentu dan tahun tertentu
            $students->whereHas('classes', function ($query) use ($year, $class) {
                $query->where('year', $year)
                    ->where('class_id', $class);
            });
        }
        return $students;
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
            Column::make("Aksi", "id")->format(function ($value, $row) {
                return view('livewire.pages.student.student-class-action', [
                    'value' => $value,
                    'row' => $row, 
                    'classId' => $this->class, 
                ])->render();
            })->html()->collapseOnMobile(),
        ];
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    
    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        { 
           $classroom = StudentClass::where('student_id', $item)
                ->where('class_id', $this->class)
                ->where('year', $this->year)
                ->first();
            if($classroom) $classroom->delete();
        }
        $this->clearSelected();
    }

    
    public function moveSelected()
    {
        $studentIds = [];
        foreach($this->getSelected() as $item)
        { 
            $studentIds[] = $item;
        }

        if(count($studentIds) > 0) $this->dispatch('moveClass', $studentIds);
    }

}
