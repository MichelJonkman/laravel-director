<template>
    <div :class="{closed: false}" class="sidebar">
        <Nav :menu="menu"/>
    </div>
</template>

<script lang="ts" setup>
import Nav from "./Sidebar/Nav/Nav.vue";
import {usePage} from '@inertiajs/vue3';
import {MenuInterface} from "~/js/Interfaces/Menu/MenuInterface";
import {reactive, ref} from "vue";

let pageProps = usePage().props ?? {menu: {}};
let menu: MenuInterface = pageProps.menu as MenuInterface;

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

    .nav {
        width: $layout-sidebar-width;
    }

    &.closed {
        width: 0;
    }
}
</style>
