import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                    'resources/js/app.js',
                    'resources/js/preboarding_table.js',
                    'resources/js/user.js'],
            refresh: true,
        }),
        vue(),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
    },
});
