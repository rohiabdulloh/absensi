<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

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
                [
                    'username' => $row['nip']
                ],
                [
                    'name' => $row['nama_guru'],
                    'email' => $row['nip'] . '@gmail.com', 
                    'password' => Hash::make($row['nip'])
                ]
            );

            $user->assignRole('guru');

            if ($teacher) {
                $teacher->name = $row['nama_guru'];
                $teacher->user_id = $user->id;
                $teacher->update();
            } else {
                Teacher::create([
                    'nip' => $row['nip'],
                    'name' => $row['nama_guru'],
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
