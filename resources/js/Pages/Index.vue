<template>
    <dashboard>
        Peop
    </dashboard>
</template>
<script>
let test = document.body.getAttribute('data-test');

import Dashboard from "../Layouts/Dashboard.vue";
const Test = import(test);

export default {
    components: {Dashboard},
    async created()
    {

    }
}
</script>