<template>
    <li class="nav-item" :id="'nav-' + button.name.replace('.', '-')" :data-name="button.name">
        <InertiaLink :to="button.url" class="nav-link" aria-current="page">
            <IconUrl :url="button.iconUrl" class="icon me-1"/>
            {{ button.title }}
        </InertiaLink>
    </li>
</template>

<script lang="ts" setup async>
import {LinkButtonInterface} from "~/js/Interfaces/Buttons/LinkButtonInterface.js";
import {defineProps} from "vue";
import IconUrl from "~/js/Components/IconUrl.vue";

const {button} = defineProps<{
    button: LinkButtonInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
