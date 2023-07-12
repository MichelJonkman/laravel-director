<template>
    <span v-html="element.html"></span>
</template>

<script lang="ts" setup async>

import {SettingsElementsInterface} from "~/js/Interfaces/Settings/SettingsElementsInterface";

const {element} = defineProps<{
    element: SettingsElementsInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
