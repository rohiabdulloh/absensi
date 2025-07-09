<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Guru</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Wali Kelas</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header dropdownWidth="64"> Data Wali Kelas
        <x-slot:filter>                   
            <div class="w-80">
                <x-select label="Kelas" model="class" labelautosize="true" live="true">
                    <option value="0">Tanpa Kelas</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </x-select>
            </div>          
            <div class="w-80">
                <x-select label="Tahun Ajaran" model="year" labelautosize="true" live="true">
                    @foreach($periods as $period)
                        <option value="{{ $period->year_start }}">{{ $period->year_start }}/{{ $period->year_end }}</option>
                    @endforeach
                </x-select>
            </div>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">

        <div class="w-full overflow-x-auto">
            <livewire:pages.student.student-class-table :year="$year" :class="$class" :key="time()"/>
        </div>
        
        @include('livewire.pages.student.student-class-move')

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert />
    </x-card>
</div>
