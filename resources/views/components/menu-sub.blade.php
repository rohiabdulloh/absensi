<a wire:navigate
    href="{{ $link }}"
    role="menuitem"
    class="block p-2 text-sm text-gray-500 transition-colors duration-200 rounded-md 
        dark:text-gray-200 dark:hover:text-light hover:text-gray-900 hover:font-bold
        {!! request()->is(str_replace('/','',$link)) ? 'text-gray-900 dark:text-white font-bold' : '' !!}" 
>
    {{ $slot }}
</a>