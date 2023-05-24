<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-indigo-950 bg-repeat"
    style="background-image: url('{{ asset('img/login_bg.svg') }}');">


    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-indigo-900 shadow-md overflow-hidden sm:rounded-3xl">
        <div class="flex items-center justify-center">
            @isset($logo)
                {{ $logo }}
            @endisset
        </div>
        <div class="flex justify-center items-center text-center first-letter:uppercase text-2xl border-b-4 border-black pt-4">
            @isset($titulo)
                {{ $titulo }}
            @endisset
        </div>
        <div class="flex justify-center items-center text-center first-letter:uppercase text-xs pt-1 pb-5">
            @isset($subtitulo)
                {{ $subtitulo }}
            @endisset
        </div>
        {{ $slot }}
    </div>
</div>
