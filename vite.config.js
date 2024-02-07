import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/js/product-ad.js',
                'resources/js/product-edit.js'
            ],
            refresh: true,
        }),
    ],

    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
