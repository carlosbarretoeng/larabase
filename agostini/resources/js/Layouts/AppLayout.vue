<script setup>
import _ from 'lodash';
import {Inertia} from '@inertiajs/inertia';

import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

import BaseLayout from "../Layouts/BaseLayout.vue";
import Button from "../Components/Button.vue";

import AuthUtil from '../Utils/Auth';

defineProps({
    title: String,
});

const menus = _.compact([
    {
        'label': 'Início',
        'href': route('dashboard')
    },
    {
        'label': 'Sistema',
        'href': route('dashboard'),
        'children': _.compact([
            AuthUtil.isSuperAdminisitrador() && {
                'label': 'Empresas',
                'href': route('empresa.index')
            },
            AuthUtil.isSuperAdminisitrador() && {
                'label': 'Usuários',
                'href': route('user.index')
            },
            AuthUtil.isSuperAdminisitrador() && {
                'label': 'Motivos de Paradas',
                'href': route('motivosdeparada.index')
            },
            {
                'label': 'Departamentos',
                'href': route('departamentos.index')
            },
        ])
    },
    {
        'label': 'Produção',
        'href': route('dashboard'),
        'children': [
            {
                'label': 'Estações de Trabalho',
                'href': route('empresa.index')
            },
            {
                'label': 'Maquinário',
                'href': route('empresa.index')
            },
            {
                'label': 'Produtos',
                'href': route('empresa.index')
            },
            {
                'label': 'Ordens de Produção',
                'href': route('empresa.index')
            },
        ]
    },
    {
        'label': 'Custos',
        'href': route('dashboard')
    },
    {
        'label': 'Vendas',
        'href': route('dashboard')
    },
    {
        'label': 'Cargas',
        'href': route('dashboard')
    }
])

const toggleMobileMenu = () => {
    alert("OPA");
}

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <BaseLayout>
        <nav class="bg-blue-500 text-white border-gray-200 absolute w-full top-0">
            <div class="flex flex-wrap items-center mx-auto px-4 py-2.5 h-16">
                <a :href="route('dashboard')" class="flex items-center mr-auto">
                    <span class="self-center text-xl font-extrabold whitespace-nowrap">AGOSTINI</span>
                </a>
                <div class="hidden sm:inline-flex flex items-center border-r border-white pr-4 mr-4 gap-2">
                    <template v-for="(menu, menu_index) in menus" :key="menu_index">
                        <Button v-if="!menu.children?.length" size="xs" class="uppercase font-bold" :to="menu.href">{{ menu.label }}</Button>
                        <Menu v-else>
                            <MenuButton class="uppercase font-bold">
                                <Button size="xs">{{ menu.label }}</Button>
                            </MenuButton>
                            <MenuItems class="absolute top-16 left-0 w-full min-h-full bg-blue-500 grid grid-cols-8 gap-4 p-2 pt-2 z-50">
                                <MenuItem v-for="(submenu, submenu_index) in menu.children" :key="submenu_index" as="template" v-slot="{ active }">
                                    <Button flat outlined size="xs" :label="submenu.label" :to="submenu.href"/>
                                </MenuItem>
                            </MenuItems>
                        </Menu>
                    </template>
                </div>
                <div>
                    <Menu>
                        <MenuButton class="flex items-center justify-center">
                            <div class="flex items-center justify-center">
                                <div class="hidden sm:inline flex-col">
                                    <div class="text-xs uppercase font-bold text-right text-gray-50">{{ $page.props.user.name }}</div>
                                    <div class="text-xs text-right text-gray-50">{{ $page.props.user.email }}</div>
                                </div>
                                <img class="ml-2 w-10 h-10 rounded-full" :src="$page.props.user.profile_photo_url" alt="Rounded avatar">
                            </div>
                        </MenuButton>
                        <MenuItems class="absolute top-16 right-0 bg-blue-500 p-2 pt-0 w-full sm:w-52 flex flex-col rounded-b-lg z-50">
                            <div class="sm:hidden flex flex-col">
                            <template v-for="(menu, menu_index) in menus" :key="menu_index">
                                <Button size="xs" v-if="!menu.children?.length" class="uppercase font-bold" :to="menu.href">{{ menu.label }}</Button>
                                <Menu v-else>
                                    <MenuButton class="px-2 uppercase font-bold">
                                        <Button size="xs" class=" w-full">{{ menu.label }}</Button>
                                    </MenuButton>
                                    <MenuItems class="w-full grid grid-cols-2 py-2 px-3 text-center">
                                        <MenuItem v-for="(submenu, submenu_index) in menu.children" :key="submenu_index" as="div" v-slot="{ active }">
<!--                                            <Button size="xs" flat outlined :label="submenu.label" :to="submenu.href"/>-->
                                            <div class="w-full flex p-1">
                                                <a :href="submenu.href" class=" flex-grow rounded-lg focus:outline-none uppercase font-bold text-center bg-white border-2 border-blue-500 text-blue-500 text-xs p-1">{{ submenu.label }}</a>
                                            </div>
                                        </MenuItem>
                                    </MenuItems>
                                </Menu>
                            </template>
                            </div>

                            <hr class="sm:hidden my-1 border-white "/>
                            <MenuItem v-slot="{ active }">
                                <Button size="xs" @click="logout">
                                    Sair
                                </Button>
                            </MenuItem>
                        </MenuItems>
                    </Menu>
                </div>
            </div>
        </nav>

        <main class="min-h-screen pt-16">
            <slot/>
        </main>
    </BaseLayout>
</template>
