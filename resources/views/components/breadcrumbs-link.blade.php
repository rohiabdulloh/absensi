@props(['link'=>'#', 'current'=>'false'])
<li>
    <div class="flex items-center">
        <x-fas-angle-right class="block w-3 h-3 mx-1 text-gray-400 " />
        <a href="{{ $link }}" class="ms-1 text-sm font-medium dark:text-gray-400 
            @if($current=='false')  
                text-gray-700 md:ms-2  hover:text-blue-600 dark:hover:text-white 
            @else
                text-gray-500 cursor-default
            @endif ">{{ $slot }}</a>
    </div>
</li>