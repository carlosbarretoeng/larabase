<template>
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <div v-if="hasHeaderStlot" class="bg-stone-100 border-b">
            <slot name="header"/>
        </div>
        <div class="p-4">
            <slot/>
        </div>
        <div v-if="hasActionsStlot" class="border-t p-4 grid grid-cols-3 gap-2">
            <slot name="actions"/>
        </div>
    </div>
</template>

<script setup lang="ts">
import {useSlots} from "vue";

const slots = useSlots();

const hasHeaderStlot = !!slots.header
const hasActionsStlot = !!slots.actions

</script>

<style scoped>

</style>
