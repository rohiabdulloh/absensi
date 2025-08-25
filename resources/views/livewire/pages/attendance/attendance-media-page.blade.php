<div class="space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Presensi</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Foto Presensi</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Foto Presensi</x-page-header>

    <x-card class="min-h-[400px]">
        <div class="flex flex-wrap justify-between gap-4">
            <div class="flex gap-4 flex-col md:flex-row">
                <x-input-date model="selectedDate" label="Tanggal" labelautosize="true" live="true"/>
                <x-select model="absentType" label="Waktu Presensi" labelautosize="true" live="true">
                    <option value="checkin">Masuk</option>
                    <option value="checkout">Pulang</option>
                </x-select>
            </div>
            @if($canDelete)
            <x-button wireclick="openConfirmAll" color="red">                
                <x-fas-circle-notch wire:loading wire:target="deleteAllImage" class="w-4 h-4 mr-2 animate-spin"/>
                <x-fas-trash wire:loading.remove wire:target="deleteAllImage" class="w-4 h-4 mr-2"/>
                <span>Hapus Semua Foto</span>
            </x-button>
            @endif
        </div>
        
        @if ($attendances->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-4">
                @foreach ($attendances as $attendance)
                    <div class="relative group rounded overflow-hidden shadow border">
                        {{-- Foto --}}
                        @php
                            if($absentType=="checkin") $photo = $attendance->image_in;
                            else $photo = $attendance->image_out;
                        @endphp
                        <img
                            src="{{ asset('storage/selfies/' . $photo) }}"
                            alt="Photo"
                            class="object-cover w-full h-64 transition-transform duration-200 group-hover:scale-105"
                        >

                        @if($canDelete)
                        <button
                            wire:click="openConfirm({{ $attendance->id }})"
                            class="absolute bottom-2 right-2 bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-xs rounded shadow"
                        >
                            <x-fas-circle-notch wire:loading wire:target="deletePhoto" class="w-4 h-4 mr-2 animate-spin"/>
                            Hapus
                        </button>
                        @endif

                        {{-- Tanggal di pojok kiri atas --}}
                        <div class="absolute top-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded">
                            {{ $attendance->student->name ?? 'Tidak diketahui' }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $attendances->links() }}</div>
        @else
            <div class="text-xl text-center text-gray-500 mt-8">Tidak ada data presensi dengan foto.</div>
        @endif

        
        <x-confirm-delete>{{$deleteMessage}}</x-confirm-delete>
        <x-alert />
    </x-card>
</div>
