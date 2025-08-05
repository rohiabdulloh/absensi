<!-- Mobile View -->
<div class="block md:hidden space-y-6">
    @forelse($students as $student)
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="mb-2">
                <p class="text-sm text-gray-500">NIS</p>
                <p class="font-semibold">{{ $student['nis'] }}</p>
            </div>

            <div class="mb-2">
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-semibold">{{ $student['name'] }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-semibold">Hadir (H)</span>
                    <span>{{ $student['h'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-purple-500 font-semibold">Izin (I)</span>
                    <span>{{ $student['i'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-green-500 font-semibold">Sakit (S)</span>
                    <span>{{ $student['s'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-red-500 font-semibold">Alpa (A)</span>
                    <span>{{ $student['a'] }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-gray-600 dark:text-gray-300">Tidak ada data siswa</div>
    @endforelse
</div>
