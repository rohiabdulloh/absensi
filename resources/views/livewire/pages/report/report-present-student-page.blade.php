<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}" >
    <x-breadcrumbs>
        <x-breadcrumbs-link>Laporan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Data Presensi  Siswa</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Laporan Data Presensi Siswa
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
                
                <div class="pr-2">Tahun: </div>
                <div class="w-full md:w-40">
                    <x-select label="" model="year" live="true">
                        @foreach($periods as $period)
                            <option value="{{ $period->year_start }}">{{ $period->year_start }}/{{ $period->year_end }}</option>
                        @endforeach
                    </x-select>
                </div>
                  
                <div class="pr-2">Bulan: </div>
                <div class="w-full md:w-40">
                    <x-select label="" model="month" live="true">
                        @foreach($monthList as $key=>$val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </x-select> 
                </div>

                <div class="pr-2">Kelas: </div>
                <div class="w-full md:w-36">
                    <x-select label="" model="class" live="true">
                        <option value="0">-- Pilih --</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </x-select> 
                </div>

                <div class="pr-2">Siswa: </div>
                <div class="w-full md:w-64">
                    <x-select label="" model="student" live="true">
                        <option value="0">-- Pilih --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </x-select> 
                </div>
                
            </div>
        </x-slot>

        <x-table>
            <x-slot:thead>
                <th scope="col" class="px-6 py-3">Tanggal</th>
                <th scope="col" class="px-6 py-3">Masuk</th>
                <th scope="col" class="px-6 py-3">Pulang</th>
                <th scope="col" class="px-6 py-3 text-center">Ket.</th>
            </x-slot:thead>
            @forelse ($datareport as $item)
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
            @empty
                <tr>
                    <td class="px-6 py-4 text-center" colspan="4">
                        Tidak ada data untuk ditampilkan. Pastikan telah memilih siswa yang akan ditampilkan datanya.
                    </td>
                </tr>
            @endforelse
        </x-table>

    </x-card>
</div>
