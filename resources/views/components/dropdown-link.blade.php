@php($menu_class = "flex items-center p-2 text-gray-500 transition rounded justify-start dark:text-light hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer")

<a {{ $attributes->merge(['class' => $menu_class ]) }} >{{ $slot }}</a>
