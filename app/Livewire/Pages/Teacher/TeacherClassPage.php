<?php
namespace App\Livewire\Pages\Teacher;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Period;
use App\Models\TeacherClass;

class TeacherClassPage extends Component
{
    public $idDelete;
    public $isEdit = false;

    // Data wali kelas
    public $teacher_id;
    public $class_id;
    public $year;

    public $teachers = [];
    public $classrooms = [];
    public $periods = [];

    public function mount(){  
        $this->setYear();
    }

    public function render()
    {
        // Ambil ID teacher dan classroom yang sudah tercatat sebagai wali kelas tahun ini
        $assignedTeacherIds = TeacherClass::where('year', $this->year)->pluck('teacher_id')->toArray();
        $assignedClassroomIds = TeacherClass::where('year', $this->year)->pluck('class_id')->toArray();

        // Ambil hanya teacher & classroom yang belum terpakai
        $this->teachers = Teacher::whereNotIn('id', $assignedTeacherIds)->get();
        $this->classrooms = Classroom::whereNotIn('id', $assignedClassroomIds)->get();

        // Untuk dropdown atau referensi lain jika dibutuhkan
        $this->periods = Period::all();

        return view('livewire.pages.teacher.teacher-class-page')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classrooms,id',
            'year' => 'required|integer'
        ]);

        TeacherClass::create(
            [
                'teacher_id' => $this->teacher_id, 
                'class_id' => $this->class_id, 
                'year' => $this->year,
            ]
        );

        $this->isEdit = false;
        $this->dispatch('refresh')->to(TeacherClassTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data wali kelas berhasil disimpan');
        $this->resetForm();
    }

    #[On('confirm')]
    public function confirm($id)
    {
        $this->idDelete = $id;
    }

    public function delete()
    {
        $teacherclass = TeacherClass::find($this->idDelete);
        if ($teacherclass) {
            $teacherclass->delete();
            $this->dispatch('refresh')->to(TeacherClassTable::class);
            $this->dispatch('show-message', msg: 'Data teacher berhasil dihapus');
        }
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
        $this->setYear();
    }

    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }

}
