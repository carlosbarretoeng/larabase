<template>
    <div class="h-screen flex justify-center items-center">
        <div class="w-80">
            <CardVue class="col-span-2 grid grid-cols-1 gap-1">
                <ButtonVue primary label="Entrar"/>
                <ButtonVue light label="Recuperar Senha" @navigate="'auth.recovery'" />
            </CardVue>
        </div>
    </div>
</template>
<script setup>
import ButtonVue from './../../Components/Button.vue'
import CardVue from './../../Components/Card.vue'

const alert = (txt) => window.alert(txt)
</script>