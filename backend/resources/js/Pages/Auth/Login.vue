<template>
    <div class="h-screen flex justify-center items-start pt-48">
        <div class="w-80">
            <!-- <CardVue class="col-span-2 grid grid-cols-1 gap-1">
                <InputTextVue v-model="form.username_or_email" label="Usuário ou email" placeholder="usuario@empresa.com.br" required/>
                <InputPasswordVue v-model="form.password" label="Senha" placeholder="SuaSenha" required/>
                <ButtonVue primary label="Entrar" @navigate="'dashboard.index'"/>
                <ButtonVue secondary label="Registrar-se" @navigate="'auth.register'" />
                <ButtonVue light label="Recuperar Senha" @navigate="'auth.recovery'" />
            </CardVue> -->
        </div>
    </div>
</template>
<script setup>
// import ButtonVue from './../../Components/Button.vue'
// import CardVue from './../../Components/Card.vue'
// import InputPasswordVue from '../../Components/InputPassword.vue';
// import InputTextVue from '../../Components/InputText.vue';
import { reactive } from 'vue';

const props = defineProps({
    canRegister: Boolean
})

const form = reactive({
    username_or_email: null,
    password: null
})
</script>