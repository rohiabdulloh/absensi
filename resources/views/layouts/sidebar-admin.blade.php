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
                <x-menu-sub link="/admin/siswa_kelas">Siswa Per Kelas</x-menu-sub>
            </x-menu-dropdown>    

            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-user-tie class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Guru</span>
                </x-slot>
                <x-menu-sub link="/admin/guru">Data Guru</x-menu-sub>
                <x-menu-sub link="/admin/wali_kelas">Data Wali Kelas</x-menu-sub>
            </x-menu-dropdown>     
            
            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-clipboard-check class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Presensi</span>
                </x-slot>
                <x-menu-sub link="/admin/pesan_whatsapp">Pesan WhatsApp</x-menu-sub>
                <x-menu-sub link="/admin/presensi">Data Presensi</x-menu-sub>
                <x-menu-sub link="/admin/siswa_absen">Data Siswa Absen</x-menu-sub>
                <x-menu-sub link="/admin/siswa_terlambat">Data Siswa Terlambat</x-menu-sub>
            </x-menu-dropdown>   

            
            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-print class="h-5 w-5"/>    
                    <span class="ml-2 text-sm">Laporan</span>
                </x-slot>
                <x-menu-sub link="/admin/laporan/persensi">Data Presensi</x-menu-sub>
                <x-menu-sub link="/admin/laporan/siswa_absen">Data Siswa Absen</x-menu-sub>
                <x-menu-sub link="/admin/laporan/siswa_terlambat">Data Siswa Terlambat</x-menu-sub>
                <x-menu-sub link="/admin/laporan/rekap_siswa">Rekap Absensi Siswa</x-menu-sub>
            </x-menu-dropdown>   


            <x-menu-dropdown>
                <x-slot:label>
                    <x-fas-cog class="h-5 w-5"/>
                    <span class="ml-2 text-sm">Pengaturan</span>
                </x-slot>
                <x-menu-sub link="/admin/tahun-ajaran">Data Tahun Ajaran</x-menu-sub>
                <x-menu-sub link="/admin/kelas">Data Kelas</x-menu-sub>
                <x-menu-sub link="/admin/pengaturan">Pengaturan Aplikasi</x-menu-sub>
                <x-menu-sub link="/admin/logo">Ubah Logo</x-menu-sub>
            </x-menu-dropdown> 

        </nav>
    </div>
</aside>
