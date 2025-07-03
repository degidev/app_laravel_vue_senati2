<template>
    <Head title="chat yes no"/>

    <AppLayout :breadcrumbs="breadcrumbs" >
        <h1>Hola AMIGOS</h1>
        <div>
            <button 
                type="button" 
                class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                v-on:click="hacerPeticionApiYesNo()"    
            >Purple</button>

            <p> {{ yesno.answer }}</p>

            <img class="h-auto max-w-lg rounded-lg" 
            :src="yesno.image" 
            alt="image description">
        </div>
        

    </AppLayout>   

</template>

<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { type BreadcrumbItem } from '@/types';
    import { ref } from 'vue';

    const yesno = ref({});

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Aplicaciones',
            href: '/aplicaciones',
        },
        {
            title: 'Yes No',
            href: '/aplicaciones/yesno',
        },
    ];


    async function hacerPeticionApiYesNo(){
        const respuesta = await fetch('https://yesno.wtf/api')
        const data = await respuesta.json();
        yesno.value = data;
        console.log(data)
    }

</script>

<style scoped>

</style>