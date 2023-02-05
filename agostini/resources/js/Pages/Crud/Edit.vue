<template>
    <AppLayout>

        <div class="bg-gray-200 px-4 py-3 flex">
            <div class="mr-auto  text-lg uppercase font-bold flex items-center">
                {{ label }}
            </div>
            <div class="flex flex-row gap-2">
                <a :href="route(routeName + '.index')" type="button" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center">
                    <ArrowLeftCircleIcon class="w-5 h-5 mr-2 -ml-1"/>
                    <div class="flex items-center justify-center">Voltar</div>
                </a>
                <button @click="save()" type="button" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center">
                    <InboxArrowDownIcon class="w-5 h-5 mr-2 -ml-1"/>
                    <div class="flex items-center justify-center">Salvar</div>
                </button>
            </div>
        </div>

        <div class="p-4 grid grid-cols-12 gap-2">
            <template v-for="(column, column_index) in columns" :key="column_index" >
                <div class="col-span-2">
                    <template v-if="column.type == 'select'">
                        <InputSelect
                            :label="column.translate"
                            :options="column.options"
                            v-model="form[column.label]"
                            @update="setFormValue($event, column.label)"
                        />
                    </template>
                    <template v-if="column.type == 'password'">
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
        <pre>{{form}}</pre>
    </AppLayout>
</template>
<script setup>
import _ from 'lodash';
import { ref } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import { ArrowLeftCircleIcon, InboxArrowDownIcon  } from '@heroicons/vue/20/solid'
import InputText from "../../Components/InputText.vue";
import InputSelect from "../../Components/InputSelect.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    data: Array,
    columns: Array | Object,
    label: String,
    routeName: String
})

const form = useForm((props.columns.length ? props.columns : [props.columns]).reduce(
    (older, newer) => {
        const key = Object.keys(Object.values(newer)[0]);
        const opt = Object.values(newer)[0];
        const value = props.data ? props.data[0][key] : '';
        older[key] = ref(value)
        return older;
    }, {}
));

const setFormValue = (value, column) => {
    form[column] = value
}

const save = () => {
    console.log(Inertia.post(route(props.routeName + '.store'), form));
}
</script>
