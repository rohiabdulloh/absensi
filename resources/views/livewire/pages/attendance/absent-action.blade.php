<div class="flex justify-end space-x-1"> 
   @if($row->attendance_msg_sent!=='Y')
    <x-button-circle color="green-500" title="Kirim Whatsapp"
        wireclick="$dispatchTo('pages.attendance.absent-page', 'send-message', { id: {{$value}} })">
        <x-fab-whatsapp class="h-3 w-3 text-white" />
    </x-button-circle>
    @endif
</div>