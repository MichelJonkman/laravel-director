<template>
    <InertiaLink :href="element.url" :title="element.title" :target="element.target" class="nav-link" aria-current="page">
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
