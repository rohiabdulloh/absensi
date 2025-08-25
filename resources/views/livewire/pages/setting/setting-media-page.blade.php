<div class="flex flex-col space-y-3">

    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Penghapusan Foto</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Penghapusan Foto</x-page-header>

    <form wire:submit.prevent="save">
    <x-card class="min-h-full">
        <div class="col-span-2 mt-8 space-y-4">
             <p class="text-gray-600 dark:text-gray-300">
                Penghapusan otomatis hanya bisa dijalankan jika server mendukung fitur cron job atau penjadwalan tugas otomatis. 
                Jika penghapusan otomatis tidak aktif, penghapusan foto dapat dilakukan melalui menu <b>Presensi > Foto Presensi</b>.
            </p>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <x-select inline="false" label="Hapus Foto Otomatis" model="delete_image_on">
                    <option value="Y">Aktif</option>
                    <option value="N">Tidak Aktif</option>
                </x-select>
                <x-input type="number" inline="false" label="Batas Penghapusan (Hari)" model="delete_image_limit" 
                    :readonly="$delete_image_on=='N'"
                    :class="$delete_image_on == 'N' ? 'opacity-50 cursor-not-allowed' : ''"/>
                <x-select inline="false" label="Waktu Penghapusan"
                    model="delete_image_time"
                    :disabled="$delete_image_on == 'N'"
                    :class="$delete_image_on == 'N' ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    @foreach(range(0, 24) as $hour)
                        @php
                            $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
                        @endphp
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
        <x-alert/>
        
        <x-slot name="footer">
            <x-button type="submit" color="blue" class="mt-2">
                <x-fas-save class="h-4 w-4"/>    
                <span> Simpan Perubahan</span>
            </x-button>
        </x-slot>
    </x-card>
    </form>

</div>