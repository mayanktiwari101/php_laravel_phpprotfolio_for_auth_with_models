import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({

    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true
        }),
    ],
});
