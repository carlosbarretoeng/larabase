<template>
    <div id="mega-menu-full" class="flex justify-between items-center w-full w-auto">
        <ul class="flex flex-row text-sm font-medium">
            <NavbarMenuItem v-for="(menu, index) in menus" :key="index" :menu="menu" @change="changeActiveMenu($event)"/>
        </ul>
    </div>
</template>
<script setup>
import NavbarMenuItem from './NavbarMenuItem.vue'

const changeActiveMenu = (event) => {
    console.log(event)
}

const menus = [
    {
        label: 'Início',
        href: 'dashboard.index'
    },
    {
        label: 'Gestão de Produção',
        href: 'auth.login',
        opened: false,
        children: [
            {
                label: 'Produtos',
                caption: 'Cadastro dos produtos da empresa',
                href: 'dashboard.production'
            },
            {
                label: 'Ordens de Produção',
                caption: 'Controle das ordens de produção',
                href: ''
            }
        ]
    },
    {
        label: 'Gestão de Custos',
        href: 'dashboard.production'
    },
    {
        label: 'Gestão de Vendas',
        href: 'auth.login'
    },
    {
        label: 'Gestão de Cargas',
        href: 'auth.login'
    }
]
</script>