<div class="w-full h-full top-0 text-white" x-cloak x-data="{ selectedCategory: null }">
    @foreach ($categories as $category)
        <h3 class="text-2xl text-center mx-10 p-5 my-10 bg-black rounded-3xl cursor-pointer"
            @click="selectedCategory = selectedCategory === '{{ $category->id }}' ? null : '{{ $category->id }}'">
            {{ $category->category_name }}</h3>
        <div id="category_{{ $category->id }}" x-show="selectedCategory === '{{ $category->id }}'"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="flex flex-wrap w-full gap-4 justify-center items-center p-10">
            @foreach ($options as $option)
                @if ($option->id_category == $category->id)
                    <div class="relative rounded-3xl hover:rotate-1 flex my-2 h-60">
                        <div class="w-44 h-full bg-blue-950  rounded-l-3xl">
                            @if ($option->option_image)
                                <img class="w-full h-full rounded-l-3xl object-cover"
                                    src="data:image/jpeg;base64,{{ base64_encode($option->option_image) }}"
                                    alt="Option Image" />
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-full h-full rounded-l-3xl">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            @endif
                        </div>
                        <div class="p-5 pt-10 w-80 bg-indigo-900 rounded-r-3xl text-center">
                            <div class="text-2xl pb-2">{{ $option->option_name }}</div>
                            <div class="overflow-hidden break-words h-24">{{ $option->description }}</div>
                        </div>
                        <div
                            class="absolute flex justify-center items-center text-center shadow-xl -top-4 right-8 rounded-full p-2 px-4
    {{ $option->shift == 'Dia' ? 'bg-yellow-300 text-black' : ($option->shift == 'Noche' ? 'bg-gray-900' : 'bg-blue-500') }}">
                            {{ $option->shift }}
                        </div>

                        <div
                            class="absolute flex justify-center items-center text-center bottom-0 right-0 bg-black rounded-br-3xl p-2 px-4">
                            ${{ $option->price }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
