import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/profile.js',
                'resources/js/password-reset.js',
            ],
            refresh: true,
        }),
    ],
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
