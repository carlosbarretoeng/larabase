<template>
    <AppLayout>

        CRUD INDEX

        <hr/>

<pre>{{ data }}</pre>

    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    data: Array
})
</script>
