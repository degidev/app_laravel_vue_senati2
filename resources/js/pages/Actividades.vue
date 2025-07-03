<template>
    <Head title="Actividades"/>

    <AppLayout :breadcrumbs="breadcrumbs" >
        <h1>hola esto es actividades</h1>

        <section>
            <h1> Lista de actividades personas 🤡 </h1>
        </section>

        <section>
            <label for="actividad">Actividad:</label>
            <input 
                type="text" 
                placeholder="aqui ingresa un texto" 
                id="actividad" 
                v-model="nuevaActividad"
                >
            <button 
                type="button"
                v-on:click="agregarActividad()"
            >Agregar</button>
        </section>

        <section>
            <ul v-for="item in actividades" :key="item.nombre" >
                <li >
                    <span class="mr-2">
                        <input 
                            type="checkbox"
                            v-model="item.realizado" 
                            v-on:click="mostrarAlerta()"
                        >
                    </span>
                    <span class="mr-2">
                        {{ item.nombre }}
                    </span>
                    <span class="mr-2">
                        {{ item.hora }}
                    </span>
                </li>
            </ul>
        </section>

    </AppLayout>  
    
</template>

<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { type BreadcrumbItem } from '@/types';
    import { ref } from 'vue';
    import Swal from 'sweetalert2'

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Aplicaciones',
            href: '/aplicaciones',
        },
        {
            title: 'Actividades',
            href: '/aplicaciones/actividades',
        },
    ];

    const nuevaActividad = ref('');
    const actividades = ref([
        {
            nombre : "Cosinar desayuno",
            realizado: true,
            hora: ""
        },
        {
            nombre : "Cosinar Almuerzo",
            realizado: true, 
            hora : ""
        },
        {
            nombre : "Lavar Platos",
            realizado: false, 
            hora:"" 
        }
    ]);

    function agregarActividad(){

        if(nuevaActividad.value == ""){
            Swal.fire({
                title: "No se puede",
                text: "necesitas ingresar una actividad",
                icon: "error"
            });
            return;
        }

        console.log("ingreso aqui")

        actividades.value.push(
            {
               nombre: nuevaActividad.value,
               realizado:false,
               hora: new Date().toLocaleTimeString()
            }
        )

        console.log(actividades);
    }

    function mostrarAlerta(){
        Swal.fire({
            title: "Actividad Completada",
            text: "Completaste una actividad",
            icon: "success"
        });
    }
    

</script>

<style scoped>

</style>