<template>
    <BaseLayout>
        <div class="absolute top-48 w-full">
            <Card class="shadow-md w-80 mx-auto">
                <template v-slot:header>
                    <div class="text-xl font-bold uppercase text-gray-500 text-center py-2">Acesso Controlado</div>
                </template>
                <div class="grid grid-cols-1 gap-2">
                    <InputText label="Usuário ou Email" v-model="form.email"/>
                    <InputText type="password" label="Senha" v-model="form.password"/>
                </div>
                <template v-slot:actions>
                    <Button label="Acessar" class="col-span-3" @click="submit()"/>
                    <!--<Button secondary label="Registrar" class="col-span-3" />-->
                </template>
            </Card>
        </div>
    </BaseLayout>
</template>
<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

import BaseLayout from "@/Layouts/BaseLayout.vue";

import Button from '@/Components/Button.vue';
import Card from "@/Components/Card.vue";
import InputText from "@/Components/InputText.vue";

const form = useForm({
    email: 'super-admin@agostinitecnologia.com.br',
    password: 'password',
});

const submit = () => {
    form.post(
        route('login'),
        {
            onFinish: () => {
                form.reset()
            }
        }
    );
};
</script>
