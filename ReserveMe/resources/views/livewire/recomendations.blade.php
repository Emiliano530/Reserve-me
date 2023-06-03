<div x-cloak x-data="{ mostrar: false, reserva: false }" class="flex mt-10 flex-col items-center justify-center">
    <div class="filtro flex justify-center items-center bg-yellow-900 my-5 rounded-3xl h-20 w-[50vw]">
        <div class="flex items-center justify-center h-full w-full">
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                <x-input class="h-8 text-black w-36" type="date" title="Fecha para reservar"
                    value="{{ date('Y-m-d') }}" />
            </div>
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <x-input class="h-8 text-black w-36" type="time" title="Hora de la reserva"
                    value="{{ date('H:i') }}" />
            </div>
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <x-input class="h-8 text-black w-36" type="number" title="Cantidad de personas" />
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
    <div class="recomendaciones relative p-2 bg-indigo-900 rounded-3xl mx-1 w-[76vw]">
        <div class="flex justify-center items-center p-2 w-full">
            <div class="flex gap-5 text-white p-10">
                @foreach ($visiblepackages as $item)
                    <div @click="mostrar = !mostrar , reserva=!reserva" wire:click="showData({{ $item->id }})"
                        class="card cursor-pointer hover:rotate-1 flex flex-col justify-center bg-black rounded-3xl items-center w-96 min-h-80">
                        <div class="h-full w-full">
                            <div class="flex items-center justify-center h-56">
                                <img class="w-full h-full rounded-t-3xl object-cover"
                                    src="{{ asset($item->packageImage_url) }}" alt="image">
                            </div>
                            <div
                                class="flex flex-col items-center justify-center h-24 p-2 bg-emerald-600 rounded-b-3xl">
                                <div class="p-1 capitalize text-center text-lg font-bold">{{ $item->package_name }}
                                </div>
                                <div class="px-4 text-center break-words overflow-hidden h-12 w-96">
                                    {{ $item->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-2 focus:outline-none"
            wire:click="previousItems">
            <svg aria-hidden="true" class="w-10 h-10 text-gray-800 rounded-full p-2 hover:bg-black/40" fill="none"
                stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>

        </button>
        <button
            class="absolute next-button top-0 right-0 z-30 flex items-center justify-center h-full px-2 focus:outline-none"
            wire:click="nextItems">
            <svg aria-hidden="true" class="w-10 h-10 text-gray-800 rounded-full p-2 hover:bg-black/40" fill="none"
                stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <div :class="{ 'datos': mostrar, 'hidden': !mostrar }"
        class="overlay mostrar overflow-hidden fixed inset-0 z-40 flex flex-col justify-center items-center bg-black/80">
        <div :class="{ '': reserva, 'hidden': !reserva }"
            class="modal relative z-50 flex gap-2 items-center justify-center rounded-3xl overflow-hidden bg-gradient-to-br from-emerald-600 to-indigo-600  min-w-[50vw] min-h-[20vw]">
            <span wire:loading class="text-white">Cargando..</span>
            @if ($package)
                <img wire:loading.remove class="absolute w-60 min-h-[20vw] left-0 rounded-r-full object-cover"
                    src="{{ asset($package->packageImage_url) }}" alt="image">
                <div class="absolute w-[32vw] min-h-[18vw] left-60 text-white flex flex-col items-center">
                    <div class="text-3xl font-bold p-2 border-b-2 mb-1 border-b-white">{{ $package->package_name }}
                    </div>
                    <div class="p-2">{{ $package->description }}</div>
                    <div class="font-bold p-2">Este paquete contiene:</div>
                    @if (count($package->options) > 4)
                        <ul class="text-white list-disc list-inside grid grid-cols-2 gap-2">
                            @foreach ($package->options as $option)
                                <li class="">{{ $option }}</li>
                            @endforeach
                        </ul>
                    @else
                        <ul class="text-white list-disc list-inside">
                            @foreach ($package->options as $option)
                                <li class="">{{ $option }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <span class="absolute bottom-0 right-0 text-white mt-5 p-5 break-words">Precio por persona:
                        ${{ $package->priceXguest }}</span>
                </div>
            @endif




            <div class="absolute p-4 top-0 right-0" @click="mostrar = !mostrar" wire:click="clearPackage">
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
            <x-label for="personas">Cantidad de personas:</x-label>
            <x-input id="personas" placeholder="cantidad de personas" type="number"/>
            <x-label for="fecha">Fecha:</x-label>
            <x-input id="fecha" placeholder="fecha" type="date"/>
            <x-label for="hora">Hora:</x-label>
            <x-input id="hora" placeholder="hora" type="time"/>
            <x-label for="referencia">Nombre de referencia:</x-label>
            <x-input id="referencia" placeholder="nombre de referencia" type="text"/>
            <x-label for="evento">Evento asociado</x-label>
            <x-input id="evento" placeholder="opcional" type="text"/>
            <div class="absolute p-4 top-0 right-0" @click="mostrar = !mostrar" wire:click="clearPackage">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-10 h-10 stroke-white hover:stroke-red-600 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
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
</script>
