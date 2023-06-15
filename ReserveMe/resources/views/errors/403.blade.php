@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="flex items-center justify-center h-screen w-screen bg-indigo-950 bg-repeat"
    style="background-image: url('{{ asset('img/pattern.svg') }}');">
    <div class="flex flex-col items-center justify-center bg-indigo-900 p-5 rounded-3xl shadow-2xl">
        <p class="text-6xl md:text-7xl lg:text-9xl font-bold tracking-wider text-white">403</p>
        <p class="text-2xl md:text-3xl lg:text-5xl font-bold tracking-wider text-white mt-4">No puedes acceder.</p>
        <p class="text-white mt-8 py-2 border-b-2 text-center">Lo sentimos, no puedes acceder a esta página si no eres
            administrador.</p>
        <a href="/" class="flex items-center font-medium pt-5 text-green-600 hover:text-green-500">
            <div class="underline px-2">Volver al inicio.</div>
            <svg id="return-back-redo-arrow" version="1.1" class="w-5 h-5" fill="currentColor"
                viewBox="0 0 15.207 10.854" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.707,0h-4v1h4c1.378,0,2.5,1.122,2.5,2.5S13.085,6,11.707,6H1.914l3.146-3.146L4.354,2.146L0,6.5l4.354,4.354  l0.707-0.707L1.914,7h9.793c1.93,0,3.5-1.57,3.5-3.5S13.637,0,11.707,0z" />
            </svg>
        </a>
    </div>
</div>
