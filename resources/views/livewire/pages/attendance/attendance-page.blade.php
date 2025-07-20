<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link current="true">Data Presensi</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Presensi
        <x-slot:filter>                   
            <div class="w-80">
                <x-select label="Kelas" model="class" labelautosize="true" live="true">
                    <option value="0">Semua Kelas</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </x-select>
            </div>     
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">

        <div class="w-full overflow-x-auto">
            <livewire:pages.attendance.attendance-table :year="$year" :class="$class" :key="time()"/>
        </div>
        
    </x-card>
</div>
