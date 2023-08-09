<template>
    <div :class="{closed: settingsSidebarClosed}" class="sidebar">
        <Nav :settings="settings"/>
    </div>
</template>

<script lang="ts" setup>
import Nav from "./Nav/Nav.vue";
import {usePage} from '@inertiajs/vue3';
import {SettingsInterface} from "~/js/Interfaces/Settings/SettingsInterface";
import {useSidebarStore} from "~/js/Stores/SidebarStore";
import {storeToRefs} from "pinia";

let pageProps = usePage().props ?? {settings: {}};
let settings: SettingsInterface = pageProps.settings as SettingsInterface;

const sidebarStore = useSidebarStore();
const {settingsSidebarClosed} = storeToRefs(sidebarStore);
</script>

<style lang="scss" scoped>
.sidebar {
    display:        flex;
    overflow:       hidden;
    flex-direction: column;
    flex-shrink:    0;
    width:          $layout-sidebar-width;
    height:         100%;
    transition:     width ease-in-out .25s;
    background:     $dark;
    position:       absolute;

    .nav {
        width: $layout-sidebar-width;
    }

    &.closed {
        width: 0;
    }

    @include media-breakpoint-up(xxl) {
        position: relative;
    }
}
</style>
