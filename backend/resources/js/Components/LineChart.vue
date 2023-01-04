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
        type: 'spline',
        height: 250,
    },
    credits: {
        enabled: false
    },
    title: {
        text: null
    },

    legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2010
        }
    },

    series: props.series,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }
}
</script>