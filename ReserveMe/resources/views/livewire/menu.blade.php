<div
    class="relative flex mt-16 flex-col justify-center overflow-hidden transition-opacity items-center mx-auto top-0 text-white bg-indigo-900 p-5 rounded-3xl">
    @if ($selectedCategory)
        <a href="/menu"
            class="absolute group flex justify-center items-center top-5 left-5 hover:bg-emerald-500 bg-emerald-600 w-10 h-10 p-1 shadow-xl rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div class="flex justify-center items-center text-3xl mb-20">
            <button
                class="flex items-center justify-center mx-2 p-5 bg-black/30 hover:bg-gray-600/30 rounded-full h-10 w-10"
                wire:click="selectPreviousCategory">&lt;</button>
            <h1>{{ $selectedCategory->category_name }}</h1>
            <button
                class="flex items-center justify-center mx-2 p-5 bg-black/30 hover:bg-gray-600/30 rounded-full h-10 w-10"
                wire:click="selectNextCategory">&gt;</button>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-12 min-w-[90vw] min-h-[19vw]">
            @foreach ($options as $option)
                @if ($option->id_category == $selectedCategory->id)
                    <div
                        class="relative flex flex-col items-center hover:rotate-1 cursor-pointer justify-center w-60 min-h-60 rounded-3xl">
                        @if ($option->optionImage_url)
                            <img class="w-full h-64 rounded-3xl object-cover"
                                src="{{ $option->option_image }}"
                                alt="Option Image" />
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-full h-64 bg-slate-400 rounded-3xl">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        @endif
                        <div class="absolute rounded-3xl inset-0 bg-black opacity-40"></div>
                        <div class="absolute font-tiza w-44 h-44 text-3xl p-5 mt-2 flex justify-center items-center text-center overflow-hidden">
                            <span class="rounded-3xl bg-black/60 p-3">{{ $option->option_name }}</span>
                        </div>                        
            
                        <div class="absolute flex justify-center h-28 w-28 items-center px-5 py-auto text-center text-lg font-bold -top-10 -right-10 bg-center bg-cover text-black"
     style="background-image: url('{{ asset('img/price.svg') }}');">
    ${{ $option->price }}
</div>

                        
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <h1 class="text-6xl">MENÚ</h1>
        <h2 class="text-xl">Selecciona una categoría</h2>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 grid-flow-row gap-2 mt-5">
            @foreach ($categories as $key => $category)
                <div wire:click="selectCategory({{ $category->id }})"
                    class="relative flex items-center bg-slate-600 justify-center hover:rotate-1 cursor-pointer p-5 rounded-3xl flex-grow
                @if (count($categories) == 5)
                {{ $key % 5 === 0 ? 'row-span-6 min-h-[20vw] min-w-[10vw]' : '' }}
                {{ $key % 5 === 1 ? 'col-span-3 row-span-3' : '' }}
                {{ $key % 5 === 2 ? 'col-span-1 row-span-3' : '' }}
                {{ $key % 5 === 3 ? 'col-span-1 row-span-3' : '' }}
                {{ $key % 5 === 4 ? 'row-span-3 col-span-3' : '' }}"
                @endif
                    style="background-image: url('{{$category->categoryPhoto_url }}');
                        background-position: center;
                        background-size: cover;">
                    <div class="absolute rounded-3xl inset-0 bg-black opacity-40"></div>
                    <span class="flex items-center justify-center relative z-10 text-5xl font-tiza rounded-3xl bg-black/60 p-3">{{ $category->category_name }}</span>
                </div>
            @endforeach
        </div>
    @endif
</div>
