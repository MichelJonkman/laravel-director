<template>
    <div class="h-100">
        <div class="col">
            Settings!!
        </div>
    </div>
</template>

<script lang="ts" setup>
import {usePage} from "@inertiajs/vue3";
import {SettingsInterface} from "~/js/Interfaces/Settings/SettingsInterface";
import {defineOptions} from "unplugin-vue-define-options/macros";
import Settings from "~/js/Layouts/Settings.vue";
import Dashboard from "~/js/Layouts/Dashboard.vue";

defineOptions({ layout: [Dashboard, Settings] });

let pageProps = usePage().props ?? {settings: {}};
let settings: SettingsInterface = pageProps.settings as SettingsInterface;

</script>

<style lang="scss" scoped>

</style>
