<template>
    <Component :is="element" :href="href" :target="target">
        <slot/>
    </Component>
</template>

<script lang="ts" setup async>

const {href, target} = defineProps<{
    href: string;
    target: string|null;
}>();

let element = 'InertiaLink';

if(target !== '_self' && target !== null) {
    element = 'a';
}
else {
    try {
        const current = new URL(window.location.href);
        const target = new URL(href.replace(/^(https?:\/\/)?(\/\/)?/, 'https://'));

        if(current.origin !== target.origin) {
            element = 'a';
        }
    }
    catch (e) {}
}
</script>


<style lang="scss" scoped>

</style>
