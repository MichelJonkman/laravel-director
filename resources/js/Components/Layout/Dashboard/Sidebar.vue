<template>
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="/admin/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Director</span>
        </a>
        <hr>
        <Nav :menu="menu"/>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Nav from "./Sidebar/Nav/Nav.vue";
import {usePage} from '@inertiajs/inertia-vue3';
import {MenuInterface} from "~/js/Interfaces/MenuInterface.js";

let pageProps = usePage().props.value;
let menu: MenuInterface = pageProps.menu as MenuInterface;
</script>

<style lang="scss" scoped>
.sidebar {
    height: 100%;
}
</style>
