<template>
    <Link :href="element.url" :title="element.title" :target="element.target" class="nav-link" :class="{active: element.active}" aria-current="page">
        <IconUrl v-if="element.iconUrl" :url="element.iconUrl" class="icon me-1"/>
        {{ element.text }}
    </Link>
</template>

<script lang="ts" setup async>
import IconUrl from "~/js/Components/IconUrl.vue";
import {LinkButtonInterface} from "~/js/Interfaces/Menu/Elements/LinkButtonInterface";
import Link from "~/js/Components/Link.vue";

const {element} = defineProps<{
    element: LinkButtonInterface;
}>();

</script>

<style lang="scss" scoped>

</style>
