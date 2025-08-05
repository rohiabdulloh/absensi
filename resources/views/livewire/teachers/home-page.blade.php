<div class="max-w-4xl mx-auto px-6 py-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <!-- Header Guru -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">
            Selamat datang, <span class="text-blue-600 dark:text-blue-400">{{ $teacher->name ?? 'Guru' }}</span>!
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 mt-1">
            Wali Kelas: 
            <span class="text-green-600 dark:text-green-400">
                {{ $classroom->name ?? 'Belum ada kelas' }}
            </span>
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
            Tanggal hari ini: 
            <span class="font-medium text-indigo-600 dark:text-indigo-400">
                {{ \Carbon\Carbon::now()->format('d-m-Y') }}
            </span>
        </p>
    </div>

    <!-- Statistik Kehadiran -->
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Hadir -->
        <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg shadow-inner text-center">
            <p class="text-lg font-medium text-blue-800 dark:text-blue-300 mb-2">
                Siswa Hadir
            </p>
            <p class="text-4xl font-bold text-blue-600 dark:text-blue-200">
                {{ $presentCount }}
            </p>
        </div>

        <!-- Absen -->
        <div class="bg-red-50 dark:bg-red-900 p-6 rounded-lg shadow-inner text-center">
            <p class="text-lg font-medium text-red-800 dark:text-red-300 mb-2">
                Siswa Absen
            </p>
            <p class="text-4xl font-bold text-red-600 dark:text-red-200">
                {{ $absentCount }}
            </p>
        </div>
    </div>

    <!-- Catatan -->
    <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
        Data berdasarkan kehadiran siswa pada tanggal <strong>{{ \Carbon\Carbon::now()->format('d M Y') }}</strong>.
    </div>
</div>
