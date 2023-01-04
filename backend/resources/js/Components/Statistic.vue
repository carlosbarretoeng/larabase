<template>
    <div class="flex flex-col block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-neutral-100">
        <div class="mb-2 text-3xl font-extrabold w-full h-12 flex items-center justify-center">{{ value }}</div>
        <div class="font-medium text-gray-500 uppercase text-center flex items-center justify-center">{{ label }}</div>
    </div>
</template>
<script setup>
const props = defineProps({
    label: String,
    value: String
})
</script>