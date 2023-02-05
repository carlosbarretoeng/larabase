<template>
    <Card>
        <template v-slot:header>
            <div class="font-extrabold text-center text-xs uppercase flex items-center justify-center h-10">
                {{ title }}
            </div>
        </template>
        <div class="text-center">
            <div class="font-extrabold text-3xl -m-2 h-16 flex items-center justify-center">
                {{ value ?? '-' }}
            </div>
        </div>
    </Card>
</template>

<script setup lang="ts">
import Card from "../Components/Card.vue";
import {onMounted, ref} from "vue";
import Bootstrap from '../bootstrap';

const props = defineProps({
    title: String,
    request: String,
})

const value = ref(null)

onMounted(async () => {
    if(props.request)
        value.value = (await Bootstrap.api.get(props.request)).data ?? '---'
})
</script>
