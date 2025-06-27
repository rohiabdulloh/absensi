@props(['type'=>'button', 'onclick'=>'', 'wireclick'=>'', 'color'=>'primary'])

@php($button_class = "p-2 transition-colors duration-200 rounded-full bg-".$color." 
            hover:bg-".$color."-darker")

<button {{ $attributes->merge(['type' => $type, 'class' => $button_class]) }}
    @click="{{$onclick!='' ? $onclick : ''}}"
    @if($wireclick!='') wire:click="{{ $wireclick }}" @endif
>
    {{$slot}}
</button>