<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TeacherFormat implements FromArray, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                'NIP',
                'NAMA GURU',
            ]
        ];
    }
}
