<template>
  <template v-if="onNavigate">
    <Link :href="$route(onNavigate())" :class="btnClass">
      <IconVue v-if="icon != null" :icon="icon" class="mr-2" />
      {{ label }}
    </Link>
  </template>
  <template v-else>
    <button type="button" :class="btnClass">
      <IconVue v-if="icon != null" :icon="icon" class="mr-2" />
      {{ label }}
    </button>
  </template>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import IconVue from './Icon.vue'

const $route = route;

const emit = defineEmits([
  'onNavigate'
])

const props = defineProps({
  label: String,
  icon: String,
  primary: String,
  secondary: String,
  dark: String,
  light: String,
  positive: String,
  negative: String,
  onNavigate: Function
})

const calculateTextColor = () => {
  return props.light == null ? { 'text-white': true } : { 'text-gray-600': true }
}

const calculateBackgroundColor = () => {
  if (props.secondary != null) {
    return {
      'bg-amber-500': true,
      'hover:bg-amber-700': true
    }
  }
  if (props.dark != null) {
    return {
      'bg-gray-600': true,
      'hover:bg-gray-900': true
    }
  }
  if (props.light != null) {
    return {
      'bg-white': true,
      'border': true,
      'border-gray-300': true,
      'hover:bg-gray-100': true
    }
  }
  if (props.positive != null) {
    return {
      'bg-green-500': true,
      'hover:bg-green-700': true
    }
  }
  if (props.negative != null) {
    return {
      'bg-red-500': true,
      'hover:bg-red-700': true
    }
  }
  return {
    'bg-blue-500': true,
    'hover:bg-blue-700': true
  }
}

const btnClass = {
  'w-full': true,
  'uppercase': true,
  'font-bold': true,
  'rounded-lg': true,
  'text-sm': true,
  'px-5': true,
  'py-2.5': true,
  'text-center': true,
  'inline-flex': true,
  'justify-center': true,
  'items-center': true,
  ...calculateTextColor(),
  ...calculateBackgroundColor()

  // bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800
}
</script>
