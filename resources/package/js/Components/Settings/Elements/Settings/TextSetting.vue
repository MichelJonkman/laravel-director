<template>
    <div class="mb-4">
        <label v-if="element.label" :for="`setting-${element.name.replace('.', '-')}`" class="form-label">{{ element.label }}</label>
        <input type="text" :id="`setting-${element.name.replace('.', '-')}`" class="form-control" :value="element.default">
    </div>
</template>

<script lang="ts" setup async>

import {TextSettingInterface} from "~/js/Interfaces/Settings/Elements/Settings/TextSettingInterface";

const {element} = defineProps<{
    element: TextSettingInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
