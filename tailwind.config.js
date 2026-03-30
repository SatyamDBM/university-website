import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './app/Filament/**/*.php',
        './app/Livewire/**/*.php',

        './resources/views/**/*.blade.php',
        './resources/views/cms/**/*.blade.php',
        './resources/views/filament/**/*.blade.php',

        './resources/js/**/*.js',
        './resources/**/*.vue',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        typography,
    ],
};