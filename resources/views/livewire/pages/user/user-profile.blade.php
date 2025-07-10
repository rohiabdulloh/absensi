
<form wire:submit.prevent="save">
<x-card class="w-1/2">
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Profil User</h2>
    </x-slot>

        <div class="flex flex-col space-y-4 mb-4">  
            <x-input label="Nama User" model="name" inline="false"/>  
            <x-input label="Email" model="email" inline="false"/>  
            <x-input type="password" label="Password" model="password" inline="false"/>  
        </div>
        <x-dropzone accept="image/*" label="Foto Profil" model="filePhoto" fileurl="{{$photo}}" inline="false">
            @if($filePhoto)
                <img src="{{ $filePhoto->temporaryUrl() }}" width="150">    
            @elseif($photo) 
                <img src="/storage/user/{{$photo}}" width="150">
            @endif 
        </x-dropzone> 

    <x-alert/>
    
    <x-slot name="footer">
        <x-button-primary type="submit" color="primary" class="mt-2">
            <x-fas-save class="h-4 w-4"/>    
            <span> Simpan </span>
        </x-button-primary>
    </x-slot>
</x-card>
</form>
