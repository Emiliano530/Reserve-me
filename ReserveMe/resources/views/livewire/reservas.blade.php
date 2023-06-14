<div x-cloak x-data="{ reservas: true, historial: false }" class="flex flex-col gap-5 text-white">
    <div class="flex gap-2">
        <div @click="reservas = true, historial = true"
            class="flex items-center justify-center text-base text-center rounded-lg hover:bg-emerald-600 bg-emerald-700 cursor-pointer px-2">
            Expandir todo
        </div>
        <div @click="reservas = false, historial = false"
            class="flex items-center justify-center text-base text-center rounded-lg hover:bg-emerald-600 bg-emerald-700 cursor-pointer px-2">
            Colapsar todo
        </div>
    </div>
    <div :class="{ 'max-h-[90vw]': reservas, 'max-h-[3vw]': !reservas }"
        class="bg-black/40 rounded-3xl overflow-hidden transition-all duration-500">
        <div @click="reservas = !reservas"
            class="flex justify-center items-center cursor-pointer bg-black rounded-3xl p-2 h-[3vw] w-[60vw]">
            <h1 class="text-center flex-1">Mis reservas</h1>
            <svg class="h-6 w-6 stroke-white ml-auto mr-2" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'inline-flex': reservas, 'hidden': !reservas }" class="inline-flex"
                    stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                <path :class="{ 'inline-flex': !reservas, 'hidden': reservas }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </div>

        <div class="flex flex-col justify-center items-center p-2">
            @if ($reservasPendientes->isEmpty())
                <h1>No hay reservas pendientes</h1>
            @else
                <div class="flex flex-col w-[50vw] space-y-2 text-lg font-bold">
                    <div class="flex gap-4 bg-indigo-600 rounded-3xl rounded-tr-3xl">
                        <div class="p-1 text-center w-1/5">Personas</div>
                        <div class="p-1 text-center w-2/5">Fecha y hora</div>
                        <div class="p-1 text-center w-1/5">Evento</div>
                        <div class="p-1 text-center w-1/5">Estado</div>
                        <div class="p-1 text-center w-1/5">Acciones</div>
                    </div>
                    @foreach ($reservasPendientes as $reservacion)
                        <div class="flex gap-4 bg-gray-300 text-black rounded-3xl">
                            <div class="p-1 text-center w-1/5">{{ $reservacion->guest_number }}</div>
                            <div class="p-1 text-center w-2/5">{{ $reservacion->reservation_datetime }}</div>
                            <div class="p-1 text-center w-1/5">{{ $reservacion->associated_event }}</div>
                            <div class="p-1 text-center w-1/5">
                                <span
                                    class="bg-gray-600 px-2 py-1 rounded-3xl text-white">{{ $reservacion->reservation_status }}</span>
                            </div>

                            <div wire:click="confirmarActualizarColumna({{ $reservacion->id }})"
                                class="flex gap-5 justify-center items-center p-1 text-center w-1/5 text-red-600 hover:text-red-700 cursor-pointer">
                                Cancelar
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div :class="{ 'max-h-[90vw]': historial, 'max-h-[3vw]': !historial }"
        class="bg-black/40 rounded-3xl overflow-hidden transition-all duration-500">
        <div @click="historial = !historial"
            class="flex justify-center items-center cursor-pointer bg-black rounded-3xl p-2 h-[3vw] w-[60vw]">
            <h1 class="text-center flex-1">Historial</h1>
            <svg class="h-6 w-6 stroke-white ml-auto mr-2" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'inline-flex': historial, 'hidden': !historial }" class="inline-flex"
                    stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                <path :class="{ 'inline-flex': !historial, 'hidden': historial }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </div>
        <div class="flex flex-col justify-center items-center p-2">
            @if ($reservasHistorial->isEmpty())
                <h1>No hay reservas en el historial</h1>
            @else
                <div class="flex flex-col w-[50vw] space-y-2 text-lg font-bold">
                    <div class="text-right text-white mb-1">
                        <x-button class=" flex gap-1 bg-red-600 hover:bg-red-500 focus:bg-red-800"
                            wire:click="confirmarEliminarHistorial">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <h1>Eliminar historial</h1>
                        </x-button>
                    </div>
                    <div class="flex gap-4 bg-indigo-600 rounded-3xl rounded-tr-3xl">
                        <div class="p-1 text-center w-1/5">Personas</div>
                        <div class="p-1 text-center w-2/5">Fecha y hora</div>
                        <div class="p-1 text-center w-1/5">Evento</div>
                        <div class="p-1 text-center w-1/5">Estado</div>
                        <div class="p-1 text-center w-1/5">Acciones</div>
                    </div>
                    @foreach ($reservasHistorial as $reservacion)
                        <div class="flex gap-4 bg-gray-300 text-black rounded-3xl">
                            <div class="p-1 text-center w-1/5">{{ $reservacion->guest_number }}</div>
                            <div class="p-1 text-center w-2/5">{{ $reservacion->reservation_datetime }}</div>
                            <div class="flex items-center justify-center p-1 text-center w-1/5">
                                @empty($reservacion->associated_event)
                                    <div class="text-sm text-gray-500">No hay evento</div>
                                @else
                                    {{ $reservacion->associated_event }}
                                @endempty
                            </div>
                            <div class="p-1 text-center w-1/5"><span
                                    class="{{ $reservacion->reservation_status === 'Cancelada' ? 'bg-emerald-600' : 'bg-red-600' }} px-2 py-1 rounded-3xl text-white">{{ $reservacion->reservation_status }}</span>
                            </div>
                            <div wire:click="confirmarEliminarReserva({{ $reservacion->id }})"
                                class="flex gap-5 justify-center items-center p-1 text-center w-1/5 text-red-600 hover:text-red-700 cursor-pointer">
                                Eliminar
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('cancelar', function(id, message) {
                Swal.fire({
                    title: message,
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cancelar',
                    cancelButtonText: 'No, mantener',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('actualizarColumna', id);
                    }
                })
            });
            Livewire.on('eliminar', function(id, message) {
                Swal.fire({
                    title: message,
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'No, mantener',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('eliminarReserva', id);
                    }
                })
            });
            Livewire.on('confirmEliminarHistorial', function(message) {
                Swal.fire({
                    title: message,
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'No, mantener',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('eliminarHistorial');
                    }
                })
            });
            Livewire.on('confirm', function(title, message) {
                Swal.fire({
                    title: title,
                    text: message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000
                })
            });
            Livewire.on('confirmCancel', function(title, message, id) {
                Swal.fire({
                    title: title,
                    text: message,
                    iconHtml: '<img src="{{ asset('img/apologize.svg') }}" class="custom-icon">',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonText: 'Enviar',
                    cancelButtonText: 'Continuar',
                    input: 'text',
                    inputPlaceholder: 'Opcional',
                    customClass: {
                        icon: 'custom-icon',
                    },
                    allowOutsideClick: () => !Swal
                        .isLoading(), // Evitar que se cierre al hacer clic fuera
                    preConfirm: (inputValue) => {
                        // Verificar si el campo está vacío
                        if (inputValue === '') {
                            Swal.showValidationMessage('Debes ingresar un valor en el campo');
                        }
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Obtener el valor del campo de entrada
                        const inputValue = result.value;
                        // Verificar si el campo está vacío
                        if (inputValue !== '') {
                            Livewire.emit('guardarRazon', id, inputValue);
                        }
                    }
                });
            });


            Livewire.on('guardado', function(type, message) {
                var icon = getIconByType(type); // Obtener el icono según el tipo de mensaje
                var timer = getTimerByType(type); // Obtener el temporizador según el tipo de mensaje
                Swal.fire({
                    title: type,
                    text: message,
                    icon: icon,
                    timer: timer, // Tiempo en milisegundos
                    showConfirmButton: false
                }).then((result) => {
                    Livewire.emit('redireccionar');
                })
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
    <style>
        .custom-icon {
            width: 150px;
            /* Ajusta el ancho de la imagen según tus necesidades */
            height: auto;
            /* Mantén la relación de aspecto original */
            border: 0;
            /* Elimina el borde circular */
            padding: 0;
        }
    </style>
</div>
