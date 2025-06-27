<!-- Sidebar -->
<aside class="flex flex-col w-64 h-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 
    transition-all duration-300 fixed z-30 md:z-10 md:relative"
    :class="{ '-ml-64': !isSidebarOpen }">

    <div class="flex items-center justify-between px-4 pt-2 pb-3 h-16  dark:bg-gray-800 border-b border-r-0 border-gray-200 dark:border-gray-700 ">
        <img src="{{asset('storage/setting/logo.png')}}" width="180" class="mt-1">
        <button @click="toggleSidebarMenu" class="text-gray-500 block md:hidden">
            <x-fas-times class="h-5 w-5"/> 
        </button>
    </div>

    <div class="flex-1 flex flex-col h-full overflow-y-auto">
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2">
         
            <x-menu link="/dashboard">
                <x-fas-tachometer-alt class="h-5 w-5"/>    
                <span class="ml-2 text-sm"> Dashboard </span>
            </x-menu>  
            
            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-user-graduate class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Siswa</span>
                </x-slot>
                <x-menu-sub link="/admin/siswa">Data Siswa</x-menu-sub>
                <x-menu-sub link="/admin/tempat_pkl">Tempat PKL Siswa</x-menu-sub>
            </x-menu-dropdown>    

            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-user-tie class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Guru</span>
                </x-slot>
                <x-menu-sub link="/admin/guru">Data Guru</x-menu-sub>
                <x-menu-sub link="/admin/jabatan_guru">Jabatan Guru</x-menu-sub>
                <x-menu-sub link="/admin/bimbingan_guru">Daftar Bimbingan</x-menu-sub>
            </x-menu-dropdown>     
            
            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-house class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">DuDi</span>
                </x-slot>
                <x-menu-sub link="/admin/dudi">Data DuDi</x-menu-sub>
                <x-menu-sub link="/admin/instruktur">Instruktur DuDi</x-menu-sub>
            </x-menu-dropdown>   

            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-house-user class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Tempat PKL</span>
                </x-slot>
                <x-menu-sub link="/admin/pengajuan">Pengajuan PKL</x-menu-sub>
                <x-menu-sub link="/admin/penempatan">Penempatan PKL</x-menu-sub>
            </x-menu-dropdown>   

            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-house-circle-check class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Monitoring & Bimbingan</span>
                </x-slot>
                <x-menu-sub link="/admin/logbook">Logbook Siswa</x-menu-sub>
                <x-menu-sub link="/admin/aktifitas">Data Aktifitas PKL</x-menu-sub>
                <x-menu-sub link="/admin/modul">Modul Ajar</x-menu-sub>
                <x-menu-sub link="/admin/bimbingan">Progress Bimbingan</x-menu-sub>
            </x-menu-dropdown>  
            
            
            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-clipboard-list class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Penilaian</span>
                </x-slot>
                <x-menu-sub link="/admin/nilai_dudi">Penilaian DuDi</x-menu-sub>
                <x-menu-sub link="/admin/nilai_sekolah">Penilaian Sekolah</x-menu-sub>
                <x-menu-sub link="/admin/laporan">Laporan Siswa</x-menu-sub>
            </x-menu-dropdown>  

            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-cog class="h-5 w-5"/>
                    <span class="ml-2 text-sm">Pengaturan</span>
                </x-slot>
                <x-menu-sub link="/admin/logo">Ubah Logo</x-menu-sub>
                <x-menu-sub link="/admin/jurusan">Jurusan</x-menu-sub>
                <x-menu-sub link="/admin/rombel">Rombel</x-menu-sub>
                <x-menu-sub link="/admin/jabatan">Jabatan</x-menu-sub>
                <x-menu-sub link="/admin/periode">Periode PKL</x-menu-sub>
            </x-menu-dropdown> 

        </nav>
    </div>
</aside>
