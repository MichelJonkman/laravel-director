<template>
    <div>
        <div v-for="(type, message) in pageProps.flash.toast" :key="type" :class="'alert-' + type">
            {{ message }}
        </div>
    </div>
</template>

<script lang="ts" setup>
import {usePage} from "@inertiajs/vue3";

let pageProps = usePage().props ?? {flash: {toast: {}}};
</script>

<style scoped>

</style>