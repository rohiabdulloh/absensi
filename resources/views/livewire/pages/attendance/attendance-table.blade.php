<x-table>
    <x-slot:thead>
        <tr>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">No. Id</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Nama Pekerja</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Tgl/Waktu</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">No. PIN</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Kode Verifikasi</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">No. Kartu</th>
        </tr>
    </x-slot>
    @forelse($attendances as $att)
        <tr class="border-b dark:border-gray-700">
            <td class="py-3 px-2  border dark:border-gray-700">{{ $att->noid }}</td>
            <td class="py-3 px-2  border dark:border-gray-700">{{ ($att->worker) ? $att->worker->name : '' }}</td>
            <td class="py-3 px-2  border dark:border-gray-700">{{ $att->attendance_time }}</td>
            <td class="py-3 px-2  border dark:border-gray-700">{{ $att->no_pin }}</td>
            <td class="py-3 px-2  border dark:border-gray-700">{{ $att->verification_code }}</td>
            <td class="py-3 px-2  border dark:border-gray-700">{{ $att->no_card}}</td>
        </tr>
    @empty
        <tr class="border-b dark:border-gray-700">
            <td class="py-3 px-2  border dark:border-gray-700 text-center" colspan="6">Tidak ada data untuk ditampilkan. Pastikan telah memilih rentang waktu yang akan ditampilkan.</td>
        </tr>
    @endforelse
</x-table>