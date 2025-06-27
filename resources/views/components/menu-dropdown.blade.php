<div x-data="{ isActive: false, open: false }">
    <a href="#"
        @click="$event.preventDefault(); open = !open"
        class="flex items-center p-2 text-gray-800 transition-colors dark:text-light hover:bg-gray-200 dark:hover:bg-gray-700"
        :class="{ 'bg-gray-200 dark:bg-gray-700': isActive || open }"
        :aria-expanded="(open || isActive) ? 'true' : 'false'"
    >
        @isset($label) {{$label}} @endisset
        <span aria-hidden="true" class="ml-auto">
            <x-fas-angle-down x-show="!open" class="w-3 h-3"/>
            <x-fas-angle-up x-show="open" class="w-3 h-3"/>
        </span>
    </a>
    <div x-show="open" class="mt-2 space-y-2 pl-7">    
        {{$slot}}
    </div>
</div>