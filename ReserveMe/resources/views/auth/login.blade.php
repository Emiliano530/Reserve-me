<x-guest-layout>

    <x-authentication-card>
        <x-slot name="logo">
            <x-dajohu-reserve />
        </x-slot>
        <x-slot name="titulo">
            Inicio de sesión
        </x-slot>
        <x-slot name="subtitulo">
            Ingresa tus credenciales
        </x-slot>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input-icon id="email" placeholder="Ingrese su correo" class="block mt-1 w-full" type="email"
                    name="email" :value="old('email')" required autofocus autocomplete="username">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-6 h-6">
                        <path stroke-linecap="round"
                            d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25" />
                    </svg>
                </x-input-icon>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input-icon id="password" placeholder="Ingrese su contraseña" class="block mt-1 w-full"
                    type="password" name="password" required autocomplete="current-password">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>
                </x-input-icon>
            </div>

            <div class="block mt-4 pb-10 border-b-black border-b-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-white">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-center justify-end mt-4">
                <div>
                    <a href="/register">
                        <x-secondary-button class="ml-4">
                            {{ __('Registrarse') }}
                        </x-secondary-button>
                    </a>
                    <x-primary-button class="ml-4">
                        {{ __('Iniciar sesion') }}
                    </x-primary-button>
                </div>
                @if (Route::has('password.request'))
                    <a class="underline mt-5 text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
