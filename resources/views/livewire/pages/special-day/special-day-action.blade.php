<div class="flex justify-end space-x-1"> 
    <x-button-circle wireclick="$dispatchTo('pages.special-day.special-day-page', 'edit', { id: {{$value}} })">
        <x-fas-edit class="h-3 w-3 text-white" />
    </x-button-circle>
    <x-button-circle color="red-500"  onclick="isConfirmOpen=true" 
        wireclick="$dispatchTo('pages.special-day.special-day-page', 'confirm', { id: {{$value}} })">
        <x-fas-trash class="h-3 w-3 text-white" />
    </x-button-circle>
</div>