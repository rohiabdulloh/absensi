<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Tahun Ajaran</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header dropdownWidth="64"> Data Tahun Ajaran
        <x-slot:button>
            <x-button-primary @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah</span>
            </x-button-primary>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">
        <div class="w-full overflow-x-auto">
            <livewire:pages.period.period-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{ $isEdit ? 'Edit' : 'Tambah' }} Tahun Ajaran</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">
                    <x-input inline="false" label="Tahun Awal*" model="year_start" type="number" />
                    <x-input inline="false" label="Tahun Akhir*" model="year_end" type="number" />
                    <x-select inline="false" label="Aktif*" model="is_active">
                        <option value="Y">Ya</option>
                        <option value="N">Tidak</option>
                    </x-select>
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Are you sure want to delete this data?</x-confirm-delete>
        <x-alert />
    </x-card>
</div>
