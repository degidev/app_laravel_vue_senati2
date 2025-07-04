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
                    <!-- Dropdown de selección de usuario -->
                    <div class="mb-2">
                        <label for="user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Usuario (Select)</label>
                        <select 
                            id="user-select" 
                            v-model="form.usuario" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option selected value="">Seleccionar usuario</option>
                            <option v-for="usuario in usuarios" :key="usuario.id_usuario" :value="usuario.id_usuario">
                                {{ usuario.name }}
                            </option>
                        </select>
                        <span v-if="form.errors.usuario" class="text-red-500 text-xs mt-1">
                            {{ form.errors.usuario }}
                        </span>
                    </div>
                    <!-- Autocomplete de usuario -->
                    <div class="mb-2">
                        <label for="user-autocomplete" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Usuario (Autocomplete)</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="user-autocomplete" 
                                v-model="searchQuery"
                                @input="handleSearchInput"
                                @focus="showSuggestions = true"
                                placeholder="Buscar usuario..."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                            <!-- Lista de sugerencias -->
                            <div 
                                v-if="showSuggestions && filteredUsers.length > 0" 
                                class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto dark:bg-gray-700 dark:border-gray-600"
                            >
                                <ul>
                                    <li 
                                        v-for="user in filteredUsers" 
                                        :key="user.id_usuario"
                                        @click="selectUser(user)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                    >
                                        {{ user.name }} ({{ user.email }})
                                    </li>
                                </ul>
                            </div>
                            <div v-if="showSuggestions && isLoading" class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 p-4 dark:bg-gray-700 dark:border-gray-600">
                                <div class="flex items-center justify-center">
                                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-500"></div>
                                    <span class="ml-2">Buscando...</span>
                                </div>
                            </div>
                            <div v-else-if="showSuggestions && filteredUsers.length === 0 && searchQuery" class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 p-4 dark:bg-gray-700 dark:border-gray-600">
                                No se encontraron usuarios
                            </div>
                        </div>
                        <span v-if="form.errors.usuario" class="text-red-500 text-xs mt-1">
                            {{ form.errors.usuario }}
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
                    <button 
                        type="button" 
                        v-on:click="probar"
                        class="text-white bg-blue-500 hover:bg-blue-700 
                            font-bold rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                    >PROBAR</button>
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
    import { Head, useForm, router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
    import { type BreadcrumbItem } from '@/types';
    import { defineProps, watch, ref, computed } from 'vue';
    import axios from 'axios';
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
        usuario: '',
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
        estudiante: Object as () => ({
            nombre: string,
            institucion: string
        }),
        users: Array as () => Array<{id: number, name: string, email: string}>,
        searchQuery: String,
        llaves: Array as () => Llaves[],
        flash: Object as () => ({
            success?: string,
            error?: string
        }),
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
    
    interface Usuario {
        id_usuario: number,
        name: string,
        email: string,
    }
    
    // Estado para el select y el autocomplete
    const usuarios = ref<Usuario[]>([]); // Para el select
    const searchQuery = ref('');
    const filteredUsers = ref<Usuario[]>([]); // Para el autocomplete
    const showSuggestions = ref(false);
    const selectedUser = ref<Usuario | null>(null);
    const isLoading = ref(false);
    let debounceTimeout: ReturnType<typeof setTimeout> | null = null;
    
    // Cargar usuarios para el select al iniciar el componente
    onMounted(() => {
        fetchAllUsers();
    });
    
    // Función para cargar todos los usuarios (para el select)
    async function fetchAllUsers() {
        try {
            const response = await axios.get(route('api.users'));
            
            if (response.data && Array.isArray(response.data)) {
                usuarios.value = response.data.map((user: {id: number, name: string, email: string}) => ({
                    id_usuario: user.id,
                    name: user.name,
                    email: user.email
                }));
            }
        } catch (error) {
            console.error('Error al cargar usuarios:', error);
            usuarios.value = [];
        }
    }
    
    // Función para buscar usuarios según el texto ingresado (para el autocomplete)
    async function searchUsers(query: string) {
        if (!query || query.length < 2) {
            filteredUsers.value = [];
            isLoading.value = false;
            return;
        }
        
        try {
            isLoading.value = true;
            
            const response = await axios.get(route('api.users.search'), {
                params: { query }
            });
            
            if (response.data && Array.isArray(response.data)) {
                filteredUsers.value = response.data.map((user: {id: number, name: string, email: string}) => ({
                    id_usuario: user.id,
                    name: user.name,
                    email: user.email
                }));
            }
        } catch (error) {
            console.error('Error al buscar usuarios:', error);
            filteredUsers.value = [];
        } finally {
            isLoading.value = false;
        }
    }
    
    // Ya no necesitamos filtrar localmente, siempre haremos peticiones al servidor para el autocomplete
    
    // Función para manejar la entrada del usuario con debounce
    function handleSearchInput() {
        // Cancelar el timeout anterior si existe
        if (debounceTimeout) {
            clearTimeout(debounceTimeout);
        }
        
        // Si la búsqueda es muy corta, no hacemos petición
        if (!searchQuery.value || searchQuery.value.length < 2) {
            filteredUsers.value = [];
            isLoading.value = false;
            return;
        }
        
        // Mostrar indicador de carga
        isLoading.value = true;
        
        // Programamos la petición al servidor después de un delay
        debounceTimeout = setTimeout(() => {
            // Usar la función searchUsers con el query actual
            searchUsers(searchQuery.value);
        }, 300); // 300ms de debounce
    }
    
    // Función para seleccionar un usuario desde el autocomplete
    function selectUser(user: Usuario) {
        // Ya no afectamos al select (form.usuario)
        searchQuery.value = user.name;
        showSuggestions.value = false;
    }
    
    // Ya no sincronizamos el select con el autocomplete
    // Los dos componentes son completamente independientes
    
    // Función para probar y mostrar los datos en consola
    function probar() {
        console.log('--- DATOS DEL FORMULARIO ---');
        console.log('ID Llave:', form.id_llave);
        console.log('Código:', form.codigo);
        console.log('Disponible:', form.disponible);
        console.log('Estado:', form.estado);
        console.log('Orden:', form.orden);
        
        console.log('\n--- DATOS DEL SELECT ---');
        console.log('Usuario seleccionado (ID):', form.usuario);
        const usuarioSelect = usuarios.value.find(u => u.id_usuario.toString() === form.usuario);
        console.log('Datos del usuario seleccionado:', usuarioSelect || 'Ninguno');
        
        console.log('\n--- DATOS DEL AUTOCOMPLETADO ---');
        console.log('Texto de búsqueda:', searchQuery.value);
        // Buscar el usuario que coincida con el texto de búsqueda
        const usuarioAutocompletado = filteredUsers.value.find(u => u.name === searchQuery.value);
        console.log('ID del usuario seleccionado en autocompletado:', usuarioAutocompletado ? usuarioAutocompletado.id_usuario : 'Ninguno');
        console.log('Datos del usuario en autocompletado:', usuarioAutocompletado || 'Ninguno');
        console.log('Resultados filtrados:', filteredUsers.value);
    }
    
    // Cerrar sugerencias al hacer clic fuera del componente
    document.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        if (!target.closest('#user-autocomplete')) {
            showSuggestions.value = false;
        }
    });


</script>

<style scoped>

</style>