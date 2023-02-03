<template>
    <div>
        <label
            :for="id"
            class="block mb-2 text-xs font-medium text-gray-900 uppercase"
        >
            {{ label }}
        </label>
        <div class="relative">
            <Combobox v-model="selected" @update:model-value="updateValue($event)">
                <div class="relative mt-1">
                    <div class="">
                        <ComboboxInput
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            :displayValue="(person) => person?.name ?? ''"
                            @change="updateValue"
                        />
                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                        </ComboboxButton>
                    </div>
                    <TransitionRoot
                        leave="transition ease-in duration-100"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                        @after-leave="query = ''"
                    >
                        <ComboboxOptions class="absolute mt-1 max-h-60 w-full overflow-auto rounded-lg bg-gray-50 shadow-md ring-1 ring-black ring-opacity-5 focus:outline-none text-sm">
                            <div v-if="filteredPeople.length === 0 && query !== ''" class="relative cursor-default select-none py-2 px-4">
                                Não Localizado
                            </div>

                            <ComboboxOption
                                v-for="person in filteredPeople"
                                as="template"
                                :key="person.id"
                                :value="person"
                                v-slot="{ selected, active }"
                            >
                                <li class="relative cursor-default select-none p-2" :class="{'bg-blue-500 text-white': active}">
                                    <span
                                        class="block truncate"
                                        :class="{ 'font-medium': selected, 'font-normal': !selected }"
                                    >
                                      {{ person.name }}
                                    </span>
                                </li>
                            </ComboboxOption>
                        </ComboboxOptions>
                    </TransitionRoot>
                </div>
            </Combobox>
        </div>
    </div>
</template>

<script setup>
import {uuid} from 'vue-uuid';
import {computed, ref, watch} from 'vue'
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from '@headlessui/vue'
import {ChevronUpDownIcon} from '@heroicons/vue/20/solid'

const id = uuid.v1();

const props = defineProps({
    label: String,
    placeholder: String,
    required: Boolean,
    modelValue: Object,
    options: Array,
    type: {
        type: String,
        default: 'text'
    }
});

let selected = ref(null)
let query = ref('')

let filteredPeople = computed(() => {
    return query.value === ''
        ? props.options
        : props.options.filter((person) => person.name
            .toLowerCase()
            .replace(/\s+/g, '')
            .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
    }
)

const emit = defineEmits(['update:modelValue'])

const updateValue = (event) => {
    emit('update', event)
}
</script>

<style scoped>

</style>
