<template>
    <app-layout title="Dashboard">

        <header>
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <el-row>
                    <el-col :span="12">

                        <form @submit.prevent="searchSubmit">

                            <div class="grid-content bg-purple">



                                <el-input type="search" placeholder="Pesquisar Contratos" v-model="pesquisaData">
                                    <template #prefix>
                                        <i class="el-input__icon el-icon-search"></i>
                                    </template>
                                </el-input>
                            </div>
                        </form>
                    </el-col>
                    <el-col :span="12">
                        <div class="grid-content bg-purple-light float-right">



                            <inertia-link :href="route('contratos.create')" >
                                <jet-button class="ml-2">
                                    Novo Contrato
                                </jet-button>
                            </inertia-link>

                        </div>
                    </el-col>
                </el-row>
            </div>
        </header>

        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th @click="orderBySubmit('id')" style="cursor: pointer" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                <DirecaoSet title="ID" :direcao="direcaoData" :order-by="orderByData" coluna="id"/>
                                            </th>
                                            <th @click="orderBySubmit('nome')" style="cursor: pointer" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                <DirecaoSet title="Contratante" :direcao="direcaoData" :order-by="orderByData" coluna="nome"/>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Propriedade
                                            </th>
                                            <th @click="orderBySubmit('created_at')" style="cursor: pointer" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                <DirecaoSet title="Criado em" :direcao="direcaoData" :order-by="orderByData" coluna="created_at"/>
                                            </th>

                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        <tr v-for="row in contratos.data" :key="row.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{row.id}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">

                                                        <div class="text-sm text-gray-500">
                                                            {{ row.nome }}<br/>
                                                            {{ row.email }}<br/>
                                                            {{ row.documento }}

                                                        </div>

                                                </div>
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div v-if="row.propriedade">
                                                    <div class="text-sm text-gray-900">{{row.propriedade.bairro}}, {{ row.propriedade.endereco }}, {{row.propriedade.numero}}</div>
                                                    <div class="text-sm text-gray-500">
                                                        {{row.propriedade.estado}} - {{row.propriedade.cidade}} <br/>
                                                        {{row.propriedade.email_proprietario}}
                                                    </div>

                                                    <el-tag type="info" size="small" effect="dark">

                                                        {{row.propriedade.tipo}}
                                                    </el-tag>
                                                </div>


                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{row.user.email}} <br/>
                                                {{row.created_at}}


                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#" @click.prevent="deletar(row)" class="text-indigo-600 hover:text-indigo-900">Excluir</a>
                                            </td>
                                        </tr>

                                        <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>




                        </div>



                    </div>



                </div>

                <Pagination :data="contratos"/>
            </div>


        </div>




    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import Pagination from "@/Shared/Pagination";
    import DirecaoSet from "@/Shared/DirecaoSet";

    export default {
        components: {
            DirecaoSet,
            Pagination,
            AppLayout,
            Welcome,
            JetButton,

        },
        data(){
            return {
                pesquisaData : '',
                direcaoData  : 'desc',
                orderByData  : 'id',
                formulario :
                {
                    isVisible : false,
                    title     : false,
                    type      : 'CREATE',
                    id        : null,
                },
            }
        },
        props:{
            errors       : Object,
            contratos    : Object,
            search       : String,
            direcao      : String,
            orderBy      : String,
        },
        mounted()
        {
            this.pesquisaData = this.search;
            this.direcaoData  = this.direcao;
            this.orderByData  = this.orderBy;
        },
        methods :
        {
            btnNew()
            {
                this.formulario.title       = "Novo Contrato";
                this.formulario.type        = 'CREATE';
                this.formulario.propriedade = {};
                this.formulario.isVisible   = true;
            },

            btnEditar(objeto)
            {
                this.formulario.title       = "Editar Contrato, ID: "+objeto.id;
                this.formulario.type        = 'UPDATE';
                this.formulario.propriedade = Object.assign({}, objeto);
                this.formulario.isVisible   = true;

            },

            searchSubmit()
            {
                this.$inertia.replace(
                    this.route('contratos.index',
                        {
                            search  : this.pesquisaData,
                            direcao : this.direcaoData,
                            orderBy : this.orderByData,
                        })
                );


            },
            orderBySubmit(campo)
            {
                this.orderByData = campo;

                if(this.direcaoData === 'desc'){
                    this.direcaoData = 'asc';
                }else{
                    this.direcaoData = 'desc';
                }

                this.searchSubmit();
            },

            deletar(row)
            {
                this.$confirm('Deseja excluir este contrato ? <br/> <strong>' +row.propriedade.bairro+', '+row.propriedade.endereco+', '+row.propriedade.estado+', '+row.propriedade.cidade+'</strong>',
                    'Excluir ID: '+row.id,
                    {
                        confirmButtonText: 'Excluir',
                        cancelButtonText: 'Cancel',
                        type: 'warning',
                        dangerouslyUseHTMLString: true

                }).then(() => {


                    this.$inertia.delete(route('contratos.delete', { id: row.id}),
                        {
                            onSuccess: () => {
                                this.$message({type: 'success', message: 'Delete executado!'});
                            }
                        }
                    );


                }).catch(() => {
                    this.$message({type: 'info', message: 'Delete cancelado.'});
                });

            }
        }
    }
</script>
