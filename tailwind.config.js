import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import colors from 'tailwindcss/colors';

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
            colors: {
                // ✅ Brand color — Mocha Brown #775042
                primary: {
                    50:  '#f5eeeb',
                    100: '#e8d5cc',
                    200: '#d4b8ae',
                    300: '#bf9a8f',
                    400: '#a07060',
                    500: '#8a5f50',
                    600: '#775042', // ← main brand
                    700: '#5e3d31',
                    800: '#472e25',
                    900: '#301f19',
                    950: '#1a100d',
                },
                danger:  colors.rose,
                success: colors.emerald,
                // ✅ Warning — amber (aapki CSS se match)
                warning: colors.amber,
                info:    colors.sky,
            },
        },
    },

    plugins: [
        forms,
        typography,
    ],
};