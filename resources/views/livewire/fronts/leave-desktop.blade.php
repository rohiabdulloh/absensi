<!-- Tampilan di desktop -->
<div class="hidden md:block">
    <x-table>
        <x-slot:thead>
            <th scope="col" class="px-6 py-3">Tanggal Pengajuan</th>
            <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
            <th scope="col" class="px-6 py-3">Tanggal Selesai</th>
            <th scope="col" class="px-6 py-3">Tipe Ijin</th>
            <th scope="col" class="px-6 py-3 text-center">Status</th>
            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
        </x-slot:thead>
        @forelse ($leaves as $item)
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
            <tr>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y') }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->date_start)->translatedFormat('d F Y') }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->date_end)->translatedFormat('d F Y') }}</td>
                <td class="px-6 py-4">{{ $leaveType }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="{{ $statusClass }}">{{ $item->status }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    @if($item->status == 'Menunggu')
                    <div class="flex justify-end space-x-1">
                        <!-- Tombol Edit -->
                        <x-button-circle wire:click="edit({{ $item->id }})">
                            <x-fas-edit class="h-3 w-3 text-white" />
                        </x-button-circle>

                        <!-- Tombol Hapus -->
                        <x-button-circle color="red-500" onclick="isConfirmOpen=true"
                            wire:click="confirm({{ $item->id }})">
                            <x-fas-trash class="h-3 w-3 text-white" />
                        </x-button-circle>
                    </div>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td class="px-6 py-4 text-center" colspan="6">Belum ada data pengajuan</td>
            </tr>
        @endforelse
    </x-table>
</div>
