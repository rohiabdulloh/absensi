<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\User;

class UserExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('livewire.pages.user.user-excel', [
            'users' => User::all()
        ]);
    }
}
