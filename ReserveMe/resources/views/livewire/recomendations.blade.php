<div x-cloak x-data="{ mostrar: false }" class="flex flex-col items-center justify-center">
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
        <button class="flex items-center justify-center rounded-r-3xl bg-emerald-600 h-full right-0 p-5">
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
                    <div @click="mostrar = !mostrar" wire:click="showData({{ $item->id }})"
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
    @if ($package)
        <div :class="{ '': mostrar, 'hidden': !mostrar }"
            class="overlay overflow-hidden no- fixed inset-0 z-50 flex justify-center items-center bg-black/60">
            <span class="text-white">{{ $package->package_name }}</span>
        </div>
    @endif
</div>


