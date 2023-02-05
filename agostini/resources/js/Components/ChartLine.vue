<template>
    <div class="w-full">
        <highcharts :options="chartOptions"></highcharts>
    </div>
</template>

<script setup lang="ts">
import _ from 'lodash'

const props = defineProps({
    data: Array,
    options: Object
})

const baseOptions = {
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
            data: props.data
        }
    ]
}

const chartOptions = _.merge(baseOptions, props.options ?? {})

</script>
