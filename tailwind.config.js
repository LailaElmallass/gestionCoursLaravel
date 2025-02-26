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
          colors: {
            'light-blue': '#60A5FA', // Bleu clair principal
            'light-blue-dark': '#3B82F6', // Bleu clair sombre (hover)
            'light-gray': '#F3F4F6', // Gris clair pour fonds
            'soft-gray': '#D1D5DB', // Gris doux pour bordures
            'light-green': '#A7F3D0', // Vert clair pour succès
            'light-red': '#FEE2E2', // Rouge clair pour erreurs
            'light-text': '#374151', // Texte gris foncé doux
            'blue-dark' : '#1c0fa5' // zr9 mghlo9
          },
        },
      },

    plugins: [forms],
};
