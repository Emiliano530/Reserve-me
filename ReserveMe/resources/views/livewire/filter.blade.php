<div class="flex mt-10 flex-col items-center justify-center">
    <div class="filtro flex justify-center items-center bg-yellow-900 my-5 rounded-3xl h-20 w-[50vw]">
        <div class="flex items-center justify-center h-full w-full">
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                <x-input class="h-8 text-black w-36" type="date" title="Fecha para reservar" wire:model="fecha"
                    value="{{ $fecha }}" />
            </div>
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <x-input class="h-8 text-black w-36" type="time" title="Hora de la reserva" wire:model="hora"
                    value="{{ $hora }}" />
            </div>
            <div class="flex justify-center items-center p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <x-input class="h-8 text-black w-36" type="number" wire:model="personas"
                    title="Cantidad de personas" />
            </div>
        </div>
        <button wire:click="findFilter"
            class="flex items-center justify-center rounded-r-3xl bg-emerald-600 h-full right-0 p-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-10 h-10 stroke-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </button>
    </div>
    <div class="grid grid-cols-8 gap-5 justify-center items-start p-5 bg-indigo-900 rounded-3xl mx-1 w-[76vw]">
        <div class="flex flex-col justify-center items-center col-span-2 bg-white p-4 rounded-3xl">
            <h1 class="px-10 py-2 border-b-4 border-b-black mb-4 text-xl font-bold">Filtrar por área</h1>
            <div class="flex flex-col justify-between">
                @foreach ($areas as $area)
                    <div class="flex items-center justify-start gap-4 px-5 py-1">
                        <div class="flex items-center">
                            <x-checkbox type="checkbox" id="{{ $area->id }}" wire:model="selectedOptions"
                                value="{{ $area->id }}" />
                        </div>
                        <h1 class="text-lg font-bold">{{ $area->area_name }}</h1>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-span-6 bg-white h-[20vw] p-4 rounded-3xl">
            <h2 class="w-full text-center font-bold text-xl border-b-2 border-b-black p-2 mb-2">Mesas disponibles:</h2>
            @if ($mesas)
                <div class="grid grid-cols-2 gap-2 p-2 overflow-y-scroll h-[16vw] ">
                    @foreach ($mesas as $mesa)
                        <div wire:click="showDataTable"
                            class=" flex gap-2 hover:opacity-80 hover:cursor-pointer text-white bg-blue-900 h-28 rounded-3xl">
                            <div class="flex items-center justify-center h-full w-36">
                                <div class="flex flex-col w-full h-full ">
                                    @if ($mesa->table_url)
                                        @php
                                            $options = unserialize($mesa->table_url);
                                            $firstOption = reset($options);
                                        @endphp
                                        <img class="bg-gray-700 rounded-t-3xl object-cover"
                                            src="{{ asset($firstOption) }}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="bg-gray-700 rounded-t-3xl stroke-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    @endif
                                    <div class="px-4 text-center bg-gray-800 rounded-b-3xl font-bold">
                                        {{ $mesa->areas->area_name }}
                                    </div>
                                </div>
                            </div>
                            <div class="w-2/3 rounded-3xl px-5 py-2 overflow-hidden">
                                <div class="font-bold text-xl border-b-white border-b">Mesa {{ $mesa->table_number }}
                                    del area</div>
                                <div>{{ $mesa->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center w-full h-full ">
                    <h1>Sin resultados.</h1>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('click', () => {
            handleCheckboxSelection(checkbox);
        });
    });

    function handleCheckboxSelection(checkbox) {
        checkboxes.forEach((cb) => {
            if (cb !== checkbox) {
                cb.checked = false;
            }
        });
    }
</script>
