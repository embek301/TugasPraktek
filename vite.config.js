import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/home.css',
                'resources/css/nav.css',
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/js/master/user/create.js',
            ],
            refresh: true,
        }),
    ],
});
