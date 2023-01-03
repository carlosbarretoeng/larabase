<template>
    <div class="p-4">
        <nav class="bg-neutral-100 border border-neutral-200 px-2 py-2 mb-4 rounded-lg">
            <div class="container flex flex-wrap items-center justify-between mx-auto h-10">
                <Link :href="route('dashboard.index')" class="flex items-center">
                <img v-if="$page.props.appLogo" src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-9"
                    alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ $page.props.appName }}</span>
                </Link>
            </div>
        </nav>
        <main class="grid grid-cols-1 sm:grid-cols-12 gap-4">
            <aside class="hidden sm:inline-flex sm:col-span-2 flex flex-col gap-4">
                <ul class="w-full font-medium text-gray-900 bg-neutral-100 border border-neutral-200 px-2 py-2 rounded-lg">
                    <!-- <li class="py-2 px-2 w-full border-b border-gray-200"> -->
                    <li class="py-2 px-2">
                        <Link :href="route('dashboard.index')" class=" flex items-center">
                            <IconVue icon="home" class="mr-2"/>
                            Início
                        </Link>
                    </li>
                    <!-- <li class="py-2 px-4 w-full border-b border-gray-200">Settings</li>
                    <li class="py-2 px-4 w-full border-b border-gray-200">Messages</li>
                    <li class="py-2 px-4 w-full ">Download</li> -->
                </ul>
                <ul class="w-full font-medium text-gray-900 bg-neutral-100 border border-neutral-200 px-2 py-2 rounded-lg">
                    <!-- <li class="py-2 px-2 w-full border-b border-gray-200"> -->
                    <li class="py-2 px-2">
                        <Link :href="route('dashboard.index')" class=" flex items-center">
                            <IconVue icon="home" class="mr-2"/>
                            Início
                        </Link>
                    </li>
                    <!-- <li class="py-2 px-4 w-full border-b border-gray-200">Settings</li>
                    <li class="py-2 px-4 w-full border-b border-gray-200">Messages</li>
                    <li class="py-2 px-4 w-full ">Download</li> -->
                </ul>
            </aside>
            <div class="sm:col-span-10">
                <slot />
            </div>
        </main>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import IconVue from '../Components/Icon.vue';
</script>