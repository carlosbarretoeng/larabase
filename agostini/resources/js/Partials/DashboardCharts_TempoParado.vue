<template>
    <Card>
        <template v-slot:header>
            <div class="font-extrabold text-center text-xs uppercase flex items-center justify-center h-10">
                Tempo Parado nos Últimos 30 dias
            </div>
        </template>
        <template v-if="value !== null">
            <ChartLine :options="chartOptions" :data="value"/>
        </template>
        <template v-else>
            ...
        </template>
        <hr/>
        {{ value }}
    </Card>
</template>

<script setup lang="ts">
import moment from 'moment';
import Card from "../Components/Card.vue";
import ChartLine from "../Components/ChartLine.vue";
import {onMounted, ref} from "vue";
import Bootstrap from '../bootstrap';

const chartOptions = {
    chart: {
        height: 250
    },
    xAxis: {
        type: 'datetime',
    },
    yAxis: {
        title: {
            text: 'Tempo (segundos)'
        }
    },
};

const value = ref(null)

onMounted(async () => {
    let since = moment().startOf('day').subtract(30, 'days').format('X')
    let url = route('dashboard.stats', { metric: 'Chart_TempoParado', since: since });
    value.value = (await Bootstrap.api.get(url)).data ?? []
})
</script>
