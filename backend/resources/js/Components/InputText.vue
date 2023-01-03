<template>
    <div>
        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
        <input type="text" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" :placeholder="placeholder ?? label" required>
    </div>
</template>
<script setup>
const props = defineProps({
    label: String,
    placeholder: String,
    modelValue: String
})
</script>