<div x-data="{show: false}" x-init="$nextTick(() => {show = true} )"
        x-show="show"
        x-transition:enter="transition ease-out duration-500 transform"
        x-transition:enter-start="opacity-0 scale-50"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-1000 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-50"        
        {{ $attributes }}>
    <div class="block">
        {{$slot}}
    </div>
</div>