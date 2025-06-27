<div  class="fixed left-0 top-0 z-20 w-full h-full flex items-center justify-center" >
    <div {{ $attributes->merge(['class' =>"flex flex-col w-full h-full md:h-auto max-h-full bg-white rounded-md shadow-xl opacity-100
        dark:bg-gray-800 dark:border-gray-700"]) }}>

        {{-- Dialog header --}}
        <div class="flex items-center justify-between p-4 rounded-t-md border-b bg-gray-100 text-gray-500 
            dark:bg-gray-800 dark:text-light dark:border-gray-700">
                @isset($header) {{$header}} @endisset
        </div>

        {{-- Dialog content--}}
        <div class="flex-1 relative overflow-y-auto">
            {{$slot}}
        </div>
        
        {{-- Modal footer --}}
        @if(isset($footer))
        <div class="flex items-center justify-between p-4 border-t text-gray-500 dark:text-light
            dark:border-gray-700">
                {{$footer}}
        </div>
        @endif
    </div>
</div>