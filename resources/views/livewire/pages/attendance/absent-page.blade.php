<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Presensi</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Siswa Alfa</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Siswa Alfa
        <x-slot:button>                   
           
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">

        <div class="w-full overflow-x-auto">
            <livewire:pages.attendance.absent-table  :year="$year" />
        </div>
        
    </x-card>
</div>
