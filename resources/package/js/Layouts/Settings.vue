<template>
    <div class="layout-settings">
        <div class="row h-100 g-0">
            <Sidebar/>
            <div class="col content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Sidebar from "../Components/Settings/Sidebar.vue";
</script>

<style lang="scss" scoped>
.layout-settings {
    height: 100%;
}
</style>
