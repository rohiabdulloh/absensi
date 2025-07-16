<div class="flex flex-col space-y-3">
    <x-page-header> Rekap Presensi
        <x-slot:filter>
            <div class="w-full">
                <x-select label="Bulan : " model="month" labelautosize="true" live="true">
                    @foreach($monthList as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
            </div>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">

        @include('livewire.fronts.report-desktop')
        @include('livewire.fronts.report-mobile')

    </x-card>
</div>
