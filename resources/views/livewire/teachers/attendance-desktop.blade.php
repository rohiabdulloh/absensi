<div class="hidden md:block">
    <x-card class="min-h-full">
    <x-table>
        <x-slot:thead>
            <th scope="col" class="px-6 py-3">No</th>
            <th scope="col" class="px-6 py-3">NIS</th>
            <th scope="col" class="px-6 py-3">Nama Siswa</th>
            <th scope="col" class="px-6 py-3 text-center">Check-in</th>
            <th scope="col" class="px-6 py-3 text-center">Check-out</th>
            <th scope="col" class="px-6 py-3 text-center">Status</th>
        </x-slot:thead>

        @forelse ($students as $index => $student)
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

            <tr>
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">{{ $student->nis }}</td>
                <td class="px-6 py-4">{{ $student->name }}</td>
                <td class="px-6 py-4 text-center">{{ $checkIn }}</td>
                <td class="px-6 py-4 text-center">{{ $checkOut }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="{{ $statusClass }}">{{ $statusText }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center px-6 py-4 text-gray-500">Belum ada data siswa.</td>
            </tr>
        @endforelse
    </x-table>
    </x-card>
</div>
