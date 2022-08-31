import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import basicSsl from '@vitejs/plugin-basic-ssl';

/** @type {import('vite').UserConfig} */
export default defineConfig(({ command, mode, ssrBuild }) => {
    const env = loadEnv(mode, process.cwd());

    const extraPlugins = [];

    if(env.VITE_HTTPS === 'true') {
        extraPlugins.push(basicSsl());
    }

    let publicDirectory = './';

    if(command === 'serve' && env.VITE_PROJECT_PUBLIC_DIRECTORY) {
        publicDirectory = env.VITE_PROJECT_PUBLIC_DIRECTORY;
    }

    return {
        plugins: [
            vue(),
            laravel({
                hotFile: publicDirectory + '/director.hot',
                input: ['resources/js/app.ts'],
                refresh: true,
                publicDirectory: publicDirectory,
                buildDirectory: 'build2'
            }),
            ...extraPlugins
        ],
        build: {
            rollupOptions: {
            }
        }
    };
});
