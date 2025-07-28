<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingSeeder extends Seeder
{
    
    public function run(): void
    {
        Setting::insert([
            ['key' => 'checkin_time', 'value' => '07:00'],
            ['key' => 'checkin_start', 'value' => '06:00'],
            ['key' => 'checkin_end', 'value' => '08:00'],

            ['key' => 'checkout_start', 'value' => '14:00'],
            ['key' => 'checkout_end', 'value' => '16:00'],

            ['key' => 'saturday_off', 'value' => 'Y'],
            ['key' => 'wa_message', 'value' => ''],
        ]);
    }
}
