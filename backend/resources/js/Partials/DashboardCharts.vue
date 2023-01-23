<template>
    <Card>
        <template v-slot:header>
            <div class="font-extrabold text-center text-xs uppercase flex items-center justify-center h-10">
                {{ title }}
            </div>
        </template>
        <template v-if="value !== null">
            <ChartPie v-if="type==='pie'" :options="{ chart: { height: 200 } }" :data="value"/>
            <ChartLine v-else :options="{ chart: { height: 200 } }" :data="value"/>
        </template>
        <template v-else>
            ...
        </template>
        <hr/>
        {{ value }}
    </Card>
</template>

<script setup lang="ts">
import Card from "../Components/Card.vue";
import ChartLine from "../Components/ChartLine.vue";
import ChartPie from "../Components/ChartPie.vue";
import {onMounted, ref} from "vue";
import Bootstrap from '../bootstrap';

const props = defineProps({
    title: String,
    type: String,
    height: Number,
    request: String,
})

const value = ref(null)

onMounted(async () => {
    value.value = (await Bootstrap.api.get(props.request)).data ?? []
})
</script>
