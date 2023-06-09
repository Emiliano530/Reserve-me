<x-app-layout>
    <x-slot name="slot">
        <div class="pt-16 flex items-center justify-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-indigo-900 overflow-hidden shadow-md rounded-3xl p-5">
                    @livewire('welcome')
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
