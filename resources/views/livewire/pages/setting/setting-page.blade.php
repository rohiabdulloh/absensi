<div class="flex flex-col space-y-3"  
    x-data="setData()"
    x-init="initMap">

    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Pengaturan Aplikasi</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Pengaturan Aplikasi </x-page-header>

    <form wire:submit.prevent="save">
    <x-card class="min-h-full">
            
            <div class="col-span-2 mt-4 space-y-4">
                <h3 class="text-xl font-semibold">Waktu Presensi</h3>
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
            </div>

            <div class="col-span-2 mt-4 space-y-4">
                <h3 class="text-xl font-semibold">Pesan Whatsapp</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input inline="false" label="Whatsapp Api Key" model="wa_apikey" type="text" />
                    <x-input inline="false" label="Whatsapp Secret Key" model="wa_secretkey" type="text" />
                </div> 
                <div class="col-span-2">
                    <x-textarea inline="false" label="Template Pesan Whatsapp" model="wa_message" />
                </div>
            </div>

            <div class="col-span-2 mt-8 space-y-4">
                <h3 class="text-xl font-semibold">Metode Presensi</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <x-select inline="false" label="Menampilkan Tombol Absen" model="button_activator">
                        <option value="0">Selalu Tampil</option>
                        <option value="1">Deteksi Lokasi</option>
                        <option value="2">Deteksi Jaringan (Lokal/Publik)</option>
                    </x-select>
                    <x-select inline="false" label="Metode Absen" model="present_method">
                        <option value="0">Tombol Saja</option>
                        <option value="1">Foto Selfi</option>
                        <option value="2">QR Code</option>
                    </x-select>
                </div>
            </div>

            <!-- Lokasi Presensi -->             
            <div class="col-span-2 mt-4 space-y-4">
                <h3 class="text-xl font-semibold">Lokasi Presensi</h3>

                <div x-ref="map" class="w-full h-64 rounded-lg border" wire:ignore></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-input inline="false" label="Latitude" model="absen_latitude" x-model="lat" type="text" />
                    <x-input inline="false" label="Longitude" model="absen_longitude"  x-model="lng" type="text" />
                    <x-input inline="false" label="Radius (meter)" model="absen_radius" type="number" min="10" />
                </div>                
                <div class="col-span-2">
                    <x-input inline="false" label="Nama Lokasi" model="absen_location" x-model="locationName" />
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

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    function setData(){
        return {
            lat: @entangle('absen_latitude'),
            lng: @entangle('absen_longitude'),
            locationName: @entangle('absen_location'),
            map: null,
            marker: null,
            initMap() {
                this.map = L.map(this.$refs.map).setView([this.lat || 0, this.lng || 0], this.lat && this.lng ? 13 : 2);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(this.map);

                const addDraggableMarker = (lat, lng) => {
                    if (this.marker) {
                        this.map.removeLayer(this.marker);
                    }

                    this.marker = L.marker([lat, lng], { draggable: true }).addTo(this.map);

                    this.marker.on('dragend', async (event) => {
                        const position = event.target.getLatLng();
                        this.lat = position.lat;
                        this.lng = position.lng;
                        
                        await this.fetchLocation(position.lat, position.lng);
                    });
                };

                this.map.on('click', async (e) => {
                    this.lat = e.latlng.lat;
                    this.lng = e.latlng.lng;
                    addDraggableMarker(this.lat, this.lng);
                    await this.fetchLocation(this.lat, this.lng);
                });

                // Jika sudah ada koordinat awal
                if (this.lat && this.lng) {
                    addDraggableMarker(this.lat, this.lng);
                }
            },
            async fetchLocation(lat, lng) {
                try {
                    // Menggunakan Nominatim API untuk reverse geocoding
                    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
                    const data = await response.json();
                    
                    if (data.display_name) {
                        // Update variabel Alpine.js, yang otomatis akan memperbarui Livewire
                        this.locationName = data.display_name;
                    } else {
                        this.locationName = 'Lokasi tidak ditemukan';
                    }
                } catch (error) {
                    console.error('Error fetching location name:', error);
                    this.locationName = 'Gagal mengambil nama lokasi';
                }
            }
        };
    }
    </script>
    @endpush
</div>