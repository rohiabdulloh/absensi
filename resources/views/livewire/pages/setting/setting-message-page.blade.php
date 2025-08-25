<div class="flex flex-col space-y-3" >

    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Pesan Whatsapp</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Pesan Whatsapp </x-page-header>

    <form wire:submit.prevent="save">
    <x-card class="min-h-full">            
           
        <div class="col-span-2 mt-4 space-y-4">
            <p class="text-gray-600 dark:text-gray-300">
               Pengiriman whatsapp menggunakan layanan wablas.com. 
               Whatsapp API Key dan Secret Key dapat diperoleh dari website tersebut.
               Pada template pesan whatsapp dapat menggunakan kata <b>[nama]</b> untuk mewakili nama siswa.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input inline="false" label="Whatsapp Api Key" model="wa_apikey" type="text" />
                <x-input inline="false" label="Whatsapp Secret Key" model="wa_secretkey" type="text" />
            </div> 
            <div class="col-span-2">
                <x-textarea inline="false" label="Template Pesan Whatsapp" model="wa_message" />
            </div>
        </div>

        <x-alert/>
        
        <x-slot name="footer">
            <x-button type="submit" color="blue" class="mt-2">
                <x-fas-save class="h-4 w-4"/>    
                <span> Simpan Perubahan</span>
            </x-button>
        </x-slot>
    </x-card>
    </form>

</div>