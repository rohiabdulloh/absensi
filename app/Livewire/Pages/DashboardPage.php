<?php
namespace App\Livewire\Pages;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Worker;
class DashboardPage extends Component
{
    public $worker;
    public $workers = [];

    public function render()
    {
        $widget = [
            ['label'=>'Jumlah Siswa', 'color'=>'bg-purple-500', 'icon'=>'fas-user-graduate', 'label-color'=>'bg-purple-400', 
                'data' => Worker::count()
            ],
            ['label'=>'Jumlah Guru', 'color'=>'bg-blue-500', 'icon'=>'fas-user-tie', 'label-color'=>'bg-blue-400', 
                'data' => Worker::count()
            ],
            ['label'=>'Jumlah DuDi', 'color'=>'bg-amber-500', 'icon'=>'fas-house', 'label-color'=>'bg-amber-400', 
                'data' => Worker::count()
            ],
            ['label'=>'Pengajuran PKL', 'color'=>'bg-green-500', 'icon'=>'fas-house-user', 'label-color'=>'bg-green-400', 
                'data' => Worker::count()
            ],
        ];
       
        $this->workers = Worker::all();

        return view('livewire.pages.dashboard', [
            'widget' => $widget,
            'label' => [],
            'chart' => [],
        ])->layout('layouts.app');
    }
}
