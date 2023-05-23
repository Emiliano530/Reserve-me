<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-blue-900 p-5 overflow-hidden shadow-xl sm:rounded-3xl">
        @if (session()->has('message'))
            <div>{{ session('message') }}</div>
        @endif
        <div class="w-44 h-44">
            @if ($profileAvatar)
                <img class="w-full h-full rounded-full" src="data:image/jpeg;base64,{{ base64_encode($profileAvatar) }}"
                    alt="Profile Avatar" />
            @else
                <span>No hay imagen de perfil</span>
            @endif
        </div>
        <form wire:submit.prevent="update">
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="name" value="{{ __('Nombre/s') }}" />
                <x-input id="name" placeholder="Agrega tu nombre" wire:model="name" type="text"
                    class="mt-1 block w-full" autocomplete="name" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="lastName" value="{{ __('Apellidos') }}" />
                <x-input id="lastName" placeholder="Agrega tu apellido" wire:model="lastName" type="text"
                    class="mt-1 block w-full" autocomplete="lastName" />
                <x-input-error for="lastName" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="phone" value="{{ __('Telefono') }}" />
                <x-input id="phone" placeholder="Agrega tu numero de telefono" wire:model="phone" type="number"
                    class="mt-1 block w-full" autocomplete="phone" />
                <x-input-error for="phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="birthday" value="{{ __('Fecha de nacimiento') }}" />
                <x-input id="birthday" placeholder="Agrega tu fecha de nacimiento" wire:model="birthday" type="date"
                    class="mt-1 block w-full" autocomplete="birthday" />
                <x-input-error for="birthday" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input id="email" placeholder="Agrega tu fecha de nacimiento" wire:model="email" type="text"
                    class="mt-1 block w-full" autocomplete="email" />
                <x-input-error for="email" class="mt-2" />
            </div>

            <a href="#">
                <x-primary-button class="mt-5">
                    {{ __('Guardar') }}
                </x-primary-button>
            </a>
        </form>
    </div>
</div>
