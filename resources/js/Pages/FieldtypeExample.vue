<template>
    <!--<body data-test="{{ Vite::useHotFile(public_path('hot'))->asset('resources/js/Fieldtypes/Text.vue') }}">-->
    <dashboard>
        Peop
        <component v-if="comp" :is="comp"/>
    </dashboard>
</template>
<script>
let test = document.body.getAttribute('data-test');

import Dashboard from "../Layouts/Dashboard.vue";

export default {
    components: {Dashboard},

    data() {
        return {
            comp: null
        };
    },

    async beforeCreate()
    {
        const Test = await import(test);
        this.comp = Test.default;
    }
}
</script>