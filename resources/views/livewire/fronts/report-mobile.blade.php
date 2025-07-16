<!-- Versi mobile (tampil hanya di layar kecil) -->
<div class="block md:hidden space-y-6">
    @foreach ($attendanceData as $item)
        @php
            $dayOfWeek = \Carbon\Carbon::parse($item['date'])->dayOfWeek;
            $rowClass = 'text-gray-800 dark:bg-gray-800';
            if($dayOfWeek == \Carbon\Carbon::SATURDAY and $saturdayOff=='Y') $rowClass = 'bg-gray-100 dark:bg-gray-700';
            if($dayOfWeek == \Carbon\Carbon::SUNDAY) $rowClass = 'bg-gray-100 dark:bg-gray-700';
        @endphp

        <div class="p-6 rounded-lg shadow-md transition-all duration-300 ease-in-out hover:shadow-xl
                    bg-white dark:text-gray-100 {{ $rowClass }}">
            
            <!-- Tanggal -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Tanggal</span>
                <span class="text-base font-semibold">
                    {{ \Carbon\Carbon::parse($item['date'])->translatedFormat('l, d F Y') }}
                </span>
            </div>

            <!-- Masuk -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Masuk</span>
                <span class="text-base font-medium">{{ $item['check_in'] }}</span>
            </div>

            <!-- Pulang -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Pulang</span>
                <span class="text-base font-medium">{{ $item['check_out'] }}</span>
            </div>

            <!-- Keterangan -->
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500 dark:text-gray-400">Keterangan</span>
                <span class="font-bold
                    @if($item['status'] == 'H') text-green-500
                    @elseif($item['status'] == 'S' or $item['status'] == 'I') text-purple-500
                    @elseif($item['status'] == 'A') text-red-500
                    @elseif($item['status'] != '-') text-orange-500
                    @else text-gray-500 dark:text-gray-300
                    @endif
                ">
                    {{ $item['status'] }}
                </span>
            </div>
        </div>
    @endforeach
</div>
