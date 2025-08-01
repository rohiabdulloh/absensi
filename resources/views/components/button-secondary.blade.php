<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs 
    bg-white text-gray-700 dark:bg-gray-900 dark:text-gray-400  border border-gray-300 dark:border-gray-600
    uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none 
    focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 
    transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
