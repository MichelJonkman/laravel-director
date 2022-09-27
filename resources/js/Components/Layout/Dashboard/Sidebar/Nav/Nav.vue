<template>
    <ul class="nav nav-pills flex-column mb-auto">
        <NavItem v-for="(button, name) in menu" :button="button" :key="name"/>
    </ul>
</template>

<script lang="ts" setup>
import NavItem from "./NavItem.vue";
import {MenuInterface} from "~/js/Interfaces/MenuInterface.js";

defineProps<{
    menu: MenuInterface
}>();

</script>

<style lang="scss" scoped>

</style>
