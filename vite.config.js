import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/home.css',
                'resources/js/multiselect-dropdown.js',
                'resources/js/main.js'
            ],
            refresh: true,
        }),
    ],
});
