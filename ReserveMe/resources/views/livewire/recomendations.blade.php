<div x-cloak x-data="{ mostrar: false, reserva: false }" class="flex mt-10 flex-col items-center justify-center">
    <div class="filtro flex justify-center items-center bg-yellow-900 my-5 rounded-3xl h-20 w-[50vw]">
        <div class="flex items-center justify-center h-full w-full">
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                <x-input class="h-8 text-black w-36 cursor-pointer" type="text" title="Fecha para reservar"
                    wire:model="fecha" value="{{ date('Y-m-d') }}" id="fecha" readonly />
            </div>
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <x-input class="h-8 text-black w-36 cursor-pointer" type="text" title="Hora de la reserva"
                    wire:model="hora" value="{{ date('H:i') }}" id="hora" readonly />
            </div>
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <x-input class="h-8 text-black w-36" title="Cantidad de personas" wire:model="personas" id="personas"
                    placeholder="cantidad de personas" type="number" min="1" max="50"
                    onkeydown="validarNumero(event, this)" />
            </div>
        </div>
        <button wire:click="sendFilter"
            class="flex items-center justify-center rounded-r-3xl bg-emerald-600 h-full right-0 p-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-10 h-10 stroke-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </button>
    </div>
    <div class="recomendaciones p-2 bg-indigo-900 rounded-3xl mx-1 w-[76vw]">
        <div class="flex items-center justify-center mt-5 mb-0">
            <h1 class="text-white text-3xl px-10 py-2 border-b-2 border-white">Paquetes</h1>
        </div>
        <div class="flex relative justify-center items-center p-2 w-full">
            <div class="flex gap-5 text-white p-10">
                @foreach ($visiblepackages as $item)
                    <div @click="mostrar = !mostrar , reserva=!reserva" wire:click="showData({{ $item->id }})"
                        class="card cursor-pointer hover:rotate-1 flex flex-col justify-center bg-black rounded-3xl items-center w-96 min-h-80">
                        <div class="h-full w-full">
                            <div class="flex items-center justify-center h-56">

                                @if ($item->packageImage_url)
                                    <img class="w-full h-full rounded-t-3xl object-cover"
                                        src="{{ asset($item->packageImage_url) }}">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-full h-full rounded-t-3xl stroke-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex flex-col items-center h-28 px-2 py-2 bg-emerald-600 rounded-b-3xl">
                                <div class="capitalize text-center text-lg font-bold px-10 border-b border-white">
                                    {{ $item->package_name }}
                                </div>
                                <div class="px-4 py-2 text-gray-200 text-center break-words overflow-hidden w-96">
                                    {{ $item->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-0 focus:outline-none"
                wire:click="previousItems">
                <svg aria-hidden="true" class="w-10 h-10 text-gray-800 rounded-full p-2 hover:bg-black/40"
                    fill="none" stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>

            </button>
            <button
                class="absolute next-button top-0 right-0 z-30 flex items-center justify-center h-full px-0 focus:outline-none"
                wire:click="nextItems">
                <svg aria-hidden="true" class="w-10 h-10 text-gray-800 rounded-full p-2 hover:bg-black/40"
                    fill="none" stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

    </div>
    <div :class="{ 'datos': mostrar, 'hidden': !mostrar }"
        class="overlay mostrar overflow-hidden fixed inset-0 z-40 flex flex-col justify-center items-center bg-black/80">
        <div :class="{ '': reserva, 'hidden': !reserva }"
            class="modal relative z-50 flex gap-2 items-center justify-center rounded-3xl overflow-hidden bg-gradient-to-br from-emerald-600 to-indigo-600  min-w-[50vw] min-h-[25vw]">
            <span wire:loading class="text-white">Cargando..</span>
            @if ($package)

                @if ($package->packageImage_url)
                    <img wire:loading.remove class="absolute w-60 min-h-[25vw] left-0 rounded-r-full object-cover"
                        src="{{ asset($package->packageImage_url) }}">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" wire:loading.remove
                        class="absolute w-60 min-h-[25vw] bg-slate-700 stroke-white left-0 rounded-r-full object-cover">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                @endif
                <div class="absolute w-[32vw] min-h-[23vw] left-60 text-white flex flex-col items-center">
                    <div class="text-3xl font-bold p-2 mb-1">{{ $package->package_name }}</div>
                    <div class="p-2 text-lg">{{ $package->description }}</div>
                    <div class="font-bold p-2 mt-4 border-t border-t-white mb-2">Este paquete contiene:</div>
                    <ul class="text-gray-200 px-10 py-2 list-disc list-inside grid grid-cols-3 gap-y-2 gap-x-5">
                        @if ($package->options)
                            @php
                                $options = unserialize($package->options);
                            @endphp
                            @foreach ($options as $option)
                                <li class="">{{ $option }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <span
                    class="absolute bottom-0 right-0 text-white text-xl mt-5 p-5 break-words overflow-wrap: break-word;">
                    <strong>${{ $package->priceXguest }}</strong> MXN/pers.</span>
            @endif
            <!--close-->
            <div class="absolute p-4 top-0 right-0" wire:click="clearPackage"
                @click="mostrar = !mostrar, reserva=!reserva ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-10 h-10 stroke-white hover:stroke-red-600 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <button :class="{ '': reserva, 'hidden': !reserva }" @click="reserva=!reserva"
            class="hover:scale-105 transition-all bg-gradient-to-r from-blue-500 to-violet-500 hover:bg-gradient-to-r hover:from-violet-500 hover:to-blue-500 py-4 px-2 font-bold text-xl text-white z-40 rounded-full mt-5"><span
                class="border-4 px-4 py-2 w-full rounded-full border-white">Reservar con este paquete</span></button>
        <div :class="{ 'hidden': reserva, '': !reserva }"
            class="modal relative z-50 flex flex-col gap-2 p-10 justify-center rounded-3xl overflow-hidden bg-gradient-to-br from-emerald-600 to-indigo-600  min-w-[25vw] min-h-[30vw]">
            <div class="flex justify-center items-center pb-5 border-b mb-2 border-b-white">
                <x-dajohu-reserve />
            </div>
            <!--input 1-->
            <x-label class="font-bold" for="personas">Cantidad de personas:</x-label>
            <x-input-icon wire:model="personas" class="w-96 text-center" id="personas"
                placeholder="cantidad de personas" type="number" min="1" max="50"
                onkeydown="validarNumero(event, this)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="black" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </x-input-icon>
            <!--input 2-->
            <x-label class="font-bold  mt-2" for="fecha">Fecha:</x-label>
            <x-input-icon wire:model="fecha" class="w-96 text-center cursor-pointer" id="fecha"
                placeholder="fecha" type="text" readonly>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="black" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
            </x-input-icon>
            <!--input 3-->
            <x-label class="font-bold  mt-2" for="hora">Hora:</x-label>
            <x-input-icon wire:model="hora" class="w-96 text-center cursor-pointer" id="hora"
                placeholder="hora" type="text" readonly>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="black" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-input-icon>
            <!--input 4-->
            <x-label class="font-bold  mt-2" for="referencia">Nombre de referencia:</x-label>
            <x-input-icon wire:model="referencia" class="w-96 text-center" id="referencia"
                placeholder="nombre de referencia" type="text">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="black" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </x-input-icon>
            <!--input 5-->
            <x-label class="font-bold  mt-2" for="evento">Evento asociado</x-label>
            <x-input-icon wire:model="evento" class="w-96 text-center" id="evento" placeholder="opcional"
                type="text">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="black" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                </svg>
            </x-input-icon>

            <div class="flex justify-center items-center gap-2 mt-5">
                <x-button wire:click="MakeReservation" class="text-xl">Reservar</x-button>
                <x-secondary-button class="text-2xl" wire:click="clearPackage"
                    @click="mostrar = !mostrar; reserva=false">Cancelar
                </x-secondary-button>
            </div>
            <!--close-->
            <div class="absolute p-4 top-0 right-0" wire:click="clearPackage"
                @click="mostrar = !mostrar; reserva=false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-10 h-10 stroke-white hover:stroke-red-600 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
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
        document.addEventListener('livewire:load', function() {
            flatpickr('#fecha', {
                locale: 'es',
                dateFormat: 'D, d M Y',
                disable: [
                    function(date) {
                        // Obtenemos el día de la semana (0: domingo, 1: lunes, ..., 6: sábado)
                        const day = date.getDay();

                        // Deshabilitamos los días que no sean viernes, sábado, domingo o lunes
                        return ![5, 6, 0, 1].includes(day);
                    }
                ],
                // Configuración adicional de Flatpickr si es necesario
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('#hora', {
                locale: 'es',
                enableTime: true,
                noCalendar: true,
                dateFormat: 'h:i K',
                time_24hr: false,
                minTime: '07:00',
                maxTime: '22:30',
                // Configuración adicional de Flatpickr si es necesario
            });
        });

        function validarNumero(event, input) {
            var tecla = event.key;
            var valor = input.value + tecla;
            var numero = parseInt(valor);

            if ((tecla === "-" || tecla === "+") || isNaN(numero) || numero <= 0 || numero > 50) {
                event.preventDefault(); // Evitar que se ingrese el carácter no válido
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.querySelector('.mostrar');

            // Observar cambios en la clase del overlay
            const observer = new MutationObserver(function(mutationsList, observer) {
                const isOpen = overlay.classList.contains('datos');

                // Agregar o eliminar la clase 'overlay-active' en el body según el estado del overlay
                document.body.classList.toggle('overlay-active', isOpen);
            });

            // Observar cambios en los atributos del overlay
            observer.observe(overlay, {
                attributes: true
            });
        });

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
</div>
