<template>
    <div class="layout-dashboard">
        <div class="row h-100 g-0">
            <Sidebar/>
            <div class="col content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Sidebar from "../Components/Layout/Dashboard/Sidebar.vue";
</script>

<style lang="scss" scoped>
.layout-dashboard {
    height: 100vh;
}
</style>
