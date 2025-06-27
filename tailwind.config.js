import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'light': '#edf2f9',
                'dark': '#1e3a8a',
                'darkodd': '#1e3a8a',
                'darker': '#172554',
                'primary': '#1d4ed8',
                'primary-dark': '#1e40af',
                'secondary': '#f59e0b',
                'secondary-dark': '#d97706',
            },
        },
    },

    plugins: [forms],
};
