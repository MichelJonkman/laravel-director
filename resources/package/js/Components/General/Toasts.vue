<template>
    <div class="toasts-container">
        <div v-for="(toast, index) in toasts" :key="index" :class="'toast-' + toast.type" class="toast">
            {{ toast.message }}
            <button type="button" class="btn-close" aria-label="Close" @click="toast.remove()"></button>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {router, usePage} from "@inertiajs/vue3";
import {ToastInterface} from "~/js/Classes/Toasts/ToastInterface";
import {Toast, toasts} from "~/js/Classes/Toasts/Toast";

initToasts(getToasts());

router.on('finish', () => {
    initToasts(getToasts());
});

function getToasts(): ToastInterface[] {
    return (<{ flash?: { toasts?: ToastInterface[] } }>usePage().props)?.flash?.toasts ?? [];
}

function initToasts(toasts: ToastInterface[]) {
    for (const [index, toastData] of Object.entries(toasts)) {
        Toast.new(toastData.type, toastData.message, toastData.ttl * 1000);
    }
}
</script>

<style lang="scss" scoped>
.toasts-container {
    position: fixed;
    pointer-events: none;
    right: 0;
    bottom: 0;
    padding: 1rem;
}

.toast {
    pointer-events: all;
    padding: 1rem;
    border-radius: $border-radius;
    position: relative;
    color: var(--toast-color);
    background-color: var(--toast-bg);
    margin-bottom: .5rem;

    @each $state in map-keys($theme-colors) {
        &.toast-#{$state} {
            --toast-color: var(--#{$prefix}#{$state}-text-emphasis);
            --toast-bg: var(--#{$prefix}#{$state}-bg-subtle);
            --toast-border-color: var(--#{$prefix}#{$state}-border-subtle);
            --toast-link-color: var(--#{$prefix}#{$state}-text-emphasis);
        }
    }
}
</style>
