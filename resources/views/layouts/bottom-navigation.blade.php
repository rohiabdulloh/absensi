<div class="md:hidden bottom-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-md">
    <div class="flex justify-between items-center px-4 py-2">
      <!-- Home Button -->
      
      <x-nav-bottom class="p-2" link="/">
        <x-fas-home class="w-5 h-5"/>
        <span class="text-xs">Home</span>
      </x-nav-bottom>

      <!-- Search Button -->
      <x-nav-bottom class="p-2" link="/siswa/rekap">
        <x-fas-calendar-check class="w-5 h-5"/>
        <span class="text-xs">Rekap</span>
      </x-nav-bottom>

      <!-- Notifications Button -->
      <x-nav-bottom class="p-2" link="/siswa/izin">
        <x-fas-envelope class="w-5 h-5"/>
        <span class="text-xs">Izin</span>
      </x-nav-bottom>

      <!-- Profile Button -->
      <x-nav-bottom class="p-2" link="/profil">
        <x-fas-user-circle class="w-5 h-5"/>
        <span class="text-xs">Profil</span>
      </x-nav-bottom>
    </div>
</div>