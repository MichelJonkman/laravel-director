<template>
    <li class="nav-item" :class="element.classes" :id="'nav-' + element.name.replace('.', '-')" :data-name="element.name">
        <Component v-if="component" :is="component.default" :element="element"/>
    </li>
</template>

<script lang="ts" setup async>
import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";

const {element} = defineProps<{
    element: ElementInterface;
}>();

let component = null;

if (element.typeName !== 'Element') {
    component = await import(/* @vite-ignore */element.componentUrl);
}

</script>


<style lang="scss" scoped>
:deep(.nav-link) {
    color: $body-color-dark;
}
</style>
