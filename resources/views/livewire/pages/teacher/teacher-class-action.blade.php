<div class="flex justify-end space-x-1"> 
    @if($row->teacher_name)
    <x-button-circle color="red-500"  onclick="isConfirmOpen=true" 
        wireclick="$dispatchTo('pages.teacher.teacher-class-page', 'confirm', { id: {{$value}} })">
        <x-fas-trash class="h-3 w-3 text-white" />
    </x-button-circle>
    @endif
</div>