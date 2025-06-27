@props(['label'=>'', 'model'=>'', 'inline'=>'true'])
<div class="{{$inline=='true' ? 'md:flex' : '' }} items-center justify-start">
   
   {{-- Label input --}}
   @if($label!='')
   <div class="w-full {{$inline=='true' ? 'md:w-48' : '' }}">
      <label>{{$label}}</label>
   </div>
   @endif

   <div class="flex-1">
{{-- Mengatur class input --}}
@php($input_class = "w-full px-4 py-2 shadow-sm border rounded-md border-gray-300 
   dark:bg-gray-700 dark:border-gray-600 dark:text-white
   focus:outline-none focus:border-none focus:ring focus:ring-gray-600 dark:focus:ring-gray-600")
      
      {{-- Menampilkan input --}}
      <textarea  wire:model="{{$model}}"  {{ $attributes->merge(['class' => $input_class]) }} ></textarea>
      {{$slot}}
      
      {{-- Menampilkan pesan error --}}
      @error($model)
         <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
      @enderror
   </div>
</div>
