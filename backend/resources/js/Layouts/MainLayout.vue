<template>
    <nav class="bg-indigo-500 z-50 text-white fixed w-full">
        <div class="flex flex-wrap justify-between items-center mx-auto h-16">
            <Link :href="route('dashboard.index')" class="flex items-center">
            <span class="self-center text-3xl pl-4 font-extrabold whitespace-nowrap">
                {{ $page.props.appName }}
            </span>
            </Link>
            <div class="flex">
                <NavbarMenuVue class="hidden sm:inline-flex" />
                <div class="hidden sm:inline-flex flex items-center space-x-4 ml-4 px-4 cursor-pointer hover:bg-indigo-600">
                    <div class="font-medium text-sm text-right">
                        <div>Carlos R. B. Júnior</div>
                        <div class="text-sm text-gray-300">carlosbarreto.eng@gmail.com</div>
                    </div>
                    <img class="w-10 h-10 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="">
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-20 px-4 pb-4">
        <slot />
    </main>

</template>
<script setup>
import NavbarMenuVue from '../Components/NavbarMenu.vue'
import { Link } from '@inertiajs/inertia-vue3';

</script>