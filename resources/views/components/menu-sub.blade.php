<a wire:navigate
    href="{{ $link }}"
    role="menuitem"
    class="flex items-center gap-2 px-4 py-3 text-sm transition duration-300 
        text-gray-600 dark:text-gray-300 
        hover:text-blue-800 hover:bg-blue-100 dark:hover:bg-blue-800 
        {{ request()->is(ltrim($link, '/')) ? 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-white font-semibold' : '' }}"
>
    <x-fas-angle-right class="h-3 w-3"/>
    <span>{{ $slot }}</span>
</a>