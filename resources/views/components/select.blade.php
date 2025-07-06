@props(['label'=>'', 'model'=>'', 'inline'=>'true', 'live'=>'false', 'labelautosize'=>'false'])
<div class="{{$inline=='true' ? 'md:flex' : '' }} items-center justify-start">
   
   {{-- Label input --}}
   @if($label!='')
      @if($labelautosize == 'true')
         <div class="mr-2">
            <label>{!! str_replace("*","<span class='text-red-500'>*</span>",$label) !!}</label>
         </div>
      @else
         <div class="w-full {{$inline=='true' ? 'md:w-48' : '' }}">
            <label>{!! str_replace("*","<span class='text-red-500'>*</span>",$label) !!}</label>
         </div>
      @endif
   @endif

   <div class="flex-1">
{{-- Mengatur class input --}}
@php($input_class = "w-full px-4 py-2 shadow-sm border rounded-md border-gray-300 
      dark:bg-gray-700 dark:border-gray-600  dark:text-white
      focus:outline-none focus:border-none focus:ring focus:ring-gray-600 dark:focus:ring-gray-600")
      
      {{-- Menampilkan input --}}
      <select  
         @if($live=='true') wire:model.live="{{$model}}" 
         @else wire:model="{{$model}}" 
         @endif
      {{ $attributes->merge(['class' => $input_class]) }} >
      {{$slot}}
      </select>
      
      {{-- Menampilkan pesan error --}}
      @error($model)
         <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
      @enderror
   </div>
</div>
