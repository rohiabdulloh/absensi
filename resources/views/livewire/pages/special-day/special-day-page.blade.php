<div class="flex flex-col space-y-3">
    {{-- Breadcrumbs --}}
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Hari Spesial</x-breadcrumbs-link>
    </x-breadcrumbs>

    {{-- Page Header --}}
    <x-page-header dropdownWidth="64">
        Hari Spesial
        <x-slot:button>
            <x-button-primary @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2"/>
                <span>Tambah</span>
            </x-button-primary>
        </x-slot>
    </x-page-header>

    {{-- Table & Form --}}
    <x-card class="min-h-full">
        <div class="w-full overflow-x-auto">
            <livewire:pages.special-day.special-day-table />
        </div>

        {{-- Modal Form --}}
        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{ $isEdit ? 'Edit' : 'Tambah' }} Hari Spesial</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">
                    <x-input-date label="Tanggal*" model="date" inline="false" />

                    <x-select label="Tipe*" model="type" inline="false">
                        <option value="">-- Pilih --</option>
                        <option value="OFF">Hari Libur</option>
                        <option value="FM">Gangguan Sistem</option>
                        <option value="HB">Hari Besar</option>
                    </x-select>

                    <x-input label="Deskripsi" model="description" inline="false" />
                </div>
            </x-modal>
        </form>

        {{-- Modal Konfirmasi Hapus --}}
        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>

        {{-- Alert --}}
        <x-alert />
    </x-card>
</div>
