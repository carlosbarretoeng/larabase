<template>
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <div class="grid grid-cols-6 gap-4 mb-4">
                <div class="">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Produto</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option selected>Todos os Produtos</option>
                        <option value="1">Produto 1</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div>
                <div id="dateRangePickerId" class="col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Período</label>
                    <div date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input name="start" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Data inicial">
                        </div>
                        <span class="mx-4 text-gray-500">até</span>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input name="end" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Data final">
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="mt-7 w-full text-white bg-indigo-500 hover:bg-indigo-600 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Pesquisar</button>
                </div>
            </div>
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 sm:col-span-1">
                    <PieChartVue title="Motivos de parada"
                        :series="PieChartSeries" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <LineChartVue title="Tempo médio de produção" :series="LineChartSeries" />
                </div>
                <div class="col-span-6 sm:col-span-1">
                    <PieChartVue title="Produção vs Parada"
                        :series="PieChartSeries" />
                </div>
            </div>
        </div>
</template>
<script setup>
import PieChartVue from './../../../Components/PieChart.vue';
import LineChartVue from '../../../Components/LineChart.vue';
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';

import { onMounted } from 'vue';

onMounted(() => {
    const dateRangePickerEl = document.getElementById('dateRangePickerId');
    new DateRangePicker(dateRangePickerEl, {
        autohide: true,
        language: 'pt-br',
        format: "dd/mm/yyyy",
        maxDate: new Date(),
    }); 
})

const PieChartSeries = [
    { 
        name: 'Share', 
        data: [
            { 
                name: 'Chrome', 
                y: 74.03 
            }
        ] 
    }
]

const LineChartSeries = [
    {
        name: 'Produto 1',
        data: [43934, 48656, 65165, 81827, 112143, 142383,
            171533, 165174, 155157, 161454, 154610]
    }
]
</script>