const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

// Compile the app.css (which includes Tailwind) to the public/css folder
mix.css('resources/css/app.css', 'public/css')
    .postCss('resources/css/app.css', 'public/css/app.css', [
        tailwindcss('tailwind.config.js'),
    ]);
