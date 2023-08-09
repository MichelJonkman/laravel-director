<template>
    <div class="topbar">
        <div class="topbar-side">
            <a class="topbar-brand" href="/admin/">
                <span class="fs-4">Director</span>
            </a>
        </div>
        <div class="topbar-toggles">
            <button class="sidebar-toggle" :class="{closed: sidebarClosed}" @click="sidebarStore.toggleSidebar()">
                <svg class="bi bi-caret-left-fill" fill="currentColor" height="16" viewBox="0 0 16 16"
                     width="16" xmlns="http://www.w3.org/2000/svg">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </button>
            <button class="sidebar-toggle" :class="{closed: settingsSidebarClosed}" @click="sidebarStore.toggleSettingsSidebar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script lang="ts" setup async>
import {useSidebarStore} from "~/js/Stores/SidebarStore";
import {storeToRefs} from "pinia";

const sidebarStore = useSidebarStore();
const {sidebarClosed, settingsSidebarClosed} = storeToRefs(sidebarStore);
</script>


<style lang="scss" scoped>
.topbar {
    min-height: $layout-topbar-height;
    height: $layout-topbar-height;
    background: $dark;
    display: flex;

    .topbar-side {
        display: flex;
        justify-content: space-between;
        height: 100%;
        background: $dark-blue-900;
        min-width: $layout-sidebar-width;
        width: $layout-sidebar-width;

        .topbar-brand {
            display: flex;
            align-items: center;
            margin: 0 1rem;
            text-decoration: none;
            color: $body-color-dark;
        }
    }

    .topbar-toggles {
        display: flex;

        .sidebar-toggle {
            display: flex;
            align-items: center;
            flex: 0 0 2rem;
            justify-content: center;
            width: inherit;
            padding: 1rem;
            cursor: pointer;
            transition: color ease .25s, transform ease .25s;
            color: $gray-600;
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
}
</style>
