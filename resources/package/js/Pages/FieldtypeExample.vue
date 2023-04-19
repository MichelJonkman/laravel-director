<template>
    <!--<body data-test="{{ Vite::useHotFile(public_path('hot'))->asset('resources/js/Fieldtypes/Text.vue') }}">-->
    <div>
        Peop
        <component v-if="comp" :is="comp"/>
    </div>
</template>
<script>
let test = document.body.getAttribute('data-test');

import Dashboard from "../Layouts/Dashboard.vue";

export default {
    components: {Dashboard},

    data()
    {
        return {
            comp: null
        };
    },

    async beforeCreate()
    {
        const Test = await import(test);
        console.log(Test);
        this.comp = Test.default;
    }
}
</script>