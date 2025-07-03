<template>
    <Head title="Llaves"/>
    <AppLayout :breadcrumbs="breadcrumbs" >
        <section class="
            mx-5 md:mx-20
        ">
            <h1 class="text-center text-xl md:text-2xl font-bold">
                Bienvendido a la gestion de llaves
            </h1>

            <div class="flex justify-between">
                <p>{{ estudiante?.nombre }}</p>
                <p>{{ estudiante?.institucion }}</p>
            </div>
            <!-- <p>{{ llaves }}</p> -->

            <!-- formulario -->
             <form action="" class="mt-5">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Codigo llave</label>
                        <input 
                            type="text" 
                            id="default-input" 
                            v-model="form.codigo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <span v-if="form.errors.codigo" class="text-red-500 text-xs mt-1">
                                {{ form.errors.codigo }}
                            </span>
                    </div>
                    <div class="mb-3">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Disponible</label>
                        <input 
                            type="number" 
                            id="default-input" 
                            v-model="form.disponible"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <span v-if="form.errors.disponible" class="text-red-500 text-xs mt-1">
                                {{ form.errors.disponible }}
                            </span>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar estado</label>
                        <select id="estado" v-model="form.estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                            <span v-if="form.errors.estado" class="text-red-500 text-xs mt-1">
                                {{ form.errors.estado }}
                            </span>
                    </div>
                    


                    <div class="mb-2">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Orden</label>
                        <input 
                            type="number" 
                            id="default-input" 
                            v-model="form.orden"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <span v-if="form.errors.orden" class="text-red-500 text-xs mt-1">
                                {{ form.errors.orden }}
                            </span>
                    </div>
                </div>
                <div class="mt-3">
                    <button 
                        type="button" 
                        v-on:click="guardarDatos"
                        class="text-white bg-rose-500 hover:bg-rose-700 
                            font-bold rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                    > {{ esEditar ? 'EDITAR' : 'GUARDAR' }} </button>
                </div>
             </form>


            <div class="flex justify-end">
                <button type="button" 
                        class="text-white bg-rose-500 hover:bg-rose-700 
                            font-bold rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                        v-on:click="mostrarPdf()"
                >Exportar PDF</button>
            </div>
            <!-- tabla -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Codigo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Disponible
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Orden
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha registro
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Usuario registro
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Correo registro
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600" 
                        v-for="llave in llaves" :key="llave.id_llave">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ llave.codigo }}
                            </th>
                            <td class="px-6 py-4">
                                {{ llave.disponible }}
                            </td>
                            <td class="px-6 py-4">
                                <i v-if="llave.estado==1" class="bi text-green-500 bi-check-circle"></i>
                                <i v-else class="bi text-red-500 bi-x-circle"></i>
                            </td>
                            <td class="px-6 py-4">
                                {{ llave.orden }}
                            </td>
                            <td class="px-6 py-4">
                                {{ llave.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ llave.email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ llave.fecha_registra }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button 
                                type="button" 
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                v-on:click="editarLlaves(llave)"
                                >Editar</button>
                                <button 
                                type="button" 
                                v-on:click="elimiarDatos(llave.id_llave)"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                >Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>   
</template>

<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';
    import { type BreadcrumbItem } from '@/types';
    import { defineProps, watch, ref } from 'vue';
    import Swal from 'sweetalert2'

    const esEditar = ref(false);

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Configuración',
            href: '/configuracion',
        },
        {
            title: 'Llaves',
            href: '/configuracion/llaves',
        },
    ];

    const form = useForm({
        id_llave: null as number | null,
        codigo: '',
        disponible: '',
        estado: '',
        orden: '',
    });


    function guardarDatos(){
        const common = {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
            },
        }
        if(esEditar.value){
            form.put(route('configuracion.llave.update',form.id_llave),common);
        }else{
            form.post(route('configuracion.crear-llave'),common);
        }
    }

    function elimiarDatos(id_llave : number){
        const common = {
            preserveScroll: true,
        }
        form.delete(route('configuracion.eliminar-llave',id_llave),common);
    }

    function editarLlaves(llave : Llaves){
        console.log('editar llaves');
        console.log(llave);

        esEditar.value = true;

        form.id_llave = llave.id_llave;
        form.codigo = llave.codigo;
        form.disponible = llave.disponible.toString();
        form.estado = llave.estado.toString();
        form.orden = llave.orden.toString();
    }

    function mostrarPdf(){
        window.open(route('configuracion.llave-pdf'));
    }

    const props = defineProps({
        estudiante: Object as () =>{
            nombre: string,
            institucion: string,
        },
        llaves: Array as () => Llaves[],
        flash: Object as () =>{
            success?: string,
            error?: string,
        },
    });
    watch(
        () => props.flash,
        (newFlash) => {
            console.log(newFlash);
            if(newFlash?.success){
                Swal.fire({
                    title: "Operación exitosa",
                    text: newFlash?.success,
                    icon: "success"
                });
            }
            if(newFlash?.error){
                Swal.fire({
                    title: "Operación fallida",
                    text: newFlash?.error,
                    icon: "error"
                });
            }
        },
        {
            deep: true,
        }
    );
    interface Llaves{
        id_llave: number,
        codigo: string,
        disponible: number,
        estado: number,
        orden: number,
    }


</script>

<style scoped>

</style>