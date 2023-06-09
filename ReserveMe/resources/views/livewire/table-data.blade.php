<div x-cloak x-data="{ zoom: false }" class="mt-16 p-5 bg-indigo-900 rounded-3xl mx-1 w-[65vw] text-white">
    <div class="grid grid-cols-6 gap-5 p-10">
        <div class="flex flex-col items-center col-span-4 rounded-3xl overflow-hidden shadow-2xl">
            <div class="w-full border-2 border-white rounded-t-3xl text-center bg-yellow-900 p-4 text-xl font-bold">
                Detalles
            </div>
            <div
                class="flex flex-col items-center justify-center w-full bg-emerald-600 p-4 min-h-[20vw] border-2 border-white rounded-b-3xl">
                <div class="text-xl text-center border-b border-white px-10 py-1">Mesa numero {{ $mesa->table_number }}
                    del area {{ $mesa->areas->area_name }}</div>
                <div class="text-center text-lg py-4 px-5">{{ $mesa->description }}</div>
                @if ($mesa->table_url)
                    <div
                        class="{{ $cuadricula ? 'grid grid-cols-2 w-96 relative' : ' grid grid-cols-3' }} bg-indigo-900 rounded-3xl overflow-hidden justify-center items-center image-container">
                        @foreach ($mesa->table_url as $index => $image)
                            @if ($index < 4 || $mostrarImagenes)
                                <img @click="zoom = true"
                                    wire:click="zoomImage({{ $mesa->id }}, '{{ $image }}')"
                                    class="{{ $cuadricula ? 'w-full' : 'w-44' }} bg-gray-700 h-44 cursor-zoom-in hover:opacity-80 rounded-sm object-cover"
                                    src="{{ asset($image) }}">
                            @endif
                        @endforeach
                        @if (count($mesa->table_url) > 4 && !$mostrarImagenes)
                            <button wire:click="mostrarMasImagenes"
                                class="absolute bottom-0 right-0 w-28 h-44 flex justify-center items-center text-2xl text-white bg-gray-800/60 font-bold">+{{ count($mesa->table_url) - 4 }}</button>
                        @endif
                    </div>
                @endif

                <div :class="{ 'imagenZoom': zoom, 'hidden': !zoom }" @click="zoom = false" wire:click="clearZoom"
                    class="overlay mostrar overflow-hidden fixed inset-0 z-40 flex flex-col justify-center items-center bg-black/80">
                    <div wire:loading class="flex items-center justify-center p-5">
                        <div class="flex space-x-2 animate-pulse">
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-indigo-600 rounded-full"></div>
                        </div>
                    </div>
                    @if ($imagenSeleccionada)
                        <img wire:loading.remove class="w-96 rounded-3xl scale-150"
                            src="{{ asset($imagenSeleccionada) }}">
                    @endif
                </div>

            </div>
        </div>
        <div
            class="flex flex-col h-44 border-2 border-white text-xl p-5 items-center col-span-2 bg-emerald-600 rounded-3xl overflow-hidden">
            <div class="pt-5 px-10 mb-5 border-b border-white font-bold">
                Datos de la reserva
            </div>
            <div class="shadow-2xl p-1">
                Mesa:
                <strong>{{ $mesa->table_number }}</strong>
            </div>
            <div class="shadow-2xl p-1">
                Personas:
                <strong>{{ $mesa->guestNumber }}</strong>
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
            const isOpen = overlay.classList.contains('imagenZoom');

            // Agregar o eliminar la clase 'overlay-active' en el body según el estado del overlay
            document.body.classList.toggle('overlay-active', isOpen);
        });

        // Observar cambios en los atributos del overlay
        observer.observe(overlay, {
            attributes: true
        });
    });
</script>
