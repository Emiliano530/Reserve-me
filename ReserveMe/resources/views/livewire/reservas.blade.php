<div x-cloak x-data="{ reservas: true, historial: false }" class="flex flex-col gap-5">
    <div class="flex gap-2">
        <div @click="reservas = true, historial = true"
            class="text-center rounded-lg hover:bg-emerald-600 bg-emerald-700 cursor-pointer w-40 text-xl">Expandir todo
        </div>
        <div @click="reservas = false, historial = false"
            class="text-center rounded-lg hover:bg-emerald-600 bg-emerald-700 cursor-pointer w-40 text-xl">Colapsar todo
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
                        <div class="p-3 text-center w-1/5">Personas</div>
                        <div class="p-3 text-center w-2/5">Fecha y hora</div>
                        <div class="p-3 text-center w-1/5">Evento</div>
                        <div class="p-3 text-center w-1/5">Estado</div>
                        <div class="p-3 text-center w-1/5">Acciones</div>
                    </div>
                    @foreach ($reservasPendientes as $reservacion)
                        <div
                            class="flex gap-4 {{ $loop->iteration % 2 === 0 ? 'bg-blue-300' : 'bg-gray-300' }} text-black rounded-3xl">
                            <div class="p-3 text-center w-1/5">{{ $reservacion->guest_number }}</div>
                            <div class="p-3 text-center w-2/5">{{ $reservacion->reservation_datetime }}</div>
                            <div class="p-3 text-center w-1/5">{{ $reservacion->associated_event }}</div>
                            <div class="p-3 text-center w-1/5">
                                <span
                                    class="bg-gray-600 p-2 rounded-3xl text-white">{{ $reservacion->reservation_status }}</span>
                            </div>
                            <div class="flex gap-5 justify-center items-center p-3 text-center w-1/5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 stroke-emerald-600 hover:stroke-emerald-800 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    wire:click="confirmarActualizarColumna({{ $reservacion->id }})"
                                    class="w-6 h-6 stroke-red-600 hover:stroke-red-800 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
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
                    <div class="flex gap-4 bg-indigo-600 rounded-3xl rounded-tr-3xl">
                        <div class="p-3 text-center w-1/5">Personas</div>
                        <div class="p-3 text-center w-2/5">Fecha y hora</div>
                        <div class="p-3 text-center w-1/5">Evento</div>
                        <div class="p-3 text-center w-1/5">Estado</div>
                        <div class="p-3 text-center w-1/5">Acciones</div>
                    </div>
                    @foreach ($reservasHistorial as $reservacion)
                        <div
                            class="flex gap-4 {{ $loop->iteration % 2 === 0 ? 'bg-blue-300' : 'bg-gray-300' }} text-black rounded-3xl">
                            <div class="p-3 text-center w-1/5">{{ $reservacion->guest_number }}</div>
                            <div class="p-3 text-center w-2/5">{{ $reservacion->reservation_datetime }}</div>
                            <div class="p-3 text-center w-1/5">{{ $reservacion->associated_event }}</div>
                            <div class="p-3 text-center w-1/5"><span
                                    class="{{ $reservacion->reservation_status === 'Cancelada' ? 'bg-emerald-600' : 'bg-red-600' }} p-2 rounded-3xl text-white">{{ $reservacion->reservation_status }}</span>
                            </div>
                            <div wire:click="confirmarEliminarReserva({{ $reservacion->id }})"
                                class="flex gap-5 justify-center items-center p-3 text-center w-1/5 text-red-600 hover:text-red-700 cursor-pointer">
                                Eliminar
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
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
        Livewire.on('confirm', function(title, message) {
            Swal.fire(
                title,
                message,
                'success'
            )
        });
    });
</script>
