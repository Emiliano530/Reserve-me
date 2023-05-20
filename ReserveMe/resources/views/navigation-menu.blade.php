<style>
    body {
        overflow: hidden;
    }
</style>
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="flex justify-between items-center h-16">
        <!-- burger menu-->
        <div class="flex absolute items-center m-1">
            <button @click="open = !open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-10 w-10 stroke-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Logo -->
        <div class="flex items-center mx-auto">
            <a href="{{ route('dashboard') }}">
                <x-application-mark class="block h-9 w-auto" />
            </a>
        </div>
    </div>


    <!-- Overlay -->
    <div :class="{ 'translate-x-0': open, '-translate-x-full': !open }" class="-translate-x-full fixed inset-0 bg-black z-40 transform transition-transform duration-500 ease-in-out">
        <div class="flex absolute items-center m-1">
            <button @click="open = !open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-10 w-10 stroke-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex flex-col justify-center items-center h-full">
            <a @click="open = false" href="{{ route('dashboard') }}" class="text-white text-xl uppercase hover:border-b hover:border-blue-700">Inicio</a>
            <a @click="open = false" href="{{ route('menu') }}" class="text-white text-xl uppercase hover:border-b hover:border-blue-700">Menu</a>
            <a @click="open = false" href="{{ route('dashboard') }}" class="text-white text-xl uppercase hover:border-b hover:border-blue-700">Inicio</a>
            <a @click="open = false" href="{{ route('dashboard') }}" class="text-white text-xl uppercase hover:border-b hover:border-blue-700">Inicio</a>
        </div>
    </div>
</nav>



