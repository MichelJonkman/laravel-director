<template>
    <li class="nav-item" :id="'nav-' + name.replace('.', '-')" :data-name="name">
        <InertiaLink :to="button.url" class="nav-link" aria-current="page">
            <Component v-if="icon" :is="icon" class="icon me-1"/>
            {{ button.content }}
        </InertiaLink>
    </li>
</template>

<script lang="ts" setup async>
import {ButtonInterface} from "~/js/Interfaces/MenuInterface.js";

const {name, button} = defineProps<{
    name: string;
    button: ButtonInterface;
}>();

let icon = null;

if (button.iconLink) {
    icon = await import(/* @vite-ignore */button.iconLink);
}
</script>


<style lang="scss" scoped>
.nav-link {
    color: $white;
}
</style>
