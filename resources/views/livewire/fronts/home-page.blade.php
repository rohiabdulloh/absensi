<!-- resources/views/livewire/fronts/home-page.blade.php -->
<div class="max-w-4xl mx-auto px-4 py-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
@if($presentScreen==1)
    <livewire:fronts.face-scanner/>
@elseif($presentScreen==2)
    <livewire:fronts.qr-scanner/>
@else
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

    @include('livewire.fronts.present-button')

    <x-confirm>Yakin akan melakukan presensi pulang?</x-confirm>
@endif
</div>
