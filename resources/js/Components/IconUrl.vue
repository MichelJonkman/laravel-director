<template>
    <Component :is="component" class="icon"/>
</template>

<script lang="ts" setup async>
import {defineProps} from "vue";

const {url} = defineProps<{
    url: string;
}>();

const component = await import(/* @vite-ignore */url);
</script>


<style lang="scss" scoped>

</style>
