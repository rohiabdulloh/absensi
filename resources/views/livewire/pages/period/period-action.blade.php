<div class="flex justify-end space-x-1"> 
    @if($row->is_active=='N')
    <x-button-circle color="green-500" wireclick="$dispatchTo('pages.period.period-page', 'activate', { id: {{$value}} })">
        <x-fas-check class="h-3 w-3 text-white" />
    </x-button-circle>
    @endif
    <x-button-circle wireclick="$dispatchTo('pages.period.period-page', 'edit', { id: {{$value}} })">
        <x-fas-edit class="h-3 w-3 text-white" />
    </x-button-circle>
    <x-button-circle color="red-500"  onclick="isConfirmOpen=true" 
        wireclick="$dispatchTo('pages.period.period-page', 'confirm', { id: {{$value}} })">
        <x-fas-trash class="h-3 w-3 text-white" />
    </x-button-circle>
</div>