import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/favourites.css',
                'resources/css/main.css',
                'resources/css/mistake.css',
                'resources/css/musicGroup.css',
                'resources/css/musicGroupMain.css',
                'resources/css/style.css',
                'resources/css/survey.css',
                'resources/css/tool.css',
                'resources/css/toolsMain.css',
                'resources/css/typesTools.css',
                'resources/css/feedback.css',
                'resources/js/feedback.js',
                'resources/js/favorites.js',
                'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
