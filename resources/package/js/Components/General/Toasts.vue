<template>
    <div class="toasts-container">
        <div v-for="(toast, index) in toasts" :key="index" :class="'alert-' + toast.type" class="toast">
            {{ toast.message }}
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
        Toast.new(toastData.type, toastData.message, toastData.ttl);
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
    background: white;
    padding: 1rem;
}
</style>
