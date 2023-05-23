import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                inria: ['Inria Serif', 'sans-serif'],
            },
            colors: {
                color_1: '#000000',
                color_2: '#122640',
                color_3: '#022A60',
                color_4: '#023E73',
                color_5: '#475954',
                color_6: '#69554C',
                color_7: '#895A44',
                color_8: '#DAC9B4',
                color_9: '#FFFFFF',
              },
        },
    },

    plugins: [forms, typography],
};
