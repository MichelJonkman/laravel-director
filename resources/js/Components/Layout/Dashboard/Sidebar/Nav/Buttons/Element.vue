<template>
    <li class="nav-item" :id="'nav-' + element.name.replace('.', '-')" :data-name="element.name"></li>
</template>

<script lang="ts" setup async>
import {defineProps} from "vue";
import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";

const {element} = defineProps<{
    element: ElementInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
