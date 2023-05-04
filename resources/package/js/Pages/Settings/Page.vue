<template>
    <div>
        <Suspense>
            <SettingsItem v-for="(element, name) in currentPage.children" :element="element" :key="name"/>
        </Suspense>
    </div>
</template>

<script lang="ts" setup>
import {usePage} from "@inertiajs/vue3";
import {SettingsInterface} from "~/js/Interfaces/Settings/SettingsInterface";
import {defineOptions} from "unplugin-vue-define-options/macros";
import Settings from "~/js/Layouts/Settings.vue";
import Dashboard from "~/js/Layouts/Dashboard.vue";
import route from "ziggy-js";
import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";
import {PageElementInterface} from "~/js/Interfaces/Settings/Elements/PageElementInterface";
import SettingsItem from "~/js/Components/Settings/SettingsItem.vue";

defineOptions({layout: [Dashboard, Settings]});

let pageProps = usePage().props ?? {settings: {}};
let settings: SettingsInterface = pageProps.settings as SettingsInterface;
let params = <{ slug: string }>route().params;

let slug = params.slug ? params.slug : 'index';

let pages = <{ [slug: string]: PageElementInterface }>{};
for (const element of Object.values<ElementInterface>(settings.children)) {
    if (element.hasOwnProperty('isPage') && (<PageElementInterface>element).isPage) {
        pages[(<PageElementInterface>element).slug] = <PageElementInterface>element;
    }
}

let currentPage = <PageElementInterface>pages[slug];
console.log(settings);

</script>

<style lang="scss" scoped>

</style>
