<div  x-data="" x-on:open-modal.window="isModalOpen = true"
    x-on:close-modal.window="isModalOpen = false"
>
    {{-- Menggunakan komponen backdrop --}}
    <x-backdrop show="isModalOpen" onclose="isModalOpen = false"/>

    {{-- Mengatur animasi modal --}}
    <div
        x-transition:enter="transition duration-300 ease-in-out transform"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition duration-300 ease-in-out transform"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        x-show="isModalOpen"
        class="fixed left-0 top-0 z-20 w-full h-full flex items-center justify-center"
    >
        <div {{ $attributes->merge(['class' =>"flex flex-col w-full h-full md:h-auto max-h-full bg-white rounded-md shadow-xl opacity-100
            dark:bg-gray-800 dark:border-gray-700"]) }}>
            {{-- Modal header --}}
            <div class="flex items-center justify-between p-4 rounded-t-md border-b bg-gray-100 text-gray-500 
                dark:bg-gray-800 dark:text-light dark:border-gray-700">
                <div>
                    @isset($header) {{$header}} @endisset
                </div>
                       
                <button type="button"  @click="isModalOpen=false" wire:click="resetForm()" >
                    <x-fas-times class="w-4 h-4"/>
                </button>
            </div>

            {{-- Modal content--}}
            <div class="flex-1 relative p-4 overflow-y-auto">
                {{$slot}}
            </div>

            {{-- Modal footer --}}
            @if(isset($footer))
                {{$footer}}
            @else
            <div class="flex items-center justify-between p-4 border-t text-gray-500 dark:text-light
                dark:border-gray-700">
                <x-button @click="isModalOpen=false" wire:click="resetForm()" color="red">
                    <x-fas-times-circle class="h-4 w-4"/>    
                    <span> Batal </span>
                </x-button>
                
                @if(isset($action))
                    {{$action}}
                @else
                    <x-button-primary type="submit" color="primary">
                        <x-fas-save class="h-4 w-4"/>    
                        <span> Simpan </span>
                    </x-button-primary>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>