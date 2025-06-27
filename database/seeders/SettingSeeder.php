<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingSeeder extends Seeder
{
    
    public function run(): void
    {
        Setting::insert([
            ['key' => 'app_name', 'value' => 'Antor Kelapa'],
            ['key' => 'app_email', 'value' => 'admin@smknegeri1dukuhturi.sch.id'],
            ['key' => 'timezone', 'value' => 'UTC'],
        ]);
    }
}
