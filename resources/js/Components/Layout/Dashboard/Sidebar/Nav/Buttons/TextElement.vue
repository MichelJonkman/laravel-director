<template>
    <li class="nav-item" :id="'nav-' + element.name.replace('.', '-')" :data-name="element.name">
        <a class="nav-link" aria-current="page">
            {{ element.text }}
        </a>
    </li>
</template>

<script lang="ts" setup async>
import {defineProps} from "vue";
import {TextElementInterface} from "~/js/Interfaces/Menu/Elements/TextElementInterface";

const {element} = defineProps<{
    element: TextElementInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
