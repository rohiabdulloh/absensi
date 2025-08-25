<div x-data="" x-on:open-confirm.window="isConfirmOpen = true">
    
{{-- Menggunakan komponen backdrop --}}
<x-backdrop show="isConfirmOpen" onclose="isConfirmOpen = false"/>

{{-- Mengatur animasi --}}
<div
	x-transition:enter="transition duration-300 ease-in-out transform"
	x-transition:enter-start="-translate-y-full"
	x-transition:enter-end="translate-y-0"
	x-transition:leave="transition duration-300 ease-in-out transform"
	x-transition:leave-start="translate-y-0"
	x-transition:leave-end="-translate-y-full"
	x-show="isConfirmOpen"
	class="fixed left-0 top-0 my-2 z-20 w-full h-full flex items-center justify-center"
>
	{{-- Mengatur desain confirm --}}
	<div  class="w-full md:w-1/3 bg-white rounded-md border shadow-xl opacity-100
		text-gray-500 dark:text-light dark:border-gray-700  dark:bg-gray-800">
		
		{{-- Mengatur judul --}}
		<div class="p-4 bg-gray-100 text-gray-500 border-b dark:text-light dark:border-gray-700 dark:bg-gray-800">
			<h2>Konfirmasi!</h3>
		</div>

		{{-- Menampilkan pesan konfirmasi --}}
		<div class="relative p-4 overflow-hidden">{{$slot}}</div>

		{{-- Mengatur footer dan tombol konfirm --}}
		<div class="flex items-center justify-end space-x-2 p-4 text-gray-500 dark:text-light">
			<x-button-primary onclick="isConfirmOpen=false" wireclick="delete()" color="primary">  
				<span> OK </span>
			</x-button-primary>
			<x-button onclick="isConfirmOpen=false" color="red">
				<span> Batal </span>
			</x-button>
		</div>
	</div>
</div>
</div>