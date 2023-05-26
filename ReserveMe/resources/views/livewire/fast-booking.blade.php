<div x-cloak x-data="{ open: false }" class="fixed bottom-0 right-5 text-cyan-50 z-50">
    <div :class="{ 'h-[17.25vw]': open, 'h-12': !open }" class="p-2 bg-red-700 overflow-hidden transition-all duration-300">
        <div @click="open = !open"
            class="flex gap-2 cursor-pointer justify-center p-5 h-10 items-center bg-emerald-600 rounded-t-3xl flex-shrink-0 border border-black">
            <div class="text-xl whitespace-nowrap">Haz una reservación</div>
            <svg class="h-6 w-6 stroke-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </div>
        <div class="flex gap-2 cursor-pointer justify-center p-5 h-10 items-center bg-emerald-600 rounded-b-3xl flex-shrink-0 border border-t-0 border-black">
            ff
        </div>
    </div>
</div>
