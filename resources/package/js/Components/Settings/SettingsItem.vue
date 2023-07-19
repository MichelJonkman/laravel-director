<template>
    <div class="settings-item" :class="element.classes" :id="'settings-' + element.name.replace('.', '-')" :data-name="element.name">
        <Component v-if="component" :is="component.default" :element="element" v-model="value"/>
    </div>
</template>

<script lang="ts" setup async>
import {ElementInterface} from "~/js/Interfaces/Settings/Elements/ElementInterface";
import {computed} from "vue";

const {element, modelValue} = defineProps<{
    element: ElementInterface;
    modelValue?: string;
}>();

const emit = defineEmits(['update:modelValue']);

let component = null;

if (element.typeName !== 'Element') {
    component = await import(/* @vite-ignore */element.componentUrl);
}

const value = computed({
    get() {
        return modelValue;
    },
    set(value) {
        emit('update:modelValue', value);
    }
});

</script>

<style scoped>

</style>
