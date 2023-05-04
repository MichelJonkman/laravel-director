<template>
    <ul class="nav nav-pills flex-column mb-auto">
        <Suspense>
            <NavItem v-for="(element, name) in settings.children" :element="element" :key="name"/>
        </Suspense>
    </ul>
</template>

<script lang="ts" setup>
import NavItem from "./NavItem.vue";
import {SettingsInterface} from "~/js/Interfaces/Settings/SettingsInterface";
import {Director} from "~/js/director";
import {router} from "@inertiajs/vue3";
import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";
import {PageElementInterface} from "~/js/Interfaces/Settings/Elements/PageElementInterface";
import route from "ziggy-js";

const {settings} = defineProps<{
    settings: SettingsInterface
}>();

Director.registerComponents(import.meta.glob('./Buttons/**/*.vue'));

settings.elements = {};
for (const [name, element] of Object.entries(settings.children)) {
    settings.elements[name] = element;
}

const pages: PageElementInterface[] = [];

for (const element of Object.values<ElementInterface>(settings.elements)) {
    if (element.hasOwnProperty('isPage') && (<PageElementInterface>element).isPage) {
        pages.push(<PageElementInterface>element);
    }
}

router.on('navigate', () => {
    const params = <{ slug: string }>route().params;

    for (const element of pages) {
        const slug = element.slug === 'index' || !element.slug ? undefined : element.slug

        if (slug === params.slug) {
            element.active = true;

            continue;
        }
        element.active = false;
    }
});

</script>

<style lang="scss" scoped>

</style>
