
<form wire:submit.prevent="save">
<x-card class="w-1/2">
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Logo Aplikasi</h2>
    </x-slot>

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
        <x-button type="submit" color="primary" class="mt-2">
            <x-fas-save class="h-4 w-4"/>    
            <span> Simpan </span>
        </x-button>
    </x-slot>
</x-card>
</form>
