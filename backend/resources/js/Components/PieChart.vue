<template>
    <div class="font-medium text-gray-500 uppercase text-center flex items-center justify-center">{{ title }}</div>
    <highcharts class="hc" :options="chartOptions" ref="chart"></highcharts>
</template>
<script setup>
const props = defineProps({
    series: Array,
    title: String
})

const chartOptions = {
    chart: {
        height: 250,
        type: 'pie',
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: props.series,
    title: {
        text: null
    },
}
</script>