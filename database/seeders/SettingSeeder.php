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
            ['key' => 'wa_apikey', 'value' => ''],
            ['key' => 'wa_secretkey', 'value' => ''],
            
            ['key' => 'absen_latitude', 'value' => '-6.200000'],
            ['key' => 'absen_longitude', 'value' => '106.816666'],
            ['key' => 'absen_radius', 'value' => '150'],
            ['key' => 'absen_location', 'value' => 'Kantor Pusat'],
        ]);
    }
}
