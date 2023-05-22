<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-gray-300 border border-gray-300 dark:border-gray-500 rounded-3xl font-semibold text-xs text-gray-700 dark:text-black uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:text-white dark:hover:bg-gray-500 focus:outline-none focus:ring-2 dark:focus:bg-gray-600 focus:ring-gray-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
