<template>
    <InertiaLink :to="element.url" class="nav-link" aria-current="page">
        <IconUrl :url="element.iconUrl" class="icon me-1"/>
        {{ element.text }}
    </InertiaLink>
</template>

<script lang="ts" setup async>
import IconUrl from "~/js/Components/IconUrl.vue";
import {LinkButtonInterface} from "~/js/Interfaces/Menu/Elements/LinkButtonInterface";

const {element} = defineProps<{
    element: LinkButtonInterface;
}>();
</script>

<style lang="scss" scoped>

</style>
