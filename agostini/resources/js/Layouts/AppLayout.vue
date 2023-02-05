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
    AuthUtil.isSuperAdminisitrador() && {
        'label': 'Sistema',
        'href': route('dashboard'),
        'children': [
            {
                'label': 'Empresas',
                'href': route('empresa.index')
            },
            {
                'label': 'Usuários',
                'href': route('user.index')
            },
        ]
    },
    {
        'label': 'Produção',
        'href': route('dashboard'),
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
                        <Button v-if="!menu.children?.length" class="uppercase font-bold" :to="menu.href">{{ menu.label }}</Button>
                        <Menu v-else>
                            <MenuButton class="uppercase font-bold">
                                <Button>{{ menu.label }}</Button>
                            </MenuButton>
                            <MenuItems class="absolute top-16 left-0 w-full bg-blue-500 grid grid-cols-5 gap-4 p-2 pt-2 z-50">
                                <MenuItem v-for="(submenu, submenu_index) in menu.children" :key="submenu_index" as="template" v-slot="{ active }">
                                    <Button flat outlined :label="submenu.label" :to="submenu.href"/>
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
                                    <MenuItems class="w-full grid grid-cols-1 gap-4 p-2">
                                        <MenuItem v-for="(submenu, submenu_index) in menu.children" :key="submenu_index" as="template" v-slot="{ active }">
                                            <Button size="xs" flat outlined :label="submenu.label" :to="submenu.href"/>
                                        </MenuItem>
                                    </MenuItems>
                                </Menu>
                            </template>
                            </div>

                            <hr class="sm:hidden my-1 border-white "/>
                            <MenuItem v-slot="{ active }">
                                <Button size="xs" @click="logout">
                                    Meu Perfil
                                </Button>
                            </MenuItem>
                            <hr class="my-1 border-white "/>
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
