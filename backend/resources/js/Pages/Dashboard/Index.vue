<template>
    <MainLayoutVue>
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-4">
            <StatisticVue label="Usuários" value="0" />
            <StatisticVue label="Departamentos" value="0" />
            <StatisticVue label="Estações de trabalho" value="0" />
            <StatisticVue label="Produtos" value="0" />
            <StatisticVue label="Ordens de Produção" value="0" />
        </div>

        <ProducaoGraficosVue />
        
    </MainLayoutVue>
</template>
<script setup>
import MainLayoutVue from '../../Layouts/MainLayout.vue';
import StatisticVue from '../../Components/Statistic.vue';

import ProducaoGraficosVue from './Components/ProducaoGraficos.vue';
</script>