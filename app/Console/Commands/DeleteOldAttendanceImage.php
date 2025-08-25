<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Models\Attendance;
use App\Models\Setting;

class DeleteOldAttendanceImage extends Command
{
    
    protected $signature = 'app:delete-old-attendance-image';

    protected $description = 'Delete old attendance image';

    public function handle()
    {
        $settingOn = Setting::getValue('delete_image_on') ?? 'Y';
        if($settingOn == 'Y'){
            $settingTime = Setting::getValue('delete_image_time') ?? '09:00';
            $currentHour = now()->format('H:00');

            if ($currentHour !== $settingTime) {
                return;
            }

            $daylimit = (int) Setting::getValue('delete_photo_limit') ?: 5;

            $updatedCount = 0;

            Attendance::where('created_at', '<', now()->subDays($daylimit))
                ->chunk(100, function ($attendances) use (&$updatedCount) {
                    foreach ($attendances as $attendance) {
                        
                        if ($attendance->image_in && Storage::exists($attendance->image_in)) {
                            Storage::delete($attendance->image_in);
                        }

                        if ($attendance->image_out && Storage::exists($attendance->image_out)) {
                            Storage::delete($attendance->image_out);
                        }

                        // Kosongkan kolom image
                        $attendance->image_in = null;
                        $attendance->image_out = null;
                        $attendance->save();

                        $updatedCount++;
                    }
                });


            $this->info("Updated $updatedCount attendance records (images removed).");
        }
    }
}
