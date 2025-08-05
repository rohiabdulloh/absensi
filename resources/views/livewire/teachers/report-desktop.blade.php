<!-- Desktop View -->
<div class="hidden md:block">
    <x-card class="min-h-full">
    <x-table>
        <x-slot:thead>
            <th class="px-6 py-3 text-left">NIS</th>
            <th class="px-6 py-3 text-left">Nama</th>
            <th class="px-6 py-3 text-center">Hadir (H)</th>
            <th class="px-6 py-3 text-center">Izin (I)</th>
            <th class="px-6 py-3 text-center">Sakit (S)</th>
            <th class="px-6 py-3 text-center">Alpa (A)</th>
        </x-slot:thead>

        @forelse($students as $student)
            <tr class="bg-white dark:bg-gray-800">
                <td class="px-6 py-4">{{ $student['nis'] }}</td>
                <td class="px-6 py-4">{{ $student['name'] }}</td>
                <td class="px-6 py-4 text-center text-gray-500 font-semibold">{{ $student['h'] }}</td>
                <td class="px-6 py-4 text-center text-purple-500 font-semibold">{{ $student['i'] }}</td>
                <td class="px-6 py-4 text-center text-green-500 font-semibold">{{ $student['s'] }}</td>
                <td class="px-6 py-4 text-center text-red-500 font-semibold">{{ $student['a'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-4">Tidak ada data siswa</td>
            </tr>
        @endforelse
    </x-table>
    </x-card>
</div>
