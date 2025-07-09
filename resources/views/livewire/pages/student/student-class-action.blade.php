<div class="flex justify-end space-x-1">   
    @if($classId==0)
        <x-button-circle title="Tambah ke Kelas" color="green-500" wireclick="$dispatchTo('pages.student.student-class-page', 'moveClass', { id: {{$value}} })">
            <x-fas-arrow-right class="h-3 w-3 text-white" />
        </x-button-circle>  
    @else
        <x-button-circle title="Pindah Kelas" color="purple-500" wireclick="$dispatchTo('pages.student.student-class-page', 'moveClass', { id: {{$value}} })">
            <x-fas-arrow-right-arrow-left class="h-3 w-3 text-white" />
        </x-button-circle> 
        <x-button-circle title="Hapus dari Kelas" color="red-500"  onclick="isConfirmOpen=true" 
            wireclick="$dispatchTo('pages.student.student-class-page', 'confirm', { id: {{$value}} })">
            <x-fas-trash class="h-3 w-3 text-white" />
        </x-button-circle>
    @endif
</div>