<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Personalia</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">User</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data User
        @if(auth()->user()->hasAnyPermission(['modify_people', 'add_people']))
        <x-slot:action>      
            @can('add_people')
            <x-dropdown-link @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah User </span>
            </x-dropdown-link>
            @endcan

            @can('modify_people')
            <x-dropdown-link wire:click="exportExcel" > 
                <x-fas-file-excel class="h-4 w-4 mr-2"/> 
                <span>Export Excel </span>
            </x-dropdown-link>
            <x-dropdown-link  wire:click="exportPDF" > 
                <x-fas-file-pdf class="h-4 w-4 mr-2"/> 
                <span>Export PDF</span>
            </x-dropdown-link>
            @endcan
        </x-slot>
        @endif
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.user.user-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/2">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Data User</h3>
                </x-slot>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="flex flex-col space-y-2">    
                        <x-input inline="false" label="Nama Lengkap*" model="name"/>  
                        <x-input inline="false" label="Alamat Email*" model="email"/>  
                        <x-input inline="false" label="Perusahaan*" model="company"/>  
                        <x-input inline="false" label="Username*" model="username"/>  
                    </div>
                    <div class="flex flex-col space-y-2">    
                        <x-input inline="false" type="password" label="Password*" model="password"/>  
                        <x-input inline="false" type="password" label="Konfirmasi Password*" model="confirm_password"/>  
                        <x-select inline="false" label="Group*" model="group">  
                            <option value=""></option>
                            @foreach($groups as $g)
                                <option value="{{ $g->name }}">{{ ucfirst($g->name) }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert />
    </x-card>
</div>
