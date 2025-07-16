<!-- Versi mobile (tampil hanya di layar kecil) -->
<div class="block md:hidden space-y-6">
    @foreach ($leaves as $item)
        @php
            $leaveType = $item->type == 'S' ? 'Sakit' : 'Ijin';
            $statusClass = '';
            if($item->status == 'Disetujui') {
                $statusClass = 'text-green-500 font-bold';
            } elseif ($item->status == 'Menunggu') {
                $statusClass = 'text-orange-500 font-bold';
            } else {
                $statusClass = 'text-red-500 font-bold';
            }
        @endphp

        <div class="p-6 rounded-lg shadow-md transition-all duration-300 ease-in-out hover:shadow-xl
                    bg-white dark:bg-gray-800 dark:text-gray-100">
            
            <!-- Tanggal Pengajuan -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Tanggal Pengajuan</span>
                <span class="text-base font-semibold">
                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y') }}
                </span>
            </div>

            <!-- Tanggal Mulai -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Tanggal Mulai</span>
                <span class="text-base font-medium">
                    {{ \Carbon\Carbon::parse($item->date_start)->translatedFormat('d F Y') }}
                </span>
            </div>

            <!-- Tanggal Selesai -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Tanggal Selesai</span>
                <span class="text-base font-medium">
                    {{ \Carbon\Carbon::parse($item->date_end)->translatedFormat('d F Y') }}
                </span>
            </div>

            <!-- Tipe Cuti -->
            <div class="flex justify-between items-center border-b pb-4 mb-4 border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">Tipe Ijin</span>
                <span class="text-base font-medium">{{ $leaveType }}</span>
            </div>

            <!-- Status -->
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                <span class="{{ $statusClass }}">{{ $item->status }}</span>
            </div>

            @if($item->status == 'Menunggu')
            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-2">
                <x-button-circle wire:click="edit({{ $item->id }})">
                    <x-fas-edit class="h-4 w-4 text-white" />
                </x-button-circle>
                <x-button-circle color="red-500" onclick="isConfirmOpen=true" wire:click="confirm({{ $item->id }})">
                    <x-fas-trash class="h-4 w-4 text-white" />
                </x-button-circle>
            </div>
            @endif
        </div>
    @endforeach
</div>
