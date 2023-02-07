<template>
    <AppLayout>

        <div class="bg-gray-200 px-4 py-3 flex">
            <div class="mr-auto  text-lg uppercase font-bold flex items-center">
                {{ label }}
            </div>
            <div class="flex flex-row">
                <a :href="route(routeName + '.create')" type="button" class="text-white min-w-[60px] bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center">
                    <PlusCircleIcon  class="w-5 h-5 sm:mr-2 sm:-ml-1"/>
                    <div class="hidden sm:inline-flex flex items-center justify-center">Adicionar</div>
                </a>
            </div>
        </div>

        <div class="overflow-auto">
            <table class="text-left text-sm w-full">
                <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class=" border-r">
                        &nbsp;
                    </th>
                    <th v-for="(column, column_index) in columns" :key="column_index" scope="col" :style="calculateColumnStyle(column)" class="px-6 py-3 border-r">
                        {{ column['translate'] ?? column['label'] }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(datum, datum_index) in data" :key="datum_index" class="bg-white border-b">
                    <td class="w-1 p-2 border-r">
                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <a :href="route(routeName + '.edit', datum['id'])" type="button" class="px-2 py-1 w-10 inline-flex items-center text-sm bg-transparent border rounded-l-lg hover:bg-blue-500 hover:text-white">
                                <PencilSquareIcon class="w-full h-full"/>
                            </a>
                            <button type="button" @click="openModal(datum)" class="px-2 w-10 inline-flex items-center text-sm bg-transparent border rounded-r-lg hover:bg-red-500 hover:text-white">
                                <ArchiveBoxXMarkIcon class="w-full h-full"/>
                            </button>
                        </div>
                    </td>
                    <td v-for="(column, column_index) in columns" :key="column_index"  :style="calculateColumnStyle(column)" class="py-3 px-2 border-r">
                        <div v-if="Array.isArray(formatData(datum, column))">
                            <div v-for="(formatedData, formatedData_index) in formatData(datum, column)" :key="formatedData_index">
                                {{ formatedData }}
                            </div>
                        </div>
                        <div v-else>
                            {{ formatData(datum, column) }}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <nav class="px-4 flex items-center justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500">Mostrando <span class="font-semibold text-gray-900">{{ from }}-{{ to }}</span> de <span class="font-semibold text-gray-900">{{ total }}</span></span>
            <ul class="inline-flex items-center -space-x-px">
                <li>
                    <a :href="prev_page_url" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </li>
                <li>
                    <a :href="next_page_url" class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Next</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </li>
            </ul>
        </nav>

        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-bold leading-6 text-gray-900"
                                >
                                    Remover <span class="capitalize">{{ label }}</span> - #{{ deleteUserId }}
                                </DialogTitle>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Você realmente quer excluir esse registro? <span class="font-bold underline">Essa modificação não podera ser revertida</span>
                                        e implicará em mudanças em todo o sistema.
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <div class="grid grid-cols-2 gap-2">
                                        <Button @click="closeModal">
                                            Cancelar
                                        </button>
                                        <Button @click="deleteUser">
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </AppLayout>
</template>
<script setup>
import {ref} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import { PencilSquareIcon, ArchiveBoxXMarkIcon, PlusCircleIcon } from '@heroicons/vue/20/solid'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle
} from '@headlessui/vue'
import {Inertia} from "@inertiajs/inertia";

const isOpen = ref(false)

const deleteUserId = ref(null)

function closeModal() {
    isOpen.value = false
}
function openModal(user) {
    deleteUserId.value = user.id
    isOpen.value = true
}

function deleteUser() {
    Inertia.delete(
        route(props.routeName + '.destroy', deleteUserId.value),
        {
            onFinish: () => {
                closeModal();
            }
        }
    )
}

function calculateColumnStyle(column) {
    let columnClass = {}
    if(column['showInIndex']['width']){
        columnClass['width'] = column['showInIndex']['width'];
    }
    switch(column['type']){
        case 'integer':
            columnClass['textAlign'] = 'center';
            break;
        default:
    }
    return columnClass;
}

function formatData(datum, column){
    if(column.format !== undefined){
        const fn = eval(column.format);
        return fn(datum[column.label] ?? '---')
    }
    return datum[column.label] ?? '---'
}

const props = defineProps({
    data: Array,
    from: Number,
    to: Number,
    total: Number,
    next_page_url: String,
    prev_page_url: String,
    columns: Array | Object,
    label: String,
    routeName: String
})
</script>
