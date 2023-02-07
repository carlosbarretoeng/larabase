<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DashboardStats from "../Partials/DashboardStats.vue";
import DashboardLineChart from "../Partials/DashboardLineChart.vue";
import DashboardPieChart from "../Partials/DashboardPieChart.vue";

import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
} from '@headlessui/vue'

import { ChevronRightIcon } from '@heroicons/vue/20/solid'

import { GoogleMap, Marker } from 'vue3-google-map'

const center = {lat: -21.12, lng: -42.942778};
</script>

<template>
    <AppLayout>
        <div class="p-2">

            <Disclosure>
                <DisclosureButton class="w-full bg-white border-x border-t border-gray-200 rounded-t-lg overflow-hidden">
                    <div class="text-lg font-bold uppercase text-left p-2 bg-stone-100 border-b flex">
                        <ChevronRightIcon class="ui-open:rotate-90 ui-open:transform w-6" />
                        Produção
                    </div>
                </DisclosureButton>
                <DisclosurePanel class="bg-white border-x border-b border-gray-200 p-2">
                    <div class="grid grid-cols-12 gap-2">
                        <div class="col-span-12 sm:col-span-2">
                            <div class="grid grid-cols-2 gap-2">
                                <DashboardStats :request="route('dashboard.stats',{ metric: 'Stats_EstacaoDeTrabalho' })" title="Estação de Trabalho"/>
                                <DashboardStats :request="route('dashboard.stats',{ metric: 'Stats_Maquinario' })" title="Maquinário"/>
                                <DashboardStats :request="route('dashboard.stats',{ metric: 'Stats_Produtos' })" title="Produtos"/>
                                <DashboardStats :request="route('dashboard.stats',{ metric: 'Stats_OrdensDeProducao' })" title="Ordens de Produção"/>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-2">
                            <DashboardPieChart :request="route('dashboard.stats',{ metric: 'Stats_EstacaoDeTrabalho' })" title="Motivos de Parada"/>
                        </div>
                        <div class="col-span-12 sm:col-span-8">
                            <DashboardLineChart :request="route('dashboard.stats',{ metric: 'Stats_EstacaoDeTrabalho' })" title="Tempo médio de produção"/>
                        </div>
                    </div>
                </DisclosurePanel>
            </Disclosure>
            <Disclosure>
                <DisclosureButton class="w-full bg-white border-x border-gray-200 overflow-hidden">
                    <div class="text-lg font-bold uppercase text-left p-2 bg-stone-100 border-b flex">
                        <ChevronRightIcon class="ui-open:rotate-90 ui-open:transform w-6" />
                        Custos
                    </div>
                </DisclosureButton>
                <DisclosurePanel class="bg-white border-x border-b border-gray-200 p-2">
                    <div class="grid grid-cols-12 gap-2">
                        &nbsp;
                    </div>
                </DisclosurePanel>
            </Disclosure>
            <Disclosure>
                <DisclosureButton class="w-full bg-white border-x border-gray-200 overflow-hidden">
                    <div class="text-lg font-bold uppercase text-left p-2 bg-stone-100 border-b flex">
                        <ChevronRightIcon class="ui-open:rotate-90 ui-open:transform w-6" />
                        Vendas
                    </div>
                </DisclosureButton>
                <DisclosurePanel class="bg-white border-x border-b border-gray-200 p-2">
                    <div class="grid grid-cols-12 gap-2">
                        <div class="col-span-12 sm:col-span-11" >
                            <GoogleMap
                                api-key="AIzaSyCd5JyXSm75o19Mu2UUQpd2corAqLtDBz0"
                                style="width: 100%; height: 500px"
                                :center="center"
                                :zoom="12"
                            >
                                <Marker :options="{ position: center }" />
                            </GoogleMap>
                        </div>
                    </div>
                </DisclosurePanel>
            </Disclosure>
            <Disclosure>
                <DisclosureButton class="w-full bg-white border-x border-gray-200 overflow-hidden rounded-b-lg ui-open:rounded-none">
                    <div class="text-lg font-bold uppercase text-left p-2 bg-stone-100 border-b flex">
                        <ChevronRightIcon class="ui-open:rotate-90 ui-open:transform w-6" />
                        Cargas
                    </div>
                </DisclosureButton>
                <DisclosurePanel class="bg-white border-x border-b border-gray-200 p-2 rounded-b-lg">
                    <div class="grid grid-cols-12 gap-2">
                        &nbsp;
                    </div>
                </DisclosurePanel>
            </Disclosure>
        </div>
    </AppLayout>
</template>
