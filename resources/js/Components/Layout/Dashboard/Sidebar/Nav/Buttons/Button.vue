<template>
    <li class="nav-item" :id="'nav-' + button.name.replace('.', '-')" :data-name="button.name">
        <a class="nav-link" aria-current="page">
            {{ button.title }}
        </a>
    </li>
</template>

<script lang="ts" setup async>
import {defineProps} from "vue";
import {ButtonInterface} from "~/js/Interfaces/Buttons/ButtonInterface.js";

const {button} = defineProps<{
    button: ButtonInterface;
}>();
</script>


<style lang="scss" scoped>

</style>
