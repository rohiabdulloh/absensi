<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StudentImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $nis = $row['nis'];
            $name = $row['nama_siswa'];
            $gender = strtoupper($row['jenis_kelamin']) == 'L' ? 'M' : 'F';
            $parentHp = $row['hp_orang_tua'];
            $yearEntry = $row['tahun_masuk'];

            $student = Student::where('nis', $nis)->first();

            if ($student) {
                // Update data student
                $student->name = $name;
                $student->gender = $gender;
                $student->parent_hp = $parentHp;
                $student->year_entry = $yearEntry;

                // Jika belum ada user_id, buat user baru dan hubungkan
                if (!$student->user_id) {
                    $user = $this->createUserForStudent($name, $nis);
                    $student->user_id = $user->id;
                }

                $student->save();
            } else {
                // Buat user baru
                $user = $this->createUserForStudent($name, $nis);

                // Buat student baru
                $student = new Student;
                $student->user_id = $user->id;
                $student->nis = $nis;
                $student->name = $name;
                $student->gender = $gender;
                $student->parent_hp = $parentHp;
                $student->year_entry = $yearEntry;
                $student->save();
            }
        }
    }

    protected function createUserForStudent(string $name, string $nis)
    {
        // Membuat username dari NIS dan email dummy (atau sesuaikan)
        $username = $nis;
        $email = $username.'@gmail.com';

        // Jika user sudah ada (berdasarkan username), return user tersebut
        $user = User::where('username', $username)->first();
        if ($user) {
            return $user;
        }

        // Buat user baru dengan password default 'password123' (harap ubah sesuai kebutuhan)
        return User::create([
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($nis),
        ]);
    }
}
