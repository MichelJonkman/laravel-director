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

const {settings} = defineProps<{
    settings: SettingsInterface
}>();

Director.registerComponents(import.meta.glob('./Buttons/**/*.vue'));

settings.elements = {};
for (const [name, element] of Object.entries(settings.children)) {
    settings.elements[name] = element;
}

</script>

<style lang="scss" scoped>

</style>
