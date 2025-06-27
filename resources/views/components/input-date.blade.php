@props(['label'=>'', 'model'=>'', 'inline'=>'true', 'live'=>'false'])
<div class="{{$inline=='true' ? 'md:flex' : '' }}  justify-start" x-data x-init="
  let pikaday = new Pikaday({ 
     field: $refs.input,  
     theme: isDark ? 'dark-theme' : 'null',
     toString(date, format) {
       const day = '0' + date.getDate();
       const month = '0' + (date.getMonth() + 1);
       const year = date.getFullYear();
       return `${year}-${month.substr(-2)}-${day.substr(-2)}`;
     },
     onSelect: function(){
       $wire.set('{{$model}}', pikaday.toString());
     }
  })"
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
        
      <input x-ref="input" 
         @if($live=='true') wire:model.live="{{$model}}" 
         @else wire:model.lazy="{{$model}}" 
         @endif

         {{ $attributes->merge(['class' => $input_class]) }}
         autocomplete="off" />
         
     @error($model)
       <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
     @enderror
   </div>
</div>  
