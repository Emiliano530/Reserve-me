<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-300 border border-gray-500 rounded-3xl font-semibold text-xs text-black uppercase tracking-widest shadow-sm hover:text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:bg-gray-600 focus:ring-gray-300 focus:ring-offset-2 focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
