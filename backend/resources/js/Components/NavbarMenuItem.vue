<template>
    <li>
        <Link v-if="!menu?.children?.length" :href="route(menu.href)"
            class="flex items-center justify-center h-16 px-2 border-b-4 border-transparent"
            :class="{ 'border-white': route().current(menu.href) }">
            {{ menu.label }}
        </Link>

        <div v-else class="flex cursor-pointer items-center justify-center h-16 px-2 border-b-4 border-transparent"
             @click="toggleMenu(menu)">
            {{ menu.label }}
        </div>

        <div v-if="isOpened" class="absolute top-16 left-0 p-4 w-full bg-indigo-500">
            <div class="grid grid-cols-3 gap-4 mx-auto text-gray-900">
                <div v-for="(submenu, subindex) in menu.children" :key="subindex">
                    <Link :href="submenu.href ? route(submenu.href) : '#'" class="bg-neutral-50 block p-4 rounded-lg hover:bg-neutral-100">
                        <div class="font-semibold">
                            {{ submenu.label }}
                        </div>
                        <span class="text-sm font-light text-gray-500 dark:text-gray-400">
                            {{ submenu.caption }}
                        </span>
                    </Link>
                </div>
            </div>
        </div>
    </li>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const emit = defineEmits(['change'])

const props = defineProps({
    menu: Object
})

const isOpened = ref(props.menu.opened && props.menu.children)

const toggleMenu = (menu) => {
    isOpened.value = !isOpened.value
    emit('change', menu)
}
</script>