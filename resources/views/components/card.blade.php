<div {{ $attributes->merge(['class' => 'bg-white rounded-md dark:bg-gray-800  w-full']) }}>
    @isset($header) 
    <div {{ $header->attributes->merge(['class' => 'flex flex-col md:flex-row md:items-center justify-between p-4 border-b text-gray-500 
       dark:text-light dark:border-gray-700']) }}>
        {{$header}} 
    </div>
    @endisset

    <div class="flex-1 p-4 overflow-y-auto">
        {{$slot}}
    </div>

    @isset($footer) 
    <div class="flex flex-col md:flex-row md:items-center justify-between p-4 border-t text-gray-500 
        dark:text-light dark:border-gray-700">
        {{$footer}} 
    </div>
    @endisset
</div>