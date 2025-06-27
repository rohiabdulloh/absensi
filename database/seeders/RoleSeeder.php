<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'superadmin', 'guard_name' => 'web']);
        Role::create(['name' => 'kepsek', 'guard_name' => 'web']);
        Role::create(['name' => 'kesiswaan', 'guard_name' => 'web']);
        Role::create(['name' => 'bk', 'guard_name' => 'web']);
        Role::create(['name' => 'guru', 'guard_name' => 'web']);
        Role::create(['name' => 'siswa', 'guard_name' => 'web']);
    }
}
