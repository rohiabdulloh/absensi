<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Worker;

class WorkerExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('livewire.pages.worker.worker-excel', [
            'workers' => Worker::all()
        ]);
    }
}
