<div class="space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Presensi</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Foto Presensi</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Foto Presensi</x-page-header>

    <x-card>
        <div class="flex space-x-4 mb-4">
            <div>
                <x-input-date model="selectedDate" label="Tanggal" labelautosize="true"/>
            </div>
        </div>
        
        @if ($attendances->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-2">
                @foreach ($attendances as $attendance)
                    <div class="relative group rounded overflow-hidden shadow border">
                        {{-- Foto --}}
                        <img
                            src="{{ asset('storage/attendance/' . $attendance->photo) }}"
                            alt="Photo"
                            class="object-cover w-full h-64 transition-transform duration-200 group-hover:scale-105"
                        >

                        {{-- Tombol Hapus (posisi kanan bawah) --}}
                        <button
                            wire:click="deletePhoto({{ $attendance->id }})"
                            class="absolute bottom-2 right-2 bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-xs rounded shadow"
                        >
                            Hapus
                        </button>

                        {{-- Tanggal di pojok kiri atas --}}
                        <div class="absolute top-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded">
                            {{ $attendance->created_at->format('d M Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500 mt-4">Tidak ada data presensi dengan foto.</p>
        @endif

        
        <x-alert />
    </x-card>
</div>
