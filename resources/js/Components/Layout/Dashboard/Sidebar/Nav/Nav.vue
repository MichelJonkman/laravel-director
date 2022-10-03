<template>
    <ul class="nav nav-pills flex-column mb-auto">
        <Suspense>
            <NavItem v-for="(element, name) in menu" :element="element" :key="name"/>
        </Suspense>
    </ul>
</template>

<script lang="ts" setup>
import NavItem from "./NavItem.vue";
import {MenuInterface} from "~/js/Interfaces/Menu/MenuInterface";

defineProps<{
    menu: MenuInterface
}>();

</script>

<style lang="scss" scoped>

</style>
