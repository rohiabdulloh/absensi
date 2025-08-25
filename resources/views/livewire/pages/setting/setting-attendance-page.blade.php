<div class="flex flex-col space-y-3" >

    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Waktu dan Metode Presensi</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Waktu dan Metode Presensi </x-page-header>

    <form wire:submit.prevent="save">
    <x-card class="min-h-full">            
        <section class="space-y-4">
            <h3 class="text-xl font-semibold">Waktu Presensi</h3>            
            <p class="text-gray-600 dark:text-gray-300">
                Jam masuk akan menjadi batas apakah presensi dihitung <b>On Time (H) </b> atau <b>Telat (T)</b>.
                Batas awal dan batas akhir presensi masuk dan pulang akan menentukan tombol presensi akan ditampilkan. 
                Di luar waktu tersebut, tombol tidak akan tampil.
            </p>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <x-input inline="false" label="Jam Masuk" model="checkin_time" type="time" />
                <x-input inline="false" label="Batas Awal Presensi Masuk" model="checkin_start" type="time" />
                <x-input inline="false" label="Batas Akhir Presensi Masuk" model="checkin_end" type="time" />
                <x-input inline="false" label="Batas Awal Presensi Pulang" model="checkout_start" type="time" />
                <x-input inline="false" label="Batas Akhir Presensi Pulang" model="checkout_end" type="time" />
                <x-select inline="false" label="Sabtu Libur" model="saturday_off">
                    <option value="Y">Ya</option>
                    <option value="N">Tidak</option>
                </x-select>
            </div>
        </section>

        <!-- Metode Presensi -->
        <section class="space-y-4 mt-6">
            <h3 class="text-xl font-semibold">Metode Presensi</h3>                       
            <p class="text-gray-600 dark:text-gray-300">
                Jika menggunakan deteksi lokasi, tombol presensi akan tampil jika berada di radius lokasi presensi. 
                Lokasi dan radius dapat diatur melalui menu <b>Pengaturan > Lokasi Presensi</b>.
                Metode deteksi jaringan hanya bisa digunakan jika aplikasi menggunakan server lokal.
            </p>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-select inline="false" label="Menampilkan Tombol Absen" model="button_activator">
                    <option value="0">Selalu Tampil</option>
                    <option value="1">Deteksi Lokasi</option>
                    <option value="2">Deteksi Jaringan (Lokal/Publik)</option>
                </x-select>
                <x-select inline="false" label="Metode Absen" model="present_method">
                    <option value="0">Tombol Saja</option>
                    <option value="1">Foto Selfi</option>
                </x-select>
            </div>
        </section>

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