<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}" >
    <x-breadcrumbs>
        <x-breadcrumbs-link>Laporan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Data Siswa Teralambat</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Laporan Data Siswa Terlambat
        <x-slot:action>     
            <x-dropdown-link wire:click="exportExcel({{$datareport}})" > 
                <x-fas-file-excel class="h-4 w-4 mr-2"/> 
                <span>Export Excel </span>
            </x-dropdown-link>
            
            <x-dropdown-link wire:click="exportPDF({{$datareport}})"> 
                <x-fas-file-pdf class="h-4 w-4 mr-2"/> 
                <span>Export PDF </span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>


    <x-card class="min-h-full">      
        <x-slot:header>
            <div class="flex flex-col md:flex-row gap-3 items-start md:items-center">
                <div class="pr-2">Tanggal: </div>
                <div class="w-full md:w-40">
                    <x-input-date inline="true" label="" model="date" :live="true"/>  
                </div>

                <div class="pr-2">Kelas: </div>
                <div class="w-full md:w-64">
                    <x-select label="" model="class" live="true">
                        <option value="0">Semua Kelas</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </x-select> 
                </div>
            </div>
        </x-slot>

        <x-table>
            <x-slot:thead>
                <x-table-tr>
                    <x-table-th>NO</x-table-th>
                    <x-table-th>NIS</x-table-th>
                    <x-table-th>Nama Siswa</x-table-th>
                    <x-table-th>Kelas</x-table-th>
                    <x-table-th>Masuk</x-table-th>
                    <x-table-th>Keterangan</x-table-th>
                </x-table-tr>
            </x-slot>
            @forelse($datareport as $data)
                <x-table-tr>
                    <x-table-td>{{ $loop->iteration }}</x-table-td>
                    <x-table-td>{{ $data->student_nis }}</x-table-td>
                    <x-table-td>{{ $data->student_name }}</x-table-td>
                    <x-table-td>{{ $data->class_name }}</x-table-td>
                    <x-table-td>{{ $data->attendance_checkin }}</x-table-td>
                    <x-table-td>{{ $data->attendance_status }}</x-table-td>
                </x-table-tr>
            @empty
                <x-table-tr>
                    <x-table-td class="text-center" colspan="6">
                        Tidak ada data untuk ditampilkan. Pastikan telah memilih tanggal yang akan ditampilkan.
                    </x-table-td>
                </x-table-tr>
            @endforelse
        </x-table>

    </x-card>
</div>
