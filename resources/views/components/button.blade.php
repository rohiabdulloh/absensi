@props(['type'=>'button', 'onclick'=>'', 'wireclick'=>'', 'color'=>'blue'])

@php($button_class = "flex items-center justify-center space-x-2 px-4 py-2 font-medium text-center 
            text-white transition-color duration-200 rounded-md bg-".$color."-500 hover:bg-".$color."-600 
            focus:outline-none focus:ring-2 focus:ring-".$color."-200 focus:ring-offset-1 
            dark:focus:ring-offset-darker")

<button {{ $attributes->merge(['type' => $type, 'class' => $button_class]) }}
    @click="{{$onclick!='' ? $onclick : ''}}"
    @if($wireclick!='') wire:click="{{ $wireclick }}" @endif
>
    {{$slot}}
</button>  