<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Teacher;
use App\Models\User;

class TeacherImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $teacher = Teacher::where('nip', $row['nip'])->first();

            // Cek user terkait, buat jika belum ada
            $user = User::firstOrCreate(
                ['name' => $row['name']],
                ['email' => strtolower(str_replace(' ', '', $row['name'])) . '@example.com', 'password' => bcrypt('password')]
            );

            if ($teacher) {
                $teacher->name = $row['name'];
                $teacher->user_id = $user->id;
                $teacher->update();
            } else {
                Teacher::create([
                    'nip' => $row['nip'],
                    'name' => $row['name'],
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
