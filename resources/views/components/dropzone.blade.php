@props(['label'=>'', 'model'=>'', 'fileurl'=>null, 'inline'=>'true', 'height'=> 48])
<div x-data="{file: null, isUploading: false }"
    x-on:livewire-upload-start="isUploading = true;"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:close-modal.window="file = null"
>
    @if($label!='')
    <div class="w-full {{ $inline=='true' ? 'md:w-48' : '' }}">
        <label>{{$label}}</label>
    </div>
    @endif

    {{-- Mengatur desain drop area --}}
    <div id="file-upload" class="h-{{$height}} block w-full py-2 px-3 relative appearance-none border border-gray-300 
         rounded-md dark:bg-gray-700 dark:border-gray-600 "
        x-on:dragover="$el.classList.add('border-primary')" 
        x-on:dragleave="$el.classList.remove('border-primary')" 
        x-on:drop="$el.classList.remove('border-primary')"
    >

    {{-- Membuat input file yang disembunyikan --}}
        <input type="file" wire:model.live="{{$model}}" {{$attributes}}
            class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
            x-on:change="file = ($event.target.files.length>0) ? $event.target.files[0] : null;"
        />
    
    {{-- Menampilkan animasi loading --}}
    <div x-show="isUploading" class="flex justify-center m-2">
        <div class="animate-spin w-20 h-20 my-3 border-1 border-t-2 rounded-full border-gray-300 dark:border-gray-600"></div>
    </div>

    {{-- Menampilkan file yang sudah diupload --}}
    <div x-show="!isUploading" class="flex flex-col space-y-2 items-center justify-center mb-2">
        {{$slot}}
        <template x-if="file !== null">
            <div x-text="file.name"></div>
        </template>
    </div>
    
    {{-- Menampilkan tombol upload --}}
    <template x-if="file === null">
        <div class="flex flex-col space-y-2 items-center justify-center">
            @if(!$fileurl)
            <x-fas-cloud-upload-alt class="w-10 h-10"/>
            <p class="text-gray-700 dark:text-gray-200">Drag your file here or click in this area.</p>
            @endif
            <x-button-primary color="primary">Select a file</x-button-primary>
        </div>
    </template>
    
    </div>

    @error($model)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>