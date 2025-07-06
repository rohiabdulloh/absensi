<div class="text-center"> 
    @if($row->is_active=='N')
        <x-fas-times-circle class="h-4 w-4 text-red-500" />
    @else
        <x-fas-check-circle class="h-4 w-4 text-green-500" />
    @endif
</div>