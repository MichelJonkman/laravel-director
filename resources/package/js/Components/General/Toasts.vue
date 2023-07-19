<template>
    <div class="toasts-container">
        <div v-for="(toast, index) in toasts" :key="index" :class="'alert-' + toast.type" class="toast">
            {{ toast.message }}
        </div>
    </div>
</template>

<script lang="ts" setup>
import {router, usePage} from "@inertiajs/vue3";
import {ref} from "vue";

let toasts = ref(getToasts());

router.on('finish', () => {
    toasts.value = [
        ...toasts.value,
        ...getToasts()
    ];
});

function getToasts(): Toast[] {
    return (<{ flash?: { toasts?: Toast[] } }>usePage().props)?.flash?.toasts ?? [];
}

interface Toast {
    type: string;
    message: string;
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