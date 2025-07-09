<div  x-data="{isTransferOpen: false}" x-on:open-transfer.window="isTransferOpen = true"
    x-on:close-transfer.window="isTransferOpen = false"
>
    <x-backdrop show="isTransferOpen" onclose="isTransferOpen = false"/>
    <div
        x-transition:enter="transition duration-300 ease-in-out transform"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition duration-300 ease-in-out transform"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        x-show="isTransferOpen"
        class="fixed left-0 top-0 z-20 w-full h-full flex items-center justify-center"
    >
        <form wire:submit.prevent="moveClass">
            <x-dialog class="md:w-1/2">
                <x-slot name="header">
                    <h3>{{ $class == 0 ? 'Tambah ke Kelas' : 'Pindah Kelas' }} </h3>                    
                    <button type="button"  @click="isTransferOpen=false" wire:click="resetForm()" >
                        <x-fas-times class="w-4 h-4"/>
                    </button>
                </x-slot>
                <div class="flex flex-col space-y-4 p-4">
                    <x-select label="Kelas" model="targetClass" live="true">
                        <option value=""> -- Pilih kelas -- </option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Tahun Ajaran" model="targetYear" live="true">
                        <option value=""> -- Pilih Tahun Ajaran -- </option>
                        @foreach($periods as $period)
                            <option value="{{ $period->year_start }}">{{ $period->year_start }}/{{ $period->year_end }}</option>
                        @endforeach
                    </x-select>
                </div>
                <x-slot name="footer">                    
                    <x-button onclick="isTransferOpen=false" wireclick="resetForm()" color="amber">
                        <x-fas-times-circle class="h-4 w-4"/>    
                        <span> Batal </span>
                    </x-button>
                    @if($class==0)
                        <x-button type="submit" color="green">
                            <x-fas-arrow-right class="h-4 w-4"/>    
                            <span> Tambahkan </span>
                        </x-button>
                    @else
                        <x-button-primary type="submit" color="primary">
                            <x-fas-arrow-right-arrow-left class="h-4 w-4"/>    
                            <span> Pindah </span>
                        </x-button-primary>                        
                    @endif
                </x-slot>
            </x-dialog>
        </form>
        </div>
    </div>
</div>