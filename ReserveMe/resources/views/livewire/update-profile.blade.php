<div class="flex justify-start flex-col items-center text-center w-screen">

    <div class="flex gap-10 pt-16 px-44">
        <div class="relative w-44 h-44">
            @if ($profileAvatar)
                <img class="w-full h-full rounded-full object-cover" src="{{ asset($profileAvatar) }}"
                    alt="Profile Avatar">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-full h-full rounded-full bg-indigo-900 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            @endif
            <label for="profileAvatar"
                class="absolute top-0 right-0 flex items-center justify-center cursor-pointer hover:bg-emerald-500 shadow-md hover:scale-110 w-10 h-10 bg-emerald-600 rounded-full transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-full h-full p-2 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
            </label>
            <input type="file" id="profileAvatar" wire:model="profileAvatar" class="hidden">
            <x-input-error for="profileAvatar" class="mt-2" />
        </div>

        <form wire:submit.prevent="update">
            <div class="flex gap-2">
                <div class="mx-auto bg-indigo-900 rounded-3xl sm:px-6 lg:px-8 w-[30vw]">
                    <div class="p-5 overflow-hidden sm:rounded-3xl">
                        <h1 class="text-white text-2xl">Datos de usuario</h1>
                        <div class="col-span-6 sm:col-span-4 mt-4">
                            <x-label for="name" value="{{ __('Nombre/s') }}" />
                            <x-input id="name" placeholder="Agrega tu nombre" wire:model="name" type="text"
                                class="mt-1 block w-full" autocomplete="name" />
                            <x-input-error for="name" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 mt-4">
                            <x-label for="lastName" value="{{ __('Apellidos') }}" />
                            <x-input id="lastName" placeholder="Agrega tu apellido" wire:model="lastName"
                                type="text" class="mt-1 block w-full" autocomplete="lastName" />
                            <x-input-error for="lastName" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 mt-4">
                            <x-label for="phone" value="{{ __('Telefono') }}" />
                            <x-input id="phone" placeholder="Agrega tu numero de telefono" wire:model="phone"
                                type="number" class="mt-1 block w-full" autocomplete="phone" />
                            <x-input-error for="phone" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 mt-4">
                            <x-label for="birthday" value="{{ __('Fecha de nacimiento') }}" />
                            <x-input id="birthday" placeholder="Agrega tu fecha de nacimiento" wire:model="birthday"
                                type="date" class="mt-1 block w-full" autocomplete="birthday" />
                            <x-input-error for="birthday" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 mt-4">
                            <x-label for="email" value="{{ __('Correo') }}" />
                            <x-input id="email" placeholder="Agrega tu correo" wire:model="email" type="text"
                                class="mt-1 block w-full" autocomplete="email" />
                            <x-input-error for="email" class="mt-2" />
                        </div>
                        <x-primary-button class="mt-5">
                            {{ __('Guardar') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form>
        <div class="mx-auto bg-indigo-900 rounded-3xl sm:px-6 lg:px-8 w-[25vw] h-1/2">
            <form wire:submit.prevent="updatePassword">
                <div class="p-5 overflow-hidden sm:rounded-3xl">
                    <h1 class="text-white text-2xl">Contraseña</h1>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="currentPassword" value="{{ __('Contraseña Actual') }}" />
                        <x-input id="currentPassword" placeholder="Ingresa tu contraseña actual"
                            wire:model="currentPassword" type="password" class="mt-1 block w-full"
                            autocomplete="current-password" />
                        <x-input-error for="currentPassword" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="newPassword" value="{{ __('Contraseña Nueva') }}" />
                        <x-input id="newPassword" placeholder="Ingresa tu contraseña nueva" wire:model="newPassword"
                            type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error for="newPassword" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="confirmPassword" value="{{ __('Confirmar Contraseña Nueva') }}" />
                        <x-input id="confirmPassword" placeholder="Confirma tu contraseña nueva"
                            wire:model="confirmPassword" type="password" class="mt-1 block w-full"
                            autocomplete="new-password" />
                        <x-input-error for="confirmPassword" class="mt-2" />
                    </div>
                    <x-primary-button class="mt-5">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('notification', function(type, message) {
            var icon = getIconByType(type); // Obtener el icono según el tipo de mensaje
            var timer = getTimerByType(type); // Obtener el temporizador según el tipo de mensaje
            Swal.fire({
                title: type,
                text: message,
                icon: icon,
                timer: timer, // Tiempo en milisegundos
                showConfirmButton: false
            });
        });

        function getIconByType(type) {
            // Asignar el icono correspondiente según el tipo de mensaje
            switch (type) {
                case 'error':
                    return 'error';
                case 'hecho':
                    return 'success';
                    // Agregar más casos según sea necesario
                default:
                    return 'info';
            }
        }

        function getTimerByType(type) {
            // Asignar el temporizador correspondiente según el tipo de mensaje
            switch (type) {
                case 'error':
                    return 3000; // 2 segundos
                    // Agregar más casos según sea necesario
                default:
                    return 1500; // 1.5 segundos (valor predeterminado)
            }
        }
    });
</script>
