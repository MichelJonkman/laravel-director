<template>
    <div class="mb-4">
        <label v-if="element.label" :for="`setting-${element.name.replace('.', '-')}`" class="form-label">{{ element.label }}</label>
        <input type="text" :value="value" @input="value = $event.target.value" :id="`setting-${element.name.replace('.', '-')}`" class="form-control">
    </div>
</template>

<script lang="ts" setup async>

import {TextSettingInterface} from "~/js/Interfaces/Settings/Elements/Settings/TextSettingInterface";
import {computed} from "vue";

const {element, modelValue} = defineProps<{
    element: TextSettingInterface;
    modelValue?: string;
}>();

const emit = defineEmits(['update:modelValue']);

const value = computed({
    get() {
        return modelValue;
    },
    set(value) {
        emit('update:modelValue', value);
    }
});

if (!modelValue) {
    value.value = element.value;
}
</script>


<style lang="scss" scoped>

</style>
