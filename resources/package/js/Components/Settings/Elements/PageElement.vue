<template>
    <Link :href="route('director.settings.page', {slug: element.slug})" :title="element.title" class="nav-link" :class="{active: element.active}" aria-current="page">
        {{ element.title }}
    </Link>
</template>

<script lang="ts" setup async>
import {PageElementInterface} from "~/js/Interfaces/Settings/Elements/PageElementInterface";
import Link from "~/js/Components/Link.vue";
import route from "ziggy-js";

const {element} = defineProps<{
    element: PageElementInterface;
}>();

if(element.slug === 'index') {
    element.slug = '';
}

</script>

<style lang="scss" scoped>

</style>
