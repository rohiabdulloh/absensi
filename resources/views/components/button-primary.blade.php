@props(['type'=>'submit', 'onclick'=>'', 'wireclick'=>''])

<button {{ $attributes->merge(['type' => $type, 
        'class' => "inline-flex items-center justify-center px-4 py-2 font-medium text-center 
            text-white transition-color duration-200 rounded-md bg-blue-500 hover:bg-blue-600 
            focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-offset-1 
            dark:focus:ring-offset-darker"]) }}
        @click="{{$onclick!='' ? $onclick : ''}}"
        @if($wireclick!='') wire:click="{{ $wireclick }}" @endif     
>
    {{ $slot }}
</button>
