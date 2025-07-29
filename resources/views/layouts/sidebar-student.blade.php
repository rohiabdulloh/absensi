<!-- Sidebar -->
<aside class="hidden md:flex flex-col w-64 h-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 
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
         
            <x-menu class="py-4 px-3" link="/">
                <x-fas-home class="h-5 w-5"/>    
                <span class="ml-2 text-sm"> Beranda </span>
            </x-menu>  
            
            <x-menu class="py-4 px-3" link="/siswa/rekap">
                <x-fas-calendar-check class="h-5 w-5"/>    
                <span class="ml-2 text-sm"> Rekap Presensi</span>
            </x-menu>  

            <x-menu class="py-4 px-3" link="/siswa/izin">
                <x-fas-envelope class="h-5 w-5"/>    
                <span class="ml-2 text-sm"> Izin </span>
            </x-menu>  

            
            <x-menu class="py-4 px-3" link="/profil">
                <x-fas-user-circle class="h-5 w-5"/>    
                <span class="ml-2 text-sm"> Profil</span>
            </x-menu>  
        </nav>
    </div>
</aside>
