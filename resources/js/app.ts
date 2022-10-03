import {createApp, DefineComponent, h} from 'vue';
import {createInertiaApp, Link, Head} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import '@micheljonkman/laravel-director/scss/app.scss';
import Dashboard from "~/js/Layouts/Dashboard.vue";


createInertiaApp({
    // @ts-ignore
    resolve: async (name) => {
        // @ts-ignore
        const page = (await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))).default;
        page.layout = page.layout || Dashboard;
        return page;
    },
    setup({el, app, props, plugin}) {
        createApp({render: () => h(app, props)})
            .use(plugin)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            ?.mount(el)
    },
});

InertiaProgress.init();
