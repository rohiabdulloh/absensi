@props(['label'=>'', 'model'=>'', 'mask'=>'', 'inline'=>'true', 'live'=>'false'])
<div class="{{$inline=='true' ? 'md:flex' : '' }}  justify-start" x-data=""
@if($mask=='')
   x-init=" IMask( $refs.input, {
      mask: Number,
      thousandsSeparator: '.'
   })"
@else
   x-init=" IMask( $refs.input, {
      mask: '{{$mask}}'
   })"
@endif
>
   @if($label!='')
   <div class="w-full {{$inline=='true' ? 'md:w-48' : '' }}">
      <label>{!! str_replace("*","<span class='text-red-500'>*</span>",$label) !!}</label>
   </div>
   @endif
   
   <div class="flex-1">

@php($input_class = "w-full px-4 py-2 shadow-sm border rounded-md border-gray-300 
      dark:bg-gray-700 dark:border-gray-600 dark:text-white
      focus:outline-none focus:border-none focus:ring focus:ring-gray-600 dark:focus:ring-gray-600")
      
      <input   
         @if($live=='true') wire:model.live="{{$model}}" 
         @else wire:model.lazy="{{$model}}" 
         @endif

         x-ref="input"
         x-on:change="$dispatch('input', $refs.input.value)"
         onfocus="this.select();"
         {{ $attributes->merge(['class' => $input_class]) }}
      />
      @error($model)
         <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
      @enderror
   </div>
</div>
