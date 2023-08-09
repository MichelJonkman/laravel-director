<template>
    <div class="layout-dashboard">
        <Topbar/>
        <div class="flex-grow-1 row g-0 position-relative">
            <Sidebar/>
            <div class="col">
                <div class="content">
                    <slot></slot>
                </div>
            </div>
        </div>
        <Toasts/>
    </div>
</template>

<script lang="ts" setup>
import Sidebar from "../Components/Layout/Dashboard/Sidebar.vue";
import Toasts from "~/js/Components/General/Toasts.vue";
import Topbar from "~/js/Components/Layout/Dashboard/Topbar.vue";
</script>

<style lang="scss" scoped>
.layout-dashboard {
    height: 100vh;
    display: flex;
    flex-direction: column;

    .content {
        height: 100%;
    }
}
</style>
