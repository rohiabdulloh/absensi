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
                @if ($student->presensi_masuk)
                    {{ $student->presensi_masuk->time ?? '-' }}
                @else
                    <span class="text-gray-500 dark:text-gray-500">-</span>
                @endif
            </p>
        </div>
        <div class="flex justify-between items-center">
            <p class="text-lg text-gray-700 dark:text-gray-300">Presensi Pulang:</p>
            <p class="text-lg font-semibold text-red-600 dark:text-red-400">
                @if ($student->presensi_pulang)
                    {{ $student->presensi_pulang->time ?? '-' }}
                @else
                    <span class="text-gray-500 dark:text-gray-500">-</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Tombol Presensi dan Refresh -->
    <div class="mt-6 flex justify-between space-x-4">
        <x-button-secondary wire:click="$dispatch('$refresh')" >
            <x-fas-sync-alt class="w-4 h-4 mr-2"/>
            Refresh
        </x-button-secondary>
        <x-button-primary wire:click="checkIn">
            <x-fas-sign-in-alt class="w-4 h-4 mr-2"/>
            Masuk
        </x-button-primary>
    </div>
</div>
