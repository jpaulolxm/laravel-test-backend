<template>
    <app-layout title="Dashboard">

        <header>
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <el-row>
                    <el-col :span="12">

                        <form @submit.prevent="searchSubmit">

                            <div class="grid-content bg-purple">



                                <el-input type="search" placeholder="Pesquisar Propriedades" v-model="pesquisaData">
                                    <template #prefix>
                                        <i class="el-input__icon el-icon-search"></i>
                                    </template>
                                </el-input>
                            </div>
                        </form>
                    </el-col>
                    <el-col :span="12">
                        <div class="grid-content bg-purple-light float-right">

                            <jet-button class="ml-2" @click="btnNew">
                                Nova Propriedade
                            </jet-button>
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
                                            <th @click="orderBySubmit('email_proprietario')" style="cursor: pointer" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                <DirecaoSet title="Proprietário" :direcao="direcaoData" :order-by="orderByData" coluna="email_proprietario"/>
                                            </th>
                                            <th @click="orderBySubmit('id_tipo')" style="cursor: pointer" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                <DirecaoSet title="Tipo" :direcao="direcaoData" :order-by="orderByData" coluna="id_tipo"/>
                                            </th>
                                            <th @click="orderBySubmit('endereco')" style="cursor: pointer" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                <DirecaoSet title="Endereço" :direcao="direcaoData" :order-by="orderByData" coluna="endereco"/>
                                            </th>
                                            <th @click="orderBySubmit('id_status')" style="cursor: pointer" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                <DirecaoSet title="Status" :direcao="direcaoData" :order-by="orderByData" coluna="id_status"/>
                                            </th>

                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        <tr v-for="row in propriedades.data" :key="row.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{row.id}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">

                                                        <div class="text-sm text-gray-500">
                                                            {{ row.email_proprietario }}
                                                        </div>

                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ row.tipo }}
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div class="text-sm text-gray-900">{{row.bairro}}, {{ row.endereco }}, {{row.numero}}</div>
                                                <div class="text-sm text-gray-500">{{row.estado}} - {{row.cidade}}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">

                                                <el-tag v-if="row.id_status === 1" size="small" type="info" effect="dark"> {{row.status}} </el-tag>
                                                <el-tag v-if="row.id_status === 2" size="small" type="success" effect="dark"> {{row.status}} </el-tag>


                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#" @click.prevent="btnEditar(row)" class="px-1 text-indigo-600 hover:text-indigo-900">Editar</a>
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

                <Pagination :data="propriedades"/>
            </div>


        </div>



        <el-dialog
            :close-on-click-modal="false"
            top="15px"
            :title="formulario.title"
            v-model="formulario.isVisible"
            width="30%"
            :before-close="()=>{ formulario.isVisible = false}">

            <NovoOuAtualizar :type="formulario.type"
                             :is-open="formulario.isVisible"
                             :r-errors="errors"
                             :propriedade="formulario.propriedade"
                             @CLOSE="formulario.isVisible = false"/>

        </el-dialog>


    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import NovoOuAtualizar from './NovoOuAtualizar'
    import Pagination from "@/Shared/Pagination";
    import DirecaoSet from "../../Shared/DirecaoSet";

    export default {
        components: {
            DirecaoSet,
            Pagination,
            AppLayout,
            Welcome,
            JetButton,
            NovoOuAtualizar
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
            propriedades : Object,
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
                this.formulario.title       = "Nova Propriedade";
                this.formulario.type        = 'CREATE';
                this.formulario.propriedade = {};
                this.formulario.isVisible   = true;
            },

            btnEditar(objeto)
            {
                this.formulario.title       = "Editar Propriedade, ID: "+objeto.id;
                this.formulario.type        = 'UPDATE';
                this.formulario.propriedade = Object.assign({}, objeto);
                this.formulario.isVisible   = true;

            },

            searchSubmit()
            {
                this.$inertia.replace(
                    this.route('propriedades.index',
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
                this.$confirm('Deseja excluir está propriedade ? <br/> <strong>' +row.bairro+', '+row.endereco+', '+row.estado+', '+row.cidade+'</strong>',
                    'Excluir ID: '+row.id,
                    {
                        confirmButtonText: 'Excluir',
                        cancelButtonText: 'Cancel',
                        type: 'warning',
                        dangerouslyUseHTMLString: true

                }).then(() => {


                    this.$inertia.delete(route('propriedades.delete', { id: row.id}),
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
