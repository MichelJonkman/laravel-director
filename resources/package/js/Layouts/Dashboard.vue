<template>
    <div class="layout-dashboard">
        <div class="row h-100 g-0">
            <Sidebar/>
            <div class="col">
                <div class="content">
                    <Topbar/>
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
}
</style>
