<template>
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="/admin/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Director</span>
        </a>
        <hr>
        <Nav :settings="settings"/>
    </div>
</template>

<script lang="ts" setup>
import Nav from "./Nav/Nav.vue";
import {usePage} from '@inertiajs/vue3';
import {SettingsInterface} from "~/js/Interfaces/Settings/SettingsInterface";

let pageProps = usePage().props ?? {settings: {}};
let settings: SettingsInterface = pageProps.settings as SettingsInterface;
</script>

<style lang="scss" scoped>
.sidebar {
    height: 100%;
}
</style>
