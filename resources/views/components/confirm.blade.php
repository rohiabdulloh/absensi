<div x-data="{showConfirm: false, text: ''}" x-on:deleteData="">
	<x-backdrop show="showConfirm" onclose="showConfirm = false"/>

	<div
		x-transition:enter="transition duration-300 ease-in-out transform"
		x-transition:enter-start="-translate-y-full"
		x-transition:enter-end="translate-y-0"
		x-transition:leave="transition duration-300 ease-in-out transform"
		x-transition:leave-start="translate-y-0"
		x-transition:leave-end="-translate-y-full"
		x-show="showConfirm"
		class="fixed left-0 top-0 my-2 z-20 w-full h-full flex items-center justify-center"
	>
		<div  class="w-full md:w-1/3 bg-white rounded-md border shadow-xl opacity-100
			dark:bg-dark dark:border-primary-darker">
			
			<div class="p-4 bg-gray-100 text-gray-500 
				dark:bg-darker dark:text-light">
				<h2>Konfirmasi!</h3>
			</div>

			<div class="relative p-4 overflow-hidden" x-text="text"></div>

			<div class="flex items-center justify-end space-x-2 p-4 text-gray-500 dark:text-light">
				<x-button-primary onclick="showConfirm=false" wireclick="delete()" color="primary">  
					<span> OK </span>
				</x-button-primary>
				<x-button onclick="showConfirm=false" color="red">
					<span> Batal </span>
				</x-button>
			</div>
		</div>
	</div>
</div>