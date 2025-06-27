<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Superadmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('passadmin'),
        ]);

        $admin->assignRole('superadmin');
    }
}
