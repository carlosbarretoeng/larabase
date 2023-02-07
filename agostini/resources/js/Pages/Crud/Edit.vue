<template>
    <AppLayout>

        <div class="bg-gray-200 px-4 py-3 flex">
            <div class="mr-auto  text-lg uppercase font-bold flex items-center">
                {{ label }}
            </div>
            <div class="flex flex-row gap-2">
                <a :href="route(routeName + '.index')" type="button"
                   class="text-white min-w-[60px] bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center">
                    <ArrowLeftCircleIcon class="w-5 h-5 sm:mr-2 sm:-ml-1"/>
                    <div class="hidden sm:inline-flex flex items-center justify-center">Voltar</div>
                </a>
                <button @click="save()" type="button"
                        class="text-white min-w-[60px] bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center">
                    <InboxArrowDownIcon class="w-5 h-5 sm:mr-2 sm:-ml-1"/>
                    <div class="hidden sm:inline-flex flex items-center justify-center">Salvar</div>
                </button>
            </div>
        </div>

        <div class="p-4 grid grid-cols-2 sm:grid-cols-12 gap-2">
            <template v-for="(column, column_index) in columns" :key="column_index">
                <div class="col-span-2">
                    <template v-if="column.type == 'select'">
                        <InputSelect
                            :label="column.translate"
                            :options="column.options"
                            v-model="form[column.label]"
                            @update="setFormValue($event, column.label)"
                        />
                    </template>
                    <template v-else-if="column.type == 'password'">
                        <InputText
                            type="password"
                            :label="column.translate"
                            v-model="form[column.label]"
                        />
                    </template>
                    <template v-else>
                        <InputText
                            :label="column.translate"
                            v-model="form[column.label]"
                        />
                    </template>
                </div>
            </template>
        </div>
    </AppLayout>
</template>
<script setup>
import {ref} from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import {ArrowLeftCircleIcon, InboxArrowDownIcon} from '@heroicons/vue/20/solid'
import InputText from "../../Components/InputText.vue";
import InputSelect from "../../Components/InputSelect.vue";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    data: Array,
    columns: Array | Object,
    label: String,
    routeName: String
})

const form = useForm(Object.keys(props.columns).map((el, el_idx, el_arr) => {
    let obj = {};
    let value = props.data ? (props.data[0][el] ?? null) : null;

    if(Array.isArray(value)) value = value.pop();
    if(typeof value === 'object' && value !== null) value = {id: value.id, name: value.name};
    // if(value?.id !== undefined && value?.name !== undefined) value = {id: value.id, name: value.name}

    obj[el] = ref(value);
    return obj
}).reduce((older, newer) => ({...older, ...newer}), {}) ?? {});

const setFormValue = (value, column) => {
    form[column] = value
}

const save = () => {
    const page = (usePage()).url.value.split('/');
    if(page[page.length - 1] === 'create'){
        Inertia.post(
            route(props.routeName + '.store'),
            form,
            {
                onFinish: visit => {
                    console.log(visit.data)
                },
            }
        );
    }else {
        Inertia.put(
            route(props.routeName + '.update', props.data[0].id),
            form,
            {
                onFinish: visit => {
                    console.log(visit.data)
                },
            }
        );
    }
}
</script>
