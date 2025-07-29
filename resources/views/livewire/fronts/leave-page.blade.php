<div class="flex flex-col space-y-3">
    <x-page-header dropdownWidth="64"> Pengajuan Izin Tidak Masuk
        <x-slot:button>
            <x-button-primary @click="isModalOpen = true" class="mt-3 md:mt-0">
                <x-fas-plus-circle class="h-4 w-4 mr-2"/>
                <span>Buat Pengajuan</span>
            </x-button-primary>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">
        {{-- Tabel dibuat di halaman lain --}}        

        @include('livewire.fronts.leave-desktop')
        @include('livewire.fronts.leave-mobile')

        {{-- Modal Form Tambah/Edit Cuti --}}
        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/2">
                <x-slot name="header">
                    <h3>{{ $isEdit ? 'Edit' : 'Ajukan' }} Izin Tidak Masuk</h3>
                </x-slot>
                <div class="flex flex-col space-y-4">
                    <x-input-date label="Tanggal Mulai*" model="date_start" inline="false" />
                    <x-input-date label="Tanggal Selesai*" model="date_end" inline="false" />
                    <x-select label="Jenis Cuti*" model="type" inline="false">
                        <option value="">Pilih Jenis</option>
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </x-select>
                    <x-input type="text" label="Keterangan*" model="description" inline="false" />
                    <x-dropzone accept="image/*" label="Upload Bukti" model="filePhoto" fileurl="{{$photo}}" inline="false">
                        @if($filePhoto)
                            <img src="{{ $filePhoto->temporaryUrl() }}" width="150">    
                        @elseif($photo) 
                            <img src="/storage/user/{{$photo}}" width="150">
                        @endif 
                    </x-dropzone>
                </div>
            </x-modal>
        </form>

        {{-- Konfirmasi Hapus & Alert --}}
        <x-confirm-delete>Yakin akan menghapus pengajuan cuti?</x-confirm-delete>
        <x-alert />
    </x-card>
</div>
