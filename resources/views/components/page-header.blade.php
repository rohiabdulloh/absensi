@props(['dropdownWidth' => '48'])
<div class="flex flex-col md:flex-row md:items-center justify-between">
    <h2 class="text-2xl font-bold"> {{ $slot }}</h2>
    <div class="flex space-x-2 justify-end">   
        @isset($filter)
            {{ $filter }} 
        @endisset
        
        @isset($button)       
            {{ $button }} 
        @endisset

        @isset($action)       
        <x-dropdown width="{{ $dropdownWidth }}" contentClasses="p-2 bg-white dark:bg-gray-700">
            <x-slot name="trigger">
                <x-button-primary> 
                    <span> Action </span>
                    <x-fas-angle-down class="h-4 w-4"/>   
                </x-button-primary>
            </x-slot>
            <x-slot name="content">
                 {{ $action }} 
            </x-slot>
        </x-dropdown>
        @endisset
    </div>
</div>