@props(['link'])
@php($menu_class = "flex flex-col items-center text-gray-500 dark:text-gray-500 hover:text-gray-900 dark:hover:text-white")
@php($active_class =  request()->is(str_replace('/','',$link)) ? 'text-gray-900 dark:text-white' : '' )

<a wire:navigate href="{{ $link }}" role="menuitem" {{ $attributes->merge(['class' => $menu_class .' '. $active_class]) }} >
    {{ $slot }}
</a>