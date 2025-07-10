<?php
namespace App\Livewire\App;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
class DashboardPage extends Component
{
    public $student;
    public $students = [];

    public function render()
    {
        $widget = [
            ['label'=>'Jumlah Siswa', 'color'=>'bg-purple-500', 'icon'=>'fas-user-graduate', 'label-color'=>'bg-purple-400', 
                'data' => Student::count()
            ],
            ['label'=>'Jumlah Guru', 'color'=>'bg-blue-500', 'icon'=>'fas-user-tie', 'label-color'=>'bg-blue-400', 
                'data' => Teacher::count()
            ],
            ['label'=>'Jumlah Kelas', 'color'=>'bg-amber-500', 'icon'=>'fas-chalkboard-teacher', 'label-color'=>'bg-amber-400', 
                'data' => Classroom::count()
            ],
            ['label'=>'Siswa Absen', 'color'=>'bg-green-500', 'icon'=>'fas-user-times', 'label-color'=>'bg-green-400', 
                'data' => Student::count()
            ],
        ];
       
        $this->students = Student::all();

        return view('livewire.app.dashboard', [
            'widget' => $widget,
            'label' => [],
            'chart' => [],
        ])->layout('layouts.app');
    }
}
