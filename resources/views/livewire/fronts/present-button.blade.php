<!-- Tombol Presensi dan Refresh -->
<div x-data="{
        latitude: null,
        longitude: null,
        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    this.latitude = position.coords.latitude;
                    this.longitude = position.coords.longitude;

                    // Kirimkan lokasi ke Livewire
                    @this.set('userLatitude', this.latitude);
                    @this.set('userLongitude', this.longitude);
                },(error) => {
                    console.error(error);
                });
            }
        }
    }" x-init="getLocation()">

@if(!$isActive and $activator==1)
    @if($isLoading)
        <div class="mt-6 p-4 bg-blue-500 text-white rounded-lg">
            <div class="flex items-center space-x-2">
                <span class="font-semibold">Mendeteksi lokasi…</span>
                <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </div>
        </div>
    @else
        <div class="mt-6 p-4 bg-amber-500 text-white rounded-lg shadow-md transition-colors duration-300 dark:bg-amber-700 dark:text-gray-100">
            <div class="flex items-center space-x-2">
                <x-fas-exclamation-triangle class="text-amber-700 dark:text-amber-300 w-5 h-5" />
                <span class="font-semibold">Lokasi di luar area presensi.</span>
            </div>
            <p class="mt-2 text-sm">Silakan pindah tempat sampai muncul tombol untuk presensi.</p>
        </div>
    @endif
@endif

<div class="mt-6 flex justify-between space-x-4">
    <x-button-secondary wire:click="$refresh" class="py-4">
        <x-fas-sync-alt class="w-4 h-4"/>
    </x-button-secondary>
    
    @if($isActive)
        {{-- Tombol Masuk hanya tampil jika waktu sekarang di antara checkin_start dan checkin_end --}}
        @if ($now >= $checkin_start && $now <= $checkin_end)
            @if ($todayCheckIn)
                <x-button-primary class="opacity-50"> Sudah Presensi </x-button-primary>
            @elseif ($now < $checkin_time)
                <x-button-primary wire:click="checkIn"
                    wire:loading.attr="disabled"
                    wire:target="checkIn"
                >
                    <x-fas-circle-notch wire:loading wire:target="checkIn" class="w-4 h-4 mr-2 animate-spin"/>
                    <x-fas-sign-in-alt wire:loading.remove wire:target="checkIn" class="w-4 h-4 mr-2"/>
                    Masuk (On Time)
                </x-button-primary>
            @else
                <x-button-danger wire:click="checkIn"
                    wire:loading.attr="disabled"
                    wire:target="checkIn"
                >
                    <x-fas-circle-notch wire:loading wire:target="checkIn" class="w-4 h-4 mr-2 animate-spin"/>
                    <x-fas-sign-in-alt wire:loading.remove wire:target="checkIn" class="w-4 h-4 mr-2"/>
                    Masuk (Telat)
                </x-button-danger>
            @endif
        @endif

        {{-- Tombol Pulang hanya tampil jika waktu sekarang di antara checkout_start dan checkout_end --}}
        @if ($now >= $checkout_start && $now <= $checkout_end)
            @if ($todayCheckOut)
                <x-button-primary class="opacity-50"> Sudah Presensi </x-button-primary>
            @else
                <x-button-primary wire:click="checkOut"
                    wire:loading.attr="disabled"
                    wire:target="confirm"
                >
                    <x-fas-circle-notch wire:loading wire:target="confirm" class="w-4 h-4 mr-2 animate-spin"/>
                    <x-fas-sign-out-alt wire:loading.remove wire:target="confirm" class="w-4 h-4 mr-2"/>
                    Pulang 
                </x-button-primary>
            @endif
        @endif
    @endif
</div>
</div>