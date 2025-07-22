<div class="flex justify-end space-x-1"> 
    <x-button-circle color="green-500" title="Setujui"
        wireclick="$dispatchTo('pages.attendance.leave-page', 'approve', { id: {{$value}} })">
        <x-fas-check class="h-3 w-3 text-white" />
    </x-button-circle>
    <x-button-circle color="red-500" title="Tolak"
        wireclick="$dispatchTo('pages.attendance.leave-page', 'reject', { id: {{$value}} })">
        <x-fas-times class="h-3 w-3 text-white" />
    </x-button-circle>
</div>