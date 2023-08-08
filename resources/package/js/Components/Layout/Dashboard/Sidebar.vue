<template>
    <div :class="{closed: sidebarClosed}" class="sidebar">
        <Nav :menu="menu"/>
    </div>
</template>

<script lang="ts" setup>
import Nav from "./Sidebar/Nav/Nav.vue";
import {usePage} from '@inertiajs/vue3';
import {MenuInterface} from "~/js/Interfaces/Menu/MenuInterface";
import {reactive, ref} from "vue";
import {useSidebarStore} from "~/js/Stores/SidebarStore";
import {storeToRefs} from "pinia";

let pageProps = usePage().props ?? {menu: {}};
let menu: MenuInterface = pageProps.menu as MenuInterface;

const sidebarStore = useSidebarStore();
const {sidebarClosed} = storeToRefs(sidebarStore);

</script>

<style lang="scss" scoped>
.sidebar {
    display: flex;
    overflow: hidden;
    flex-direction: column;
    flex-shrink: 0;
    width: $layout-sidebar-width;
    height: 100%;
    transition: width ease-in-out .25s;
    background: $dark;
    position: absolute;

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
