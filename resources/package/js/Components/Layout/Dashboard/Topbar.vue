<template>
    <div class="topbar">
        <div class="topbar-side">
            <a class="topbar-brand" href="/admin/">
                <span class="fs-4">Director</span>
            </a>
            <button class="sidebar-toggle" @click="toggleSidebar()">
                <svg class="bi bi-caret-left-fill" fill="currentColor" height="16" viewBox="0 0 16 16"
                     width="16" xmlns="http://www.w3.org/2000/svg">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script lang="ts" setup async>
import {ref} from "vue";

let sidebarOpened = ref(true);

function toggleSidebar() {
    sidebarOpened.value = !sidebarOpened.value;
}
</script>


<style lang="scss" scoped>
.topbar {
    height: $layout-topbar-height;
    background: $dark;

    .topbar-side {
        display: flex;
        justify-content: space-between;
        height: 100%;
        background: $dark-blue-900;
        width: $layout-sidebar-width;

        .topbar-brand {
            display: flex;
            align-items: center;
            margin: 0 1rem;
            text-decoration: none;
            color: $body-color-dark;
        }
    }

    .sidebar-toggle {
        display: flex;
        align-items: center;
        flex: 0 0 2rem;
        justify-content: center;
        width: inherit;
        padding: 1rem;
        cursor: pointer;
        transition: color ease .25s, transform ease .25s;
        color: $gray-500;
        border: 0;
        background-color: transparent;

        &:focus-visible {
            color: $primary;
            outline: 0;
        }

        &:hover {
            color: $component-active-color;
        }

        &.closed {
            transform: rotate(-180deg);
        }
    }
}
</style>
