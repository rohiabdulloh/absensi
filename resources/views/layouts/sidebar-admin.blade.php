<aside class="w-64 h-full fixed z-30 md:relative 
           bg-white/60 dark:bg-gray-900/60 
           backdrop-blur-xl shadow-lg 
           border-r border-gray-200 dark:border-gray-700 
           transition-all duration-300"
    :class="{ '-ml-64': !isSidebarOpen }"
>
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
        <x-menu link="/dashboard" class="rounded hover:bg-blue-100 dark:hover:bg-gray-800 transition">
            <div class="flex items-center space-x-3 px-3 py-2">
                <x-fas-tachometer-alt class="w-4 h-4 text-blue-600" />
                <span class="text-sm text-gray-800 dark:text-gray-200">Dashboard</span>
            </div>
        </x-menu>

        <!-- Dropdown Item -->
        <x-menu-dropdown class="rounded hover:bg-green-100 dark:hover:bg-gray-800 transition">
            <x-slot:label>
                <div class="flex items-center space-x-3 px-3 py-2">
                    <x-fas-user-graduate class="w-4 h-4 text-green-600" />
                    <span class="text-sm text-gray-800 dark:text-gray-200">Siswa</span>
                </div>
            </x-slot>
            <x-menu-sub link="/admin/siswa">Data Siswa</x-menu-sub>
            <x-menu-sub link="/admin/siswa_kelas">Siswa Per Kelas</x-menu-sub>
        </x-menu-dropdown>

        <!-- Guru -->
        <x-menu-dropdown class="rounded hover:bg-purple-100 dark:hover:bg-gray-800 transition">
            <x-slot:label>
                <div class="flex items-center space-x-3 px-3 py-2">
                    <x-fas-user-tie class="w-4 h-4 text-purple-600" />
                    <span class="text-sm text-gray-800 dark:text-gray-200">Guru</span>
                </div>
            </x-slot>
            <x-menu-sub link="/admin/guru">Data Guru</x-menu-sub>
            <x-menu-sub link="/admin/wali_kelas">Data Wali Kelas</x-menu-sub>
        </x-menu-dropdown>

        <!-- Presensi -->
        <x-menu-dropdown class="rounded hover:bg-red-100 dark:hover:bg-gray-800 transition">
            <x-slot:label>
                <div class="flex items-center space-x-3 px-3 py-2">
                    <x-fas-clipboard-check class="w-4 h-4 text-red-600" />
                    <span class="text-sm text-gray-800 dark:text-gray-200">Presensi</span>
                </div>
            </x-slot>
            <x-menu-sub link="/admin/presensi">Data Presensi</x-menu-sub>
            <x-menu-sub link="/admin/presensi/absen">Data Siswa Absen</x-menu-sub>
            <x-menu-sub link="/admin/presensi/izin">Data Pengajuan Izin</x-menu-sub>
        </x-menu-dropdown>

        <!-- Laporan -->
        <x-menu-dropdown class="rounded hover:bg-yellow-100 dark:hover:bg-gray-800 transition">
            <x-slot:label>
                <div class="flex items-center space-x-3 px-3 py-2">
                    <x-fas-print class="w-4 h-4 text-yellow-600" />
                    <span class="text-sm text-gray-800 dark:text-gray-200">Laporan</span>
                </div>
            </x-slot>
            <x-menu-sub link="/admin/laporan/presensi">Data Presensi</x-menu-sub>
            <x-menu-sub link="/admin/laporan/presensi_siswa">Presensi Per Siswa</x-menu-sub>
            <x-menu-sub link="/admin/laporan/siswa_absen">Siswa Absen</x-menu-sub>
            <x-menu-sub link="/admin/laporan/siswa_terlambat">Siswa Terlambat</x-menu-sub>
            <x-menu-sub link="/admin/laporan/rekap_presensi">Rekap Absensi</x-menu-sub>
        </x-menu-dropdown>

        <!-- Pengaturan -->
        <x-menu-dropdown class="rounded hover:bg-gray-200 dark:hover:bg-gray-800 transition">
            <x-slot:label>
                <div class="flex items-center space-x-3 px-3 py-2 ">
                    <x-fas-cog class="w-4 h-4 text-gray-600" />
                    <span class="text-sm text-gray-800 dark:text-gray-200">Pengaturan</span>
                </div>
            </x-slot>
            <x-menu-sub link="/admin/tahun-ajaran">Tahun Ajaran</x-menu-sub>
            <x-menu-sub link="/admin/kelas">Kelas</x-menu-sub>
            <x-menu-sub link="/admin/pengaturan">Pengaturan Aplikasi</x-menu-sub>
            <x-menu-sub link="/admin/logo">Ubah Logo</x-menu-sub>
        </x-menu-dropdown>
    </nav>
</aside>
