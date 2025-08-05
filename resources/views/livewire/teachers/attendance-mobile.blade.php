<!-- Versi mobile (tampil hanya di layar kecil) -->
<div class="block md:hidden space-y-6">
    @foreach ($students as $student)
        @php
            $record = $attendanceRecords[$student->id] ?? null;
            $status = $record->status ?? '-';
            $checkIn = $record->check_in ?? '-';
            $checkOut = $record->check_out ?? '-';

            $statusText = match($status) {
                'H' => 'Hadir',
                'A' => 'Alfa',
                'I' => 'Izin',
                default => '-'
            };

            $statusClass = match($status) {
                'H' => 'text-green-600 font-semibold',
                'A' => 'text-red-600 font-semibold',
                'I' => 'text-yellow-600 font-semibold',
                default => 'text-gray-500'
            };
        @endphp

        <div class="p-6 rounded-lg shadow-md transition-all duration-300 ease-in-out hover:shadow-xl
                    bg-white dark:bg-gray-800 dark:text-gray-100">
            
            <!-- Nama Siswa -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Nama</span>
                <span class="text-base font-semibold">{{ $student->name }}</span>
            </div>

            <!-- NIS -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">NIS</span>
                <span class="text-base font-medium">{{ $student->nis }}</span>
            </div>

            <!-- Check-in -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Check-in</span>
                <span class="text-base font-medium">{{ $checkIn }}</span>
            </div>

            <!-- Check-out -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Check-out</span>
                <span class="text-base font-medium">{{ $checkOut }}</span>
            </div>

            <!-- Status Kehadiran -->
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                <span class="{{ $statusClass }}">{{ $statusText }}</span>
            </div>
        </div>
    @endforeach
</div>
