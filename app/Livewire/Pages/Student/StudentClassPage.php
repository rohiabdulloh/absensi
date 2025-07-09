<?php
namespace App\Livewire\Pages\Student;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Student;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Period;
use App\Models\StudentClass;

class StudentClassPage extends Component
{
    public $idDelete;
    public $isEdit = false;

    public $class;
    public $year;

    public $targetClass;
    public $targetYear;

    public $students = [];
    public $classrooms = [];
    public $periods = [];

    public $movedIds = [];

    public function mount(){  
        $this->class = 0;
        $this->setYear();
    }

    public function render()
    {
        $this->classrooms = Classroom::all();
        $this->periods = Period::all();

        return view('livewire.pages.student.student-class-page')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'targetClass' => 'required|exists:classrooms,id',
            'targetYear' => 'required|integer'
        ]);

        $studentIds = session('student_ids');

        if (empty($studentIds) || !is_array($studentIds)) {
            $this->dispatch('show-message', msg: 'Tidak ada siswa yang dipilih.');
            return;
        }

        foreach ($studentIds as $studentId) {
            if (!Student::find($studentId)) {
                continue;
            }

            StudentClass::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'year' => $this->targetYear,
                ],
                [
                    
                    'class_id' => $this->targetClass,
                ]
            );
        }

        $this->isEdit = false;
        $this->dispatch('refresh')->to(StudentClassTable::class);
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
        $classroom = StudentClass::where('student_id', $this->idDelete)
                ->where('class_id', $this->class)
                ->where('year', $this->year)
                ->first();
                
        if ($classroom) {
            $classroom->delete();
            $this->dispatch('refresh')->to(StudentClassTable::class);
            $this->dispatch('show-message', msg: 'Data student berhasil dihapus');
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

     #[On('moveClass')]
    public function openMoveForm($id){
        if(is_array($id)){
            $this->movedIds = $id;
        }else{
            $this->movedIds = [$id];
        }
        $this->dispatch('open-transfer');
    }

    //Proses pindah kelas
    public function moveClass(){
        $this->validate([
            'targetClass' => 'required|exists:classrooms,id',
            'targetYear' => 'required|integer'
        ]);

        $studentIds = $this->movedIds;

        if (empty($studentIds) || !is_array($studentIds)) {
            $this->dispatch('show-message', msg: 'Tidak ada siswa yang dipilih.');
            return;
        }

        foreach ($studentIds as $studentId) {
            if (!Student::find($studentId)) {
                continue;
            }
            
            StudentClass::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'year' => $this->targetYear,
                ],
                [
                    
                    'class_id' => $this->targetClass,
                ]
            );
        }

        $this->isEdit = false;
        $this->dispatch('refresh')->to(StudentClassTable::class);
        $this->dispatch('close-transfer');
        $this->dispatch('show-message', msg: 'Siswa berhasil dipindah kelas');
    }
}
