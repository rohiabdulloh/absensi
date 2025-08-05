<!-- Tampilan di desktop -->
<div class="hidden md:block">
    <x-card class="min-h-full">
    <x-table>
        <x-slot:thead>
            <th scope="col" class="px-6 py-3">Tanggal</th>
            <th scope="col" class="px-6 py-3">Masuk</th>
            <th scope="col" class="px-6 py-3">Pulang</th>
            <th scope="col" class="px-6 py-3 text-center">Ket.</th>
        </x-slot:thead>
        @foreach ($attendanceData as $item)
            @php
                $dayOfWeek = \Carbon\Carbon::parse($item['date'])->dayOfWeek;
                $rowClass = '';
                if($dayOfWeek == \Carbon\Carbon::SATURDAY and $saturdayOff=='Y') $rowClass = 'bg-gray-100 dark:bg-gray-700';
                if($dayOfWeek == \Carbon\Carbon::SUNDAY) $rowClass = 'bg-gray-100 dark:bg-gray-700';
            @endphp
            <tr class="{{ $rowClass }}">
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item['date'])->translatedFormat('l, d F Y') }}</td>
                <td class="px-6 py-4">{{ $item['check_in'] }}</td>
                <td class="px-6 py-4">{{ $item['check_out'] }}</td>
                <td class="px-6 py-4 text-center">
                    @if($item['status'] == 'H') <span class="text-green-500 font-bold">{{ $item['status'] }}</span>
                    @elseif($item['status'] == 'S' or $item['status'] == 'I') <span class="text-purple-500 font-bold">{{ $item['status'] }}</span>
                    @elseif($item['status'] == 'A') <span class="text-red-500 font-bold">{{ $item['status'] }}</span>
                    @elseif($item['status'] != '-') <span class="text-orange-500 font-bold">{{ $item['status'] }}</span>
                    @else {{ $item['status'] }}
                    @endif
                </td>
            </tr>
        @endforeach
    </x-table>
    </x-card>
</div>