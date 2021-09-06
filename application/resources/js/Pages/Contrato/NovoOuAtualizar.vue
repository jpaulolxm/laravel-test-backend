<template>
<app-layout title="Novo Contrato">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Contrato
        </h2>
    </template>

<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


            <el-steps :space="200" :active="active" simple>
                <el-step title="Propriedade" icon="el-icon-s-home" style="cursor: pointer" @click.prevent="active=0"></el-step>
                <el-step title="Contratante" icon="el-icon-document" style="cursor: pointer" @click.prevent="active=1"></el-step>
            </el-steps>

            <div v-show="active === 0" class="py-5" style="margin: 5px">

                <el-row>
                    <el-col :span="12">
                        <form>

                            <div class="grid-content bg-purple">

                                <el-input v-model="searchInput" type="text" @input="searchPropriedade" placeholder="Pesquisar Propriedade" clearable>
                                    <template #prefix>
                                        <i class="el-input__icon el-icon-search"></i>
                                    </template>
                                </el-input>
                            </div>

                        </form>
                    </el-col>

                </el-row>

                <table style="margin-top: 5px" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th  scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th  scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Proprietário
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Endereço
                        </th>

                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    <tr v-for="row in propriedades" :key="row.id">
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

                            <el-tag v-if="row.id_status === 1" size="small" type="info" effect="dark"> {{row.status}} </el-tag>
                            <el-tag v-if="row.id_status === 2" size="small" type="success" effect="dark"> {{row.status}} </el-tag>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{row.bairro}}, {{ row.endereco }}, {{row.numero}}</div>
                            <div class="text-sm text-gray-500">{{row.estado}} - {{row.cidade}}</div>
                            <el-tag size="small" type="info" effect="dark"> {{row.tipo}} </el-tag>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">

                            <el-button  v-show="row.id_status === 1"  @click.prevent="selecionarPropriedade(row)" type="info" size="medium" round>Selecionar</el-button>


                        </td>


                    </tr>

                    <!-- More people... -->
                    </tbody>
                </table>


            </div>
            <div v-show="active === 1">

                <el-card>

                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="170px" class="demo-ruleForm">
                        <el-form-item label="Propriedade :">

                            {{propriedade.bairro}} , {{propriedade.endereco}},  {{propriedade.rua}} - {{propriedade.estado}} - {{propriedade.cidade}} <br/>
                            {{propriedade.email_proprietario}}

                            <div class="el-form-item__error" v-if="errors.propriedade">{{ errors.propriedade }}</div>

                        </el-form-item>

                        <el-form-item label="Tipo :">
                            <el-radio-group v-model="ruleForm.tipo_pessoa">
                                <el-radio :label="1" border>Pessoa Física</el-radio>
                                <el-radio :label="2" border>Pessoa Jurídica</el-radio>
                            </el-radio-group>

                            <div class="el-form-item__error" v-if="errors.tipo_pessoa">{{ errors.tipo_pessoa }}</div>
                        </el-form-item>



                        <el-form-item label="CPF" prop="cpf" v-show="ruleForm.tipo_pessoa === 1">

                            <el-input maxlength="14" placeholder="000.000.000-00" v-model="ruleForm.cpf" v-maska="'###.###.###-##'"></el-input>
                            <div class="el-form-item__error" v-if="errors.cpf">{{ errors.cpf }}</div>
                            <div class="el-form-item__error" v-if="errors.cpf">{{ errors.cpf }}</div>

                        </el-form-item>

                        <el-form-item label="CNPJ" prop="cnpj" v-show="ruleForm.tipo_pessoa === 2">

                            <el-input maxlength="18" placeholder="00.000.000/0001-00" v-model="ruleForm.cnpj" v-maska="'##.###.###/####-##'"></el-input>
                            <div class="el-form-item__error" v-if="errors.cnpj">{{ errors.cnpj }}</div>
                            <div class="el-form-item__error" v-if="errors.cnpj">{{ errors.cnpj }}</div>

                        </el-form-item>



                        <el-form-item label="E-mail" prop="email">
                            <el-input v-model="ruleForm.email"></el-input>
                            <div class="el-form-item__error" v-if="errors.email">{{ errors.email }}</div>
                        </el-form-item>

                    <el-form-item label="Nome Completo:" prop="nome">
                        <el-input v-model="ruleForm.nome"></el-input>
                        <div class="el-form-item__error" v-if="errors.nome">{{ errors.nome }}</div>
                    </el-form-item>


                        <el-button  icon="el-icon-check" type="primary" @click="submitForm('ruleForm')" style="width: 100%">
                            {{type === 'UPDATE' ? 'Atualizar Contrato' : 'Criar Contrato'}}
                        </el-button>
                </el-form>


                </el-card>

            </div>


        </div>
    </div>
