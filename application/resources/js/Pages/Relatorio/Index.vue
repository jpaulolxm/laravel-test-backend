<template>
    <app-layout title="Relatório">

        <header>
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <el-row>
                    <el-col :span="4">



                            <div class="grid-content bg-purple">



                                <el-date-picker
                                    style="width: 150px"
                                    v-model="formulario.dataInicial"
                                    type="date"
                                    placeholder="Data Inicial"
                                    format="DD/MM/YYYY"
                                    value-format="YYYY-MM-DD"
                                >
                                </el-date-picker>
                            </div>

                    </el-col>

                    <el-col :span="4">



                        <div class="grid-content bg-purple">



                            <el-date-picker
                                style="width: 150px"
                                v-model="formulario.dataFinal"
                                type="date"
                                placeholder="Data Inicial"
                                format="DD/MM/YYYY"
                                value-format="YYYY-MM-DD"
                            >
                            </el-date-picker>
                        </div>

                    </el-col>
                    <el-col :span="6">
                        <div class="grid-content bg-purple-light">

                            <inertia-link :href="route('relatorio.create')" :data="formulario" method="post">
                                <jet-button class="ml-2">
                                    Gerar Relatório Excel
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
                                            <th  scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Descrição

                                            </th>

                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status

                                            </th>

                                            <th scope="col" class="relative px-6 py-3">

                                                <inertia-link :href="route('relatorio.index')" class="float-right">
                                                    <jet-button class="ml-2">
                                                        Atualizar
                                                    </jet-button>
                                                </inertia-link>

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        <tr v-for="row in relatorios" :key="row.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{row.id}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">

                                                    <div class="text-sm text-gray-500">
                                                        {{row.descricao}}

                                                    </div>

                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">

                                                <el-tag v-if="row.id_status === 1" type="warning" size="small" effect="dark">{{row.status}}</el-tag>
                                                <el-tag v-if="row.id_status === 2" type="success" size="small" effect="dark">{{row.status}}</el-tag>
                                                <el-tag v-if="row.id_status === 3" type="danger" size="small" effect="dark">{{row.status}}</el-tag>

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a :href="route('relatorio.download',{id : row.id})" target="_blank" class="text-indigo-600 hover:text-indigo-900">Download</a>
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

            </div>


        </div>




    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Jetstream/Button.vue'

export default {
    components: {

        AppLayout,
        JetButton,

    },
    data(){
        return {
            formulario :
            {
                dataInicial : '',
                dataFinal   : '',

            },
        }
    },
    props:{
        errors       : Object,
        relatorios   : Object,
        dataInicial  : String,
        dataFinal    : String,
        isProcess    : Boolean,
    },
    mounted()
    {
        this.formulario.dataInicial = this.dataInicial;
        this.formulario.dataFinal   = this.dataFinal;

    },
    watch:
    {
        isProcess:
        {
            immediate: true,
            handler(newValue)
            {
                if(newValue)
                {
                    setTimeout(()=>{

                        this.$inertia.get(route('relatorio.index'));

                    }, 5000);

                }

            }
        }
    }
}
</script>
