<div class="py-12"></div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-blue-900 p-5 overflow-hidden shadow-xl sm:rounded-3xl">
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="name" value="{{ __('Nombre/s') }}" />
                <x-input id="name" placeholder="Agrega tu nombre" value="{{ $user->name }}" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="lastName" value="{{ __('Apellidos') }}" />
                <x-input id="lastName" placeholder="Agrega tu apellido" value="{{ $user->lastName }}" type="text" class="mt-1 block w-full" wire:model.defer="state.lastName" autocomplete="lastName" />
                <x-input-error for="lastName" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="phone" value="{{ __('Telefono') }}" />
                <x-input id="phone" placeholder="Agrega tu numero de telefono" value="{{ $user->phone }}" type="number" class="mt-1 block w-full" wire:model.defer="state.phone" autocomplete="phone" />
                <x-input-error for="phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="birthday" value="{{ __('Fecha de nacimiento') }}" />
                <x-input id="birthday" placeholder="Agrega tu fecha de nacimiento" value="{{ $user->birthday }}" type="date" class="mt-1 block w-full" wire:model.defer="state.birthday" autocomplete="birthday" />
                <x-input-error for="birthday" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input id="email" placeholder="Agrega tu email" value="{{ $user->email}}" type="text" class="mt-1 block w-full" wire:model.defer="state.email" autocomplete="email" />
                <x-input-error for="email" class="mt-2" />
            </div>
            <x-primary-button class="mt-5" wire:click="updateProfile">Guardar</x-primary-button>
        </div>
    </div>
</div>
