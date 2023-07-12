<template>
    <span v-html="element.html"></span>
</template>

<script lang="ts" setup async>

import {HtmlElementInterface} from "~/js/Interfaces/Settings/Elements/HtmlElementInterface";

const {element} = defineProps<{
    element: HtmlElementInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
