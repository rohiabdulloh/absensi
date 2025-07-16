<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Pengaturan Aplikasi</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Pengaturan Aplikasi </x-page-header>

    <form wire:submit.prevent="save">
    <x-card class="min-h-full">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="flex flex-col space-y-2">
                <x-input inline="false" label="Jam Masuk" model="checkin_time" type="time" />
                <x-input inline="false" label="Batas Awal Presensi Masuk" model="checkin_start" type="time" />
                <x-input inline="false" label="Batas Akhir Presensi Masuk" model="checkin_end" type="time" />
                <x-select inline="false" label="Sabtu Libur" model="saturday_off">
                    <option value="Y">Ya</option>
                    <option value="N">Tidak</option>
                </x-select>
            </div>
            
            <div class="flex flex-col space-y-2">
                <x-input inline="false" label="Jam Pulang" model="checkout_time" type="time" />
                <x-input inline="false" label="Batas Awal Presensi Pulang" model="checkout_start" type="time" />
                <x-input inline="false" label="Batas Akhir Presensi Pulang" model="checkout_end" type="time" />
            </div>
        </div>

        <x-alert/>
        
        <x-slot name="footer">
            <x-button-primary type="submit" color="primary" class="mt-2">
                <x-fas-save class="h-4 w-4"/>    
                <span> Simpan Perubahan</span>
            </x-button-primary>
        </x-slot>
    </x-card>
    </form>
</div>