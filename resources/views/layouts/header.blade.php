<!-- Sidebar -->
<div class="py-2 px-2 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-16">
   <div class="flex items-center justify-between p-2">
      <button @click="toggleSidebarMenu" >
         <x-fas-bars class="h-5 w-5 text-gray-500 dark:text-gray-200"/> 
      </button>
      
      <div class="flex justify-end space-x-4">
         <x-button-circle class="bg-transparent hover:bg-gray-200 dark:hover:bg-gray-700" color="transparent" @click="toggleTheme">
            <x-fas-moon x-show="!isDark" class="h-5 w-5 text-gray-500 hover:text-gray-800 dark:text-gray-300 hover:dark:text-white" />
            <x-fas-sun x-show="isDark" class="h-5 w-5 text-gray-500 hover:text-gray-800 dark:text-gray-300 hover:dark:text-white" /> 
         </x-button-circle>
         
		   <livewire:layout.navigation/>
		 
      </div>
   </div>
</div>