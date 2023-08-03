<template>
    <div class="sidebar d-flex flex-column flex-shrink-0 text-white bg-dark" style="width: 280px;">
        <div class="sidebar-brand">
            <a href="/admin/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Director</span>
            </a>
        </div>
        <Nav :menu="menu"/>
    </div>
</template>

<script lang="ts" setup>
import Nav from "./Sidebar/Nav/Nav.vue";
import {usePage} from '@inertiajs/vue3';
import {MenuInterface} from "~/js/Interfaces/Menu/MenuInterface";

let pageProps = usePage().props ?? {menu: {}};
let menu: MenuInterface = pageProps.menu as MenuInterface;
</script>

<style lang="scss" scoped>
.sidebar {
    $topbar-height: 4rem;

    height:         100%;

    .sidebar-brand {
        background: $dark-blue-900;
        height:     $topbar-height;
        display: flex;
        justify-content: center;
        padding: 1rem;
    }
}
</style>
