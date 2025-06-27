

<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Personalia</x-breadcrumbs-link>
        <x-breadcrumbs-link link="/user">User</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Tambah User</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data User</x-page-header>
        
    <form wire:submit.prevent="save">
    <x-card class="min-h-full">    
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="flex flex-col space-y-4">    
                <x-input inline="false" label="Nama Lengkap*" model="name"/>  
                <x-input inline="false" label="Alamat Email*" model="email"/>  
                <x-input inline="false" label="Perusahaan*" model="company"/>  
                <x-input inline="false" label="Username*" model="username"/>  
            </div>
            <div class="flex flex-col space-y-4">    
                <x-input inline="false" type="password" label="Password*" model="password"/>  
                <x-input inline="false" type="password" label="Konfirmasi Password*" model="confirm_password"/>  
                <x-input inline="false" label="Group*" model="group"/>  
            </div>
        </div>
        <x-alert/>
        
        <x-slot name="footer">
            <x-button-primary type="submit" color="primary" class="mt-2">
                <x-fas-save class="h-4 w-4"/>    
                <span> Simpan </span>
            </x-button-primary>
        </x-slot>

    </x-card>
    </form>
</div>