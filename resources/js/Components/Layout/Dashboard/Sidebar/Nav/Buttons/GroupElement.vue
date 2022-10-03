<template>
    <ul class="nav nav-pills flex-column mb-auto">
        <NavItem v-for="(element, name) in element.children" :element="element" :key="name"/>
    </ul>
</template>

<script lang="ts" setup>
import NavItem from "~/js/Components/Layout/Dashboard/Sidebar/Nav/NavItem.vue";
import {GroupElementInterface} from "~/js/Interfaces/Menu/Elements/GroupElementInterface";

const {element} = defineProps<{
    element: GroupElementInterface;
}>();
</script>

<style lang="scss" scoped>

</style>
