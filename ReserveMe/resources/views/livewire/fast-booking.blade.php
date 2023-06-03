<div x-cloak x-data="{ open: false, hideBody: false, hideDelay: 1000, hideTimeout: null }" class="fastbooking fixed bottom-0 right-5 z-30 text-white">
    <div :class="{ 'h-[18vw]': open, 'h-[2.9vw]': !open }"
        class="container p-2 overflow-hidden transition-all duration-1000">
        <div @click="open = !open; hideBody = false;"
            class="flex gap-2 cursor-pointer justify-center p-5 h-[2.9vw] items-center bg-emerald-600 rounded-t-3xl flex-shrink-0 border-2 border-black border-b-0">
            <div class="text-xl whitespace-nowrap">Haz una reservación</div>
            <svg class="h-6 w-6 stroke-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </div>
        <div :class="{ '': !hideBody, 'hidden': hideBody }"
            class="cuerpo flex flex-col h-[14.6vw] gap-2 overflow-hidden justify-center items-center bg-blue-800 rounded-b-3xl border-2 border-black p-4">
            <div class="flex gap-2 items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                <x-input wire:model="fecha" class="h-8 text-black w-36" type="date" title="Fecha para reservar"
                    value="{{ date('Y-m-d') }}" />
            </div>
            <div class="flex gap-2 items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <x-input wire:model="hora" class="h-8 text-black w-36" type="time" title="Hora de la reserva"
                    value="{{ date('H:i') }}" />
            </div>
            <div class="flex gap-2 items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <x-input wire:model="cantidad_personas" class="h-8 text-black w-36" type="number"
                    title="Cantidad de personas" />
            </div>
            <x-button wire:click="MakeReservation"
                @click="open = !open; clearTimeout(hideTimeout); hideTimeout = setTimeout(() => hideBody = true, hideDelay)"
                class="mt-2">Reservar</x-button>
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
            })
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
