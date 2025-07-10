<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}">
    <x-breadcrumbs>
        <x-breadcrumbs-link current="true">Siswa</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Siswa

        <x-slot:action>
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah Siswa</span>
            </x-dropdown-link>

            <x-dropdown-link @click="isImportOpen = true">
                <x-fas-file-import class="h-4 w-4 mr-2"/> 
                <span>Import Excel</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportExcel">
                <x-fas-file-excel class="h-4 w-4 mr-2"/> 
                <span>Export Excel</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportPDF">
                <x-fas-file-pdf class="h-4 w-4 mr-2"/> 
                <span>Export PDF</span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">
        <div class="w-full overflow-x-auto">
            <livewire:pages.student.student-table/>
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/2">
                <x-slot name="header">
                    <h3>{{ ($isEdit) ? "Edit" : "Tambah" }} Data Siswa</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">    
                    <x-input inline="false" label="NIS*" model="nis"/>  
                    <x-input inline="false" label="Nama Siswa*" model="name"/>  
                    <x-select inline="false" label="Jenis Kelamin*" model="gender">  
                        <option value="M">Laki-laki</option>
                        <option value="F">Perempuan</option>
                    </x-select>
                    <x-input inline="false" label="No. HP Ortu" model="parent_hp"/>   
                   <x-select inline="false" label="Tahun Masuk*" model="year_entry"> 
                        @for($t=2022; $t<=date('Y'); $t++)
                            <option value="{{ $t }}">{{ $t }}</option>
                        @endfor
                    </x-select>  
                </div>
            </x-modal>
        </form>

        @include('livewire.pages.student.student-import')

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
