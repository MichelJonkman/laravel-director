<template>
    <Component :is="element" :href="href" :target="target">
        <slot/>
    </Component>
</template>

<script lang="ts" setup async>

const {href, target} = defineProps<{
    href: string;
    target?: string;
}>();

let element = 'InertiaLink';

if(target !== '_self' && target !== null && target !== undefined) {
    element = 'a';
}
else {
    try {
        const currentUrl = new URL(window.location.href);
        const targetUrl = new URL(href.replace(/^(https?:\/\/)?(\/\/)?/, 'https://'));

        if(currentUrl.origin !== targetUrl.origin) {
            element = 'a';
        }
    }
    catch (e) {}
}
</script>


<style lang="scss" scoped>

</style>
