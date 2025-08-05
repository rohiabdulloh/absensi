<aside class="hidden md:flex flex-col w-64 h-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 
    transition-all duration-300 fixed z-30 md:z-10 md:relative"
    :class="{ '-ml-64': !isSidebarOpen }">

    <!-- Logo & Toggle -->
    <div class="flex items-center justify-between h-16 px-4 border-b dark:border-gray-700">
        <img src="{{ asset('storage/setting/logo.png') }}" alt="Logo" class="h-10">
        <button @click="toggleSidebarMenu" class="md:hidden text-gray-500 hover:text-red-500 transition">
            <x-fas-times class="h-5 w-5" />
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col space-y-1 mt-4 px-3 overflow-y-auto h-[calc(100%-4rem)] pb-6">
        <!-- Item -->
        <x-menu link="/" class="rounded hover:bg-blue-100 dark:hover:bg-gray-800 transition">
            <div class="flex items-center space-x-3 px-3 py-2">
                <x-fas-home class="w-4 h-4 text-blue-600" />
                <span class="text-sm text-gray-800 dark:text-gray-200">Beranda</span>
            </div>
        </x-menu>
        
        <x-menu  link="/guru/presensi" class="rounded hover:bg-purple-100 dark:hover:bg-gray-800 transition">
            <div class="flex items-center space-x-3 px-3 py-2">
                <x-fas-clipboard-check class="w-4 h-4 text-purple-600" />
                <span class="text-sm text-gray-800 dark:text-gray-200">Data Presensi</span>
            </div>
        </x-menu>

        <x-menu link="/guru/rekap" class="rounded hover:bg-red-100 dark:hover:bg-gray-800 transition">
            <div class="flex items-center space-x-3 px-3 py-2">
                <x-fas-calendar-check class="w-4 h-4 text-red-600" />
                <span class="text-sm text-gray-800 dark:text-gray-200">Rekap Presensi</span>
            </div>
        </x-menu>

        
        <x-menu link="/profil" class="rounded hover:bg-green-100 dark:hover:bg-gray-800 transition">
            <div class="flex items-center space-x-3 px-3 py-2">
                <x-fas-user-circle class="w-4 h-4 text-green-600" />
                <span class="text-sm text-gray-800 dark:text-gray-200">Profil</span>
            </div>
        </x-menu>

    </nav>
</aside>
