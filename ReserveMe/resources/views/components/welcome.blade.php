<div x-cloak x-data="{ slide: 1 }" class="carousel relative flex">
    <!-- Contenido de las cards -->
    <!-- Card -->
    <div :class="{ '': slide === 1, 'hidden': slide !== 1 }"
        class="card min-h-1/2 flex items-center text-center justify-center p-10 gap-20">
        <div class="text-center text-white w-1/2  m-5">
            <div class="text-6xl font-bold italic mb-5">DAJOHU</div>
            <p>Cafeteria DAJOHU es un lugar acogedor donde el aroma del café se mezcla con un ambiente encantador.
                Nuestros
                baristas expertos preparan con esmero cada taza, ofreciendo una amplia variedad de opciones. Ven y
                disfruta
                de momentos especiales en un espacio dedicado al arte del café.</p>
        </div>
        <div class="flex justify-center items-center w-1/2 h-full p-5 m-5">
            <img class="h-full w-full rounded-3xl" src="{{ asset('img/cafeteria.jpg') }}" alt="">
        </div>
    </div>
    <!-- Card -->
    <div :class="{ '': slide === 2, 'hidden': slide !== 2 }"
        class="card min-h-1/2 bg-red-500 flex items-center text-center justify-center p-10 gap-20">
        <div class="flex justify-center items-center w-1/2 h-full p-5 m-5">
            <img class="h-full w-full rounded-3xl" src="{{ asset('img/cafeteria.jpg') }}" alt="">
        </div>
        <div class="text-center text-white w-1/2  m-5">
            <div class="text-6xl font-bold italic mb-5">DAJOHU</div>
            <p>Cafeteria DAJOHU es un lugar acogedor donde el aroma del café se mezcla con un ambiente encantador.
                Nuestros
                baristas expertos preparan con esmero cada taza, ofreciendo una amplia variedad de opciones. Ven y
                disfruta
                de momentos especiales en un espacio dedicado al arte del café.</p>
        </div>
    </div>
    <!-- Card -->
    <div :class="{ '': slide === 3, 'hidden': slide !== 3 }"
        class="card min-h-1/2 bg-black flex items-center text-center justify-center p-10 gap-20">
        <div class="text-center text-white w-1/2  m-5">
            <div class="text-6xl font-bold italic mb-5">DAJOHU</div>
            <p>Cafeteria DAJOHU es un lugar acogedor donde el aroma del café se mezcla con un ambiente encantador.
                Nuestros
                baristas expertos preparan con esmero cada taza, ofreciendo una amplia variedad de opciones. Ven y
                disfruta
                de momentos especiales en un espacio dedicado al arte del café.</p>
        </div>
        <div class="flex justify-center items-center w-1/2 h-full p-5 m-5">
            <img class="h-full w-full rounded-3xl" src="{{ asset('img/cafeteria.jpg') }}" alt="">
        </div>
    </div>
    <div class="absolute z-30 flex items-center justify-center space-x-3 -translate-x-1/2 bottom-5 left-1/2">
        <button type="button" class="rounded-full" :class="{ 'bg-blue-600 w-4 h-4': slide === 1, 'bg-blue-300 w-3 h-3': slide != 1 }" @click="slide=1"></button>
        <button type="button" class="rounded-full" :class="{ 'bg-blue-600 w-4 h-4': slide === 2, 'bg-blue-300 w-3 h-3': slide != 2 }" @click="slide=2"></button>
        <button type="button" class="rounded-full" :class="{ 'bg-blue-600 w-4 h-4': slide === 3, 'bg-blue-300 w-3 h-3': slide != 3 }" @click="slide=3"></button>
    </div>
    <!-- Slider controls -->
    <div @click="slide = slide > 1 ? slide - 1 : 3"
        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-2 focus:outline-none">
        <span
            class="inline-flex items-center justify-center cursor-pointer w-8 h-8 rounded-full sm:w-10 sm:h-10 hover:bg-blue-800/60 focus:ring-4 focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 sm:w-6 sm:h-6 text-gray-800" fill="none" stroke="white"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </div>
    <div @click="slide = slide < 3 ? slide + 1 : 1"
        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-2 focus:outline-none">
        <span
            class="inline-flex items-center justify-center cursor-pointer w-8 h-8 rounded-full sm:w-10 sm:h-10 hover:bg-blue-800/60 focus:ring-4 focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 sm:w-6 sm:h-6 text-gray-800" fill="none" stroke="white"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </div>
</div>
