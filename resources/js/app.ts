import {createApp, DefineComponent, h} from 'vue';
import {createInertiaApp, Link, Head} from '@inertiajs/vue3';
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
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            ?.mount(el)
    },
});
