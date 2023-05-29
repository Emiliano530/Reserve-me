<div x-cloak x-data="{ open: false }" :class="{ 'fixed inset-0 h-full z-50': open, 'z-50': !open }">
    <nav class="fixed w-full top-0 bg-black border-b border-gray-800">
        <div class="flex justify-between items-center h-16">
            <!-- burger menu-->
            <div class="flex absolute items-center m-1">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-10 w-10 stroke-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Logo -->
            <div class="flex items-center my-auto mx-auto">
                <a href="{{ route('dashboard') }}">
                    <x-dajohu-reserve />
                </a>
            </div>

            @if (Route::has('login'))
                <div class="flex absolute items-center right-0 mr-2 gap-2">
                    @auth
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        @if ($profileAvatar)
                                            <img class="h-10 w-10 rounded-full object-cover mr-2"
                                                src="{{ asset($profileAvatar) }}" />
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="h-10 w-10 rounded-full bg-indigo-900 object-cover stroke-white mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        @endif
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white bg-white dark:bg-transparent hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-900 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                            {{ $user->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>

                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Administrar cuenta') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('actualizar-perfil') }}">
                                        {{ __('Perfil') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Cerrar sesión') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="m-0">
                            <x-button>iniciar sesion</x-button>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                <x-secondary-button>Registrarse</x-secondary-button>
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>


        <!-- Overlay -->
        <div :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
            class="overlay -translate-x-full fixed inset-0 z-40 bg-black bg-repeat transform transition-transform duration-500 ease-in-out"
            style="background-image: url('{{ asset('img/pattern_green.svg') }}');">
            <div class="flex absolute items-center m-1">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-10 w-10 stroke-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-col justify-center items-center h-full text-center text-white text-3xl uppercase">
                <a @click="open = false" href="{{ route('dashboard') }}"
                    class="border-b-4 border-transparent {{ request()->is('dashboard') || request()->is('/') ? 'border-b-emerald-600 hover:border-indigo-700 px-6 hover:px-8' : 'hover:border-indigo-700 hover:px-8' }}">Inicio</a>
                <a @click="open = false" href="{{ route('menu') }}"
                    class="border-b-4 border-transparent {{ request()->is('menu') ? 'border-b-emerald-600 hover:border-indigo-700 px-6 hover:px-8' : 'hover:border-indigo-700 hover:px-8' }}">Menu</a>
                @auth
                    <a @click="open = false" href="{{ route('reservas') }}"
                        class="border-b-4 border-transparent {{ request()->is('reservas') ? 'border-b-emerald-600 hover:border-indigo-700 px-6 hover:px-8' : 'hover:border-indigo-700 hover:px-8' }}">Reservas</a>
                @endauth
                <a @click="open = false" href="{{ route('dashboard') }}"
                    class="border-b-4 border-transparent {{ request()->is('dashboard') ? 'border-b-emerald-600 hover:border-indigo-700 px-6 hover:px-8' : 'hover:border-indigo-700 hover:px-8' }}">Inicio</a>
            </div>

        </div>
    </nav>
</div>


<style>
    body {
        overflow: auto;
    }

    body.overlay-active {
        overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.querySelector('.transform');

        // Observar cambios en la clase del overlay
        const observer = new MutationObserver(function(mutationsList, observer) {
            const isOpen = overlay.classList.contains('translate-x-0');

            // Agregar o eliminar la clase 'overlay-active' en el body según el estado del overlay
            document.body.classList.toggle('overlay-active', isOpen);
        });

        // Observar cambios en los atributos del overlay
        observer.observe(overlay, {
            attributes: true
        });
    });
</script>
