<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}" >
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Data Presensi</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Presensi
        <x-slot:action>                
            <x-dropdown-link @click="isImportOpen = true" > 
                <x-fas-file-import class="h-4 w-4 mr-2"/> 
                <span>Import Presensi </span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>


    <x-card class="min-h-full">      
        <div class="flex flex-row items-end">
            <div class="flex-1 grid grid-cols-1 gap-4 md:grid-cols-4">
                <x-select inline="false" label="Departemen" model="department" :live="true">  
                    <option value="0">Semua Departemen</option>
                    @foreach($departments as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                    @endforeach
                </x-select>
                <x-select inline="false" label="Karyawan" model="worker" :live="true">  
                    <option value="">Pilih Karyawan</option>
                    @foreach($workers as $w)
                        <option value="{{ $w->id }}">{{ $w->name }}</option>
                    @endforeach
                </x-select>
                <div></div>
                <div class="flex flex-col">
                    <div>Rentang Waktu:</div>
                    <div class="flex flex-row items-center">
                        <div class="pr-2">Dari: </div>
                        <x-input-date inline="true" label="" model="date_start" :live="true"/>  
                        <div class="px-2">s/d </div>
                        <x-input-date inline="true" label="" model="date_end" :live="true"/>  
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full overflow-x-auto mt-4">
            @include('livewire.pages.attendance.attendance-table')
            
           <div class="mt-2"> {{ $attendances->links() }} </div>
        </div>
    
        @include('livewire.pages.attendance.attendance-import')

    </x-card>
</div>
