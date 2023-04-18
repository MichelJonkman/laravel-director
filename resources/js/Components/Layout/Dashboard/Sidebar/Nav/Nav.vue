<template>
    <ul class="nav nav-pills flex-column mb-auto">
        <Suspense>
            <NavItem v-for="(element, name) in menu.children" :element="element" :key="name"/>
        </Suspense>
    </ul>
</template>

<script lang="ts" setup>
import NavItem from "./NavItem.vue";
import {MenuInterface} from "~/js/Interfaces/Menu/MenuInterface";
import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";
import {getUrl} from "~/npm/js/helpers";
import {LinkInterface} from "~/js/Interfaces/Menu/Elements/LinkInterface";
import {GroupElementInterface} from "~/js/Interfaces/Menu/Elements/GroupElementInterface";
import {MenuElementsInterface} from "~/js/Interfaces/Menu/MenuElementsInterface";
import {router} from "@inertiajs/vue3";

const {menu} = defineProps<{
    menu: MenuInterface
}>();

console.log(menu);

menu.elements = {};
for (const [name, element] of Object.entries(menu.children)) {
    menu.elements[name] = element;

    if (element.hasOwnProperty('children')) {
        menu.elements = Object.assign(menu.elements, getChildren((<GroupElementInterface>element).children));
    }
}

const links: LinkInterface[] = [];

for (const element of Object.values<ElementInterface>(menu.elements)) {
    if (element.hasOwnProperty('isLink') && (<LinkInterface>element).isLink) {
        links.push(<LinkInterface>element);
    }
}

router.on('navigate', () => {
    const url = getUrl();

    for (const element of links) {
        if (element.url === url) {
            element.active = true;
            continue;
        }
        element.active = false;
    }
});

function getChildren(children: MenuElementsInterface): MenuElementsInterface {
    let elements: MenuElementsInterface = {};

    for (const [name, element] of Object.entries(children)) {
        elements[name] = element;

        if (element.hasOwnProperty('children')) {
            elements = Object.assign(elements, getChildren((<GroupElementInterface>element).children));
        }
    }

    return elements;
}

</script>

<style lang="scss" scoped>

</style>
