<div class="flex flex-col space-y-3" x-data="{ isImportOpen: false }">
    <x-breadcrumbs>
        <x-breadcrumbs-link current="true">Guru</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header>Data Guru
        <x-slot:action>
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2"/>
                <span>Tambah Guru</span>
            </x-dropdown-link>
            
            <x-dropdown-link @click="isImportOpen = true">
                <x-fas-file-import class="h-4 w-4 mr-2"/>
                <span>Import Excel</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportExcel">
                <x-fas-file-excel class="h-4 w-4 mr-2"/>
                <span>Export Excel</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportPDF">
                <x-fas-file-pdf class="h-4 w-4 mr-2"/> 
                <span>Export PDF</span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">
        <div class="w-full overflow-x-auto">
            <livewire:pages.teacher.teacher-table :key="time()"/>
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{ $isEdit ? 'Edit' : 'Tambah' }} Data Guru</h3>
                </x-slot>

                <div class="flex flex-col space-y-2 px-4 py-6">
                    <x-input inline="false" label="NIP*" model="nip"/>
                    <x-input inline="false" label="Nama Guru*" model="name"/>
                </div>
            </x-modal>
        </form>

        @include('livewire.pages.teacher.teacher-import')

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
