<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Guru</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Wali Kelas</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header dropdownWidth="64"> Data Wali Kelas
        <x-slot:filter>            
            <div class="w-80">
                <x-select label="Tahun Ajaran" model="year" labelautosize="true" live="true">
                    @foreach($periods as $period)
                        <option value="{{ $period->year_start }}">{{ $period->year_start }}/{{ $period->year_end }}</option>
                    @endforeach
                </x-select>
            </div>
        </x-slot>
        <x-slot:button>
            @if($year)
            <x-button-primary @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah</span>
            </x-button-primary>
            @else
            <x-button-primary class="opacity-50">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah</span>
            </x-button-primary>
            @endif
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">

        <div class="w-full overflow-x-auto">
            <livewire:pages.teacher.teacher-class-table :year="$year" :key="time()"/>
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/2">
                <x-slot name="header">
                    <h3>Tambah Wali Kelas</h3>
                </x-slot>
                <div class="flex flex-col space-y-4">
                    <x-select label="Guru*" model="teacher_id">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->nip }})</option>
                        @endforeach
                    </x-select>

                    <x-select label="Kelas*" model="class_id">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classrooms as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </x-select>
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert />
    </x-card>
</div>
