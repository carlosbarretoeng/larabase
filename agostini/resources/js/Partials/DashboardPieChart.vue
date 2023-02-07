<template>
    <Card>
        <template v-slot:header>
            <div class="font-extrabold text-center text-xs uppercase flex items-center justify-center h-10">
                {{ title }}
            </div>
        </template>
<!--        <ChartPie v-if="type==='pie'" :options="{ chart: { height: 200 } }" :data="value"/>-->
        <template v-slot:default>
            <highcharts class="hc -m-4 z-50" :options="chartOptions"></highcharts>
        </template>
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

const chartOptions = {
    chart:{
        type: 'pie',
        height: 210
    },
    title: {
        text: null
    },
    credits: {
        enabled: false
    },
    legend: {
        enabled: false
    },
    series: [
        {
            data: value
        }
    ]
}

onMounted(async () => {
    value.value = (await Bootstrap.api.get(props.request)).data ?? []
})
</script>