</div>


</app-layout>


</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'

function initialState()
{
    return  {
        id: 0,
        propriedade : 0,
        tipo_pessoa : 1,
        cpf: '',
        cnpj: '',
        email: '',
        nome: '',
    }
}



export default {
    name: "NovoOuAtualizarContrato",

    components:{
        AppLayout,
    },

    props: {
        errors: Object
    },

    data(){
        return {
            searchInput: '',
            active : 0,
            isLoad : false,
            propriedades:[],
            propriedade : {},
            tipos  : [],
            ruleForm : initialState(),
            rules    : {
                email: [
                    {  type: 'email', required: true, message: 'Por favor informe um E-mail', trigger: 'blur' },
                ],
                nome: [
                    { required: true, message: 'Por favor informe o nome completo do Contratante.', trigger: 'blur' }
                ],
            }
        }
    },

  methods:
  {

        submitForm(formName)
        {
          this.$refs[formName].validate((valid) =>
          {
                if (valid)
                {
                    this.type === 'UPDATE' ? this.updateForm() : this.createForm();

                } else {
                  return false;
                }
          });
        },
        resetForm()
        {
            this.ruleForm = initialState();

        },
        createForm()
        {
            this.isLoad = true;

            this.$inertia.post(route('contratos.store'), this.ruleForm,
                {
                            onSuccess: () =>
                            {
                                this.isLoad = false;

                                this.$message({type: 'success', message: 'Contrato cadastrada com sucesso!'});

                                this.$emit('CLOSE');
                            }
                        });

        },
        updateForm()
        {
            this.isLoad = true;

            this.$inertia.put(route('contratos.update') , this.ruleForm,
                {
                    onSuccess: () =>
                    {
                        this.isLoad = false;

                        this.$message({type: 'success', message: 'Contrato atualizada com sucesso!'});

                        this.$emit('CLOSE');
                    }
                });
        },

      next() {
          if (this.active++ > 2) this.active = 0;
      },

      selecionarPropriedade(select)
      {
          this.propriedade          = select;
          this.ruleForm.propriedade = select.id;

          this.next();

      },

      searchPropriedade()
      {
          axios.get(route('propriedades.search', {search : this.searchInput}))
               .then((response)=>{

                    this.propriedades = response.data.data;

                  }).catch((erro)=>{

                      console.log(erro);
                  });
      }


    },
    watch:
    {
        // isOpen:
        // {
        //     immediate: true,
        //     handler(newValue)
        //     {
        //         if (newValue)
        //         {
        //             this.isLoad = false;
        //             this.errors = {};
        //
        //             if (this.type === 'UPDATE')
        //             {
        //                 this.ruleForm = {
        //
        //                     id                  : this.propriedade.id,
        //                     email_proprietario  : this.propriedade.email_proprietario,
        //                     tipo_imovel         : this.propriedade.id_tipo,
        //                     cep                 : this.propriedade.cep,
        //                     endereco            : this.propriedade.endereco,
        //                     numero              : this.propriedade.numero,
        //                     bairro              : this.propriedade.bairro,
        //                     complemento         : this.propriedade.complemento,
        //                     estado              : this.propriedade.estado,
        //                     cidade              : this.propriedade.cidade,
        //                 };
        //
        //             }
        //
        //             if (this.type === 'CREATE')
        //             {
        //                 this.resetForm()
        //             }
        //
        //
        //         }
        //     }
        //
        // },

    }
}
</script>
