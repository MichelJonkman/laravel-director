<template>
    <div class="mt-2 mb-2" :class="{closed: !isOpen}">
        <div class="nav-link fw-bold">
            <div>{{ element.title }}</div>

            <button class="group-toggle" :class="{closed: !isOpen}" @click="toggleGroup()">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="16"
                     height="16"
                     fill="currentColor"
                     class="bi bi-caret-down-fill"
                     viewBox="0 0 16 16">
                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
            </button>
        </div>
        <ul class="nav nav-pills flex-column mb-auto">
            <NavItem v-for="(element, name) in element.children" :element="element" :key="name"/>
        </ul>
    </div>
</template>

<script lang="ts" setup>
import NavItem from "~/js/Components/Layout/Dashboard/Sidebar/Nav/NavItem.vue";
import {GroupElementInterface} from "~/js/Interfaces/Menu/Elements/GroupElementInterface";
import {ref} from "vue";

const {element} = defineProps<{
    element: GroupElementInterface;
}>();

const isOpen = ref(getState(element.name));

checkActive(element);

function toggleGroup() {
    isOpen.value = !isOpen.value;
    saveState(element.name, isOpen.value);
}

function saveState(name: string, state: boolean) {
    let item = window.localStorage.getItem('menu.closedGroups');
    let states: string[] = [];

    if (item) {
        states = JSON.parse(item);
    }

    if (state) {
        states = states.filter(item => item !== name);
    } else {
        states.push(name);
    }

    window.localStorage.setItem('menu.closedGroups', JSON.stringify(states));
}

function getState(name: string) {
    let item = window.localStorage.getItem('menu.closedGroups');
    if (!item) {
        return true;
    }

    let states: string[] = JSON.parse(item);
    return states.indexOf(name) === -1;
}

function checkActive(element: ElementInterface) {
    if(element.hasOwnProperty('active') && element.active) {
        return true;
    }

    for (const child in element.children) {

    }
}

interface ElementInterface {
    active?: boolean;
    children?: ElementInterface[]
}
</script>

<style lang="scss" scoped>
.nav-link {
    display:         flex;
    justify-content: space-between;
}

.nav {
    overflow: hidden;
}

.closed {
    .nav {
        height: 0;
    }
}

.group-toggle {
    display:          flex;
    align-items:      center;
    flex:             0 0 2rem;
    justify-content:  center;
    width:            inherit;
    cursor:           pointer;
    transition:       color ease .25s, transform ease .25s;
    color:            $gray-600;
    border:           0;
    background-color: transparent;

    &:focus-visible {
        color:   $primary;
        outline: 0;
    }

    &:hover {
        color: $component-active-color;
    }

    &.closed {
        transform: rotate(-180deg);
    }
}
</style>
