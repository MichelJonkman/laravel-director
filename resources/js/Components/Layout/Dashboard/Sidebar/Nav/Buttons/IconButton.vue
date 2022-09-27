<template>
    <li class="nav-item" :id="'nav-' + button.name.replace('.', '-')" :data-name="button.name">
        <a class="nav-link" aria-current="page">
            <IconUrl :url="button.iconUrl" class="icon me-1"/>
            {{ button.title }}
        </a>
    </li>
</template>

<script lang="ts" setup async>
import {defineProps} from "vue";
import {IconButtonInterface} from "~/js/Interfaces/Buttons/IconButtonInterface.js";
import IconUrl from "~/js/Components/IconUrl.vue";

const {button} = defineProps<{
    button: IconButtonInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
