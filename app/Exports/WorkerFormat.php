<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\User;

class WorkerFormat implements FromArray, ShouldAutoSize
{
    public function array(): array
    {        
        $data = array([
            'USERID',
            'SSN',
            'Name',
            'PAGER',
            'BIRTHDAY',
            'HIREDDAY',
            'Street',
            'City',
        ]);

        return $data;
    }
}
