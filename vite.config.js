import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/common.css',
                'resources/css/home/home.css',
                'resources/css/header/header.css',
                'resources/css/footer/footer.css',
                'resources/css/auth/auth.css',
                'resources/css/community/community.css',
                'resources/css/books/index.css',
                'resources/css/books/current-book.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
