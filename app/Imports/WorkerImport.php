<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Worker;

class WorkerImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $birthday = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthday']);
            $hiredday = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hiredday']);
            
            $worker = Worker::where('noid', $row['badgenumber'])->first();
            if($worker){
                $worker->nik = $row['ssn'];
                $worker->name = $row['name'];
                $worker->dob = $birthday;
                $worker->telp = $row['pager'];
                $worker->address = implode(", ", [$row['street'], $row['city']]);
                $worker->start_work_at = $hiredday;
                $worker->update();
            }else{
                $worker = new Worker;  
                $worker->noid = $row['badgenumber'];
                $worker->nik = $row['ssn'];
                $worker->name = $row['name'];
                $worker->dob = $birthday;
                $worker->telp = $row['pager'];
                $worker->address = implode(", ", [$row['street'], $row['city']]);
                $worker->start_work_at = $hiredday;
                $worker->save();
            }
        }
    }
}
