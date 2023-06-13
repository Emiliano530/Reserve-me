@props(['disabled' => false, 'maxlength' => null])

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'text-sm font-bold text-center border-gray-300 dark:border-gray-700 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-3xl shadow-sm', 'maxlength' => $maxlength]) }}>
