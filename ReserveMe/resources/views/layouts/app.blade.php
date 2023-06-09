<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ReserveMe</title>
    <link rel="icon" type="image/png" href="{{ asset('img/reserveme.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body
    class="no-horizontal-scroll font-inria antialiased flex flex-col justify-between min-h-screen bg-indigo-950 bg-repeat z-10 scrollbar-w-0"
    style="background-image: url('{{ asset('img/pattern.svg') }}');">
    @livewire('navbar')
    @livewire('fast-booking')
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif


    <!-- Page Content -->
    <main class="py-16 flex-grow flex justify-center items-center">
        {{ $slot }}
    </main>
    <x-footer />
    @stack('modals')
    @livewireScripts
</body>
<style>
    .no-horizontal-scroll {
        overflow-x: hidden;
        /* Oculta la barra de desplazamiento horizontal */
    }
</style>

</html>
