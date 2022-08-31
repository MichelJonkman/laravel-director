<template>
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
        console.log(Test.default, Dashboard)
        this.comp = Test.default;
    }
}
</script>