<template>
  <div
    class="bg-red-500 hover:bg-red-700 text-white text-center py-2 px-4 rounded"
  >
    {{ label }}
  </div>
</template>
<script setup>
const props = defineProps({
    label: String
})
</script>
