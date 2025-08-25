
<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Ubah Logo</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Ubah Logo </x-page-header>
    <form wire:submit.prevent="save">
    <x-card class="min-h-full">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-dropzone accept="image/*" label="Logo" model="fileLogo" fileurl="{{$logo}}" inline="false">
                @if($fileLogo)
                    <img src="{{ $fileLogo->temporaryUrl() }}" width="150">    
                @elseif($logo) 
                    <img src="{{$logo}}" width="150">
                @endif 
            </x-dropzone> 

            <x-dropzone accept="image/*" label="Favicon" model="fileFavicon" fileurl="{{$favicon}}" inline="false">
                @if($fileFavicon)
                    <img src="{{ $fileFavicon->temporaryUrl() }}" width="150">    
                @elseif($favicon) 
                    <img src="{{$favicon}}" width="150">
                @endif 
            </x-dropzone> 
        </div>

        <x-alert/>
        
        <x-slot name="footer">
            <x-button-primary type="submit" class="mt-2">
                <x-fas-save class="h-4 w-4"/>    
                <span> Simpan Perubahan</span>
            </x-button-primary>
        </x-slot>
    </x-card>
    </form>
</div>
