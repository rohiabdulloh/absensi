<!-- Header -->
<div class="py-2 px-4 h-16 sticky top-0 z-40 
    bg-gradient-to-r from-blue-50/80 via-white/80 to-blue-100/80 
    dark:from-gray-900/80 dark:via-gray-800/80 dark:to-gray-900/80 
    backdrop-blur-md border-b border-blue-100 dark:border-gray-700 
    shadow-md transition-all duration-300">

   <div class="flex items-center justify-between h-full">
      
      <!-- Sidebar toggle -->
      <button @click="toggleSidebarMenu" class="p-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 transition">
         <x-fas-bars class="h-5 w-5 text-blue-700 dark:text-gray-200" /> 
      </button>

      <!-- Right icons -->
      <div class="flex items-center space-x-3">
         
         <!-- Theme toggle -->
         <x-button-circle 
            class="bg-transparent hover:bg-blue-100 dark:hover:bg-gray-700 transition"
            color="transparent"
            @click="toggleTheme"
         >
            <x-fas-moon 
               x-show="!isDark" 
               class="h-5 w-5 text-gray-600 hover:text-blue-800 dark:text-gray-300 hover:dark:text-white" 
            />
            <x-fas-sun 
               x-show="isDark" 
               class="h-5 w-5 text-yellow-400 hover:text-yellow-500 dark:text-gray-300 hover:dark:text-white" 
            /> 
         </x-button-circle>

         <!-- User dropdown / notifications -->
         <livewire:layout.navigation />
      </div>
   </div>
</div>
