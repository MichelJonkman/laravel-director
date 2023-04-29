<template>
    <div>
        Overview

        <ul>
            <Suspense>
                <SettingsItem v-for="(element, name) in settings.children" :element="element" :key="name"/>
            </Suspense>
        </ul>
    </div>
</template>

<script lang="ts" setup>
import {usePage} from "@inertiajs/vue3";
import {SettingsInterface} from "~/js/Interfaces/Settings/SettingsInterface";
import SettingsItem from "../../Components/Settings/SettingsItem.vue";

let pageProps = usePage().props ?? {settings: {}};
let settings: SettingsInterface = pageProps.settings as SettingsInterface;

</script>

<style lang="scss" scoped>

</style>
