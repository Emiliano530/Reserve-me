<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-emerald-900 border border-transparent rounded-3xl font-semibold text-xs text-white dark:white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-emerald-600 focus:bg-gray-700 dark:focus:bg-emerald-700 active:bg-gray-900 dark:active:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
