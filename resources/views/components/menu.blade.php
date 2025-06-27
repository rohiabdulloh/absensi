@props(['link'])
@php($menu_class = "flex items-center p-2 text-gray-500 transition rounded justify-start dark:text-light hover:bg-gray-200 dark:hover:bg-gray-700")
@php($active_class =  request()->is(str_replace('/','',$link)) ? 'bg-gray-200 dark:text-white dark:bg-gray-700' : '' )

<a wire:navigate href="{{ $link }}" role="menuitem" {{ $attributes->merge(['class' => $menu_class .' '. $active_class]) }} >
    {{ $slot }} 
</a>
