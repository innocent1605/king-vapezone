import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                'paper': '#F4F4F2',
                'charcoal': '#1C1C1C',
                'lime-accent': '#D4FF00',
                'pitch': '#111111',
                'graphite': '#4A4A4A',
            },
            fontFamily: {
                'display': ['"Bebas Neue"', ...defaultTheme.fontFamily.sans],
                'body': ['"Inter"', ...defaultTheme.fontFamily.sans],
                'serif-accent': ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
            },
            animation: {
                'brutal-bounce': 'brutal-bounce 0.4s ease-in-out',
                'brutal-shake': 'brutal-shake 0.5s ease-in-out',
                'brutal-slide-up': 'brutal-slide-up 0.3s ease-out',
                'brutal-slide-down': 'brutal-slide-down 0.3s ease-out',
                'brutal-fade-in': 'brutal-fade-in 0.3s ease-out',
                'brutal-pulse': 'brutal-pulse 2s infinite',
            },
            keyframes: {
                'brutal-bounce': {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-8px)' },
                },
                'brutal-shake': {
                    '0%, 100%': { transform: 'translateX(0)' },
                    '25%': { transform: 'translateX(-4px) rotate(-1deg)' },
                    '75%': { transform: 'translateX(4px) rotate(1deg)' },
                },
                'brutal-slide-up': {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                'brutal-slide-down': {
                    '0%': { transform: 'translateY(-20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                'brutal-fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                'brutal-pulse': {
                    '0%, 100%': { boxShadow: '4px 4px 0px 0px #D4FF00' },
                    '50%': { boxShadow: '6px 6px 0px 0px #D4FF00' },
                },
            },
            boxShadow: {
                'brutal': '4px 4px 0px 0px #000000',
                'brutal-sm': '2px 2px 0px 0px #000000',
                'brutal-lg': '6px 6px 0px 0px #000000',
                'brutal-lime': '4px 4px 0px 0px #D4FF00',
                'brutal-white': '4px 4px 0px 0px #F4F4F2',
            },
        },
    },

    plugins: [forms, typography],
};
