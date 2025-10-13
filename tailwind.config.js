import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                color1: '#00feb8',  // Verde azulado brillante
                color2: '#9eff7d',  // Verde claro
                color3: '#002216',  // Verde muy oscuro
                color4: '#727976',  // Gris verdoso
                color5: '#e2e2e2',  // Gris claro
                // Mantener nombres semánticos para facilidad de uso
                primary: '#002216',    // color3
                secondary: '#00feb8',  // color1
                accent: '#9eff7d',     // color2
                neutral: '#727976',    // color4
                light: '#e2e2e2',      // color5
            },
        },
    },

    plugins: [forms],
};
