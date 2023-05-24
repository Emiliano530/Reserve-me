@props(['disabled' => false])

<div class="relative">
    <div class="absolute inset-y-0 left-0 px-3 text-center shadow bg-gray-200 flex justify-center items-center pointer-events-none rounded-l-3xl">
        {{ $slot }}
    </div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-none pl-14 border-gray-300 border-gray-700 text-black focus:border-indigo-600 focus:ring-indigo-600 rounded-3xl shadow-sm']) !!}>
</div>