<!-- resources/views/livewire/fronts/home-page.blade.php -->
<div class="max-w-4xl mx-auto px-4 py-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <!-- Header Siswa -->
    <div class="text-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">
            Selamat datang, <span class="text-blue-600 dark:text-blue-400">{{ $student->name }}</span>!
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 mt-1">
            Kelas: <span class="text-green-600 dark:text-green-400">{{ $classroom->classroom->name ?? 'Belum ada kelas' }}</span>
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
            Tanggal: <span class="font-medium text-indigo-600 dark:text-indigo-400">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
        </p>
    </div>

    <!-- Presensi Section -->
    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-inner space-y-4">
        <div class="flex justify-between items-center">
            <p class="text-lg text-gray-700 dark:text-gray-300">Presensi Masuk:</p>
            <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                @if ($todayCheckIn)
                    {{ $todayCheckIn ?? '-' }}
                @else
                    <span class="text-gray-500 dark:text-gray-500">-</span>
                @endif
            </p>
        </div>
        <div class="flex justify-between items-center">
            <p class="text-lg text-gray-700 dark:text-gray-300">Presensi Pulang:</p>
            <p class="text-lg font-semibold text-red-600 dark:text-red-400">
                @if ($todayCheckOut)
                    {{ $todayCheckOut ?? '-' }}
                @else
                    <span class="text-gray-500 dark:text-gray-500">-</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Tombol Presensi dan Refresh -->
    <div class="mt-6 flex justify-between space-x-4">
        <x-button-secondary wire:click="$dispatch('$refresh')" class="py-4">
            <x-fas-sync-alt class="w-4 h-4"/>
        </x-button-secondary>

        {{-- Tombol hanya tampil di IP lokal --}}
        @if($isLocal)
            {{-- Tombol Masuk hanya tampil jika waktu sekarang di antara checkin_start dan checkin_end --}}
            @if ($now >= $checkin_start && $now <= $checkin_end)
                @if ($todayCheckIn)
                    <x-button-primary class="opacity-50"> Sudah Presensi </x-button-primary>
                @elseif ($now < $checkin_time)
                    <x-button-primary wire:click="checkIn"
                        wire:loading.attr="disabled"
                        wire:target="checkIn"
                    >
                        <x-fas-circle-notch wire:loading wire:target="checkIn" class="w-4 h-4 mr-2 animate-spin"/>
                        <x-fas-sign-in-alt wire:loading.remove wire:target="checkIn" class="w-4 h-4 mr-2"/>
                        Masuk (On Time)
                    </x-button-primary>
                @else
                    <x-button-danger wire:click="checkIn"
                        wire:loading.attr="disabled"
                        wire:target="checkIn"
                    >
                        <x-fas-circle-notch wire:loading wire:target="checkIn" class="w-4 h-4 mr-2 animate-spin"/>
                        <x-fas-sign-in-alt wire:loading.remove wire:target="checkIn" class="w-4 h-4 mr-2"/>
                        Masuk (Telat)
                    </x-button-danger>
                @endif
            @endif

            {{-- Tombol Pulang hanya tampil jika waktu sekarang di antara checkout_start dan checkout_end --}}
            @if ($now >= $checkout_start && $now <= $checkout_end)
                @if ($todayCheckOut)
                    <x-button-primary class="opacity-50"> Sudah Presensi </x-button-primary>
                @else
                    <x-button-primary wire:click="checkOut"
                        wire:loading.attr="disabled"
                        wire:target="confirm"
                    >
                        <x-fas-circle-notch wire:loading wire:target="confirm" class="w-4 h-4 mr-2 animate-spin"/>
                        <x-fas-sign-out-alt wire:loading.remove wire:target="confirm" class="w-4 h-4 mr-2"/>
                        Pulang 
                    </x-button-primary>
                @endif
            @endif
        @endif
    </div>

    <x-confirm>Yakin akan melakukan presensi pulang?</x-confirm>
</div>
