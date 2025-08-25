<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Presensi</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Siswa Absen</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Siswa Absen
        
        <x-slot:button>
            <x-button wireclick="sendMessage" color="green">
                <x-fab-whatsapp class="h-4 w-4 mr-2"/>
                <span>Kirim Pesan Semua</span>
            </x-button>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">

        <div class="w-full overflow-x-auto">
            <livewire:pages.attendance.absent-table  :year="$year" />
        </div>
        
    </x-card>
</div>
