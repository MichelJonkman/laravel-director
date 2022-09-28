<template>
    <a class="nav-link" aria-current="page">
        <IconUrl :url="element.iconUrl" class="icon me-1"/>
        {{ element.text }}
    </a>
</template>

<script lang="ts" setup async>
import IconUrl from "~/js/Components/IconUrl.vue";
import {IconTextElementInterface} from "~/js/Interfaces/Menu/Elements/IconTextElementInterface";

const {element} = defineProps<{
    element: IconTextElementInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
