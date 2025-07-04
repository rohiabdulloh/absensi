<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentFormat implements FromArray, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                'NIS',
                'NAME',
                'GENDER',
                'YEAR_ENTRY',
            ]
        ];
    }
}
