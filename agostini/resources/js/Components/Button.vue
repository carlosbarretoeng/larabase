<template>
    <a v-if="to" :href="to" :class="calculatedClass">{{ label }}<slot/></a>
    <button v-else :class="calculatedClass">{{ label }}<slot/></button>
</template>

<script setup>
const calculateBackgroundColor = () => {
    return {
        'bg-blue-500': !props.outlined, // true,
        'bg-white': props.outlined,
        'border-2': true,
        'border-blue-500': true,
        'hover:bg-blue-600': !!!props.flat
    };
}

const calculateTextColor = () => {
    return {
        'text-blue-500': props.outlined,
        'hover:text-gray-400': props.outlined,
        'text-white': !props.outlined,
    }
}

const calculateTextSize = () => {
    switch (props.size){
        case 'xs':
            return {
                'text-xs': true,
                'p-1': true
            }
        default:
            return {
                'text-md': true,
                'p-2': true
            }
    }
}

const props = defineProps({
    label: String,
    to: String,
    secondary: Boolean,
    flat: Boolean,
    outlined: Boolean,
    size: String,
})

const calculatedClass= {
    'rounded-lg focus:outline-none uppercase font-bold flex items-center justify-center text-center': true,
    ...calculateBackgroundColor(),
    ...calculateTextColor(),
    ...calculateTextSize()
}
</script>

<style scoped>

</style>
