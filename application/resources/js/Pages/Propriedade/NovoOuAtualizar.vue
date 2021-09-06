<template>

  <el-card v-loading="isLoad">
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="170px" class="demo-ruleForm">

        <el-form-item label="E-mail do Proprietário" prop="email_proprietario">
        <el-input v-model="ruleForm.email_proprietario"></el-input>
          <div class="el-form-item__error" v-if="errors.email_proprietario">{{ errors.email_proprietario }}</div>
      </el-form-item>
      <el-form-item label="Tipo De Imóvel" prop="tipo_imovel">
        <el-select v-model="ruleForm.tipo_imovel" placeholder="Tipo de Imóvel">
          <el-option :label="tipo.name" :value="tipo.id" v-for="tipo in tipos" :key="tipo.id"></el-option>
        </el-select>
          <div class="el-form-item__error" v-if="errors.tipo_imovel">{{ errors.tipo_imovel }}</div>
      </el-form-item>

        <el-form-item label="Cep" prop="cep">

            <el-input maxlength="9" placeholder="00000-000" v-model="ruleForm.cep" v-maska="'#####-###'"></el-input>
            <div class="el-form-item__error" v-if="errors.cep">{{ errors.cep }}</div>

        </el-form-item>

      <el-form-item label="Endereço" prop="endereco">
        <el-input v-model="ruleForm.endereco"></el-input>
          <div class="el-form-item__error" v-if="errors.endereco">{{ errors.endereco }}</div>
      </el-form-item>

      <el-form-item label="Numero" prop="numero">
        <el-input v-model="ruleForm.numero"></el-input>
          <div class="el-form-item__error" v-if="errors.numero">{{ errors.numero }}</div>
      </el-form-item>

      <el-form-item label="Bairro" prop="bairro">
        <el-input v-model="ruleForm.bairro"></el-input>
          <div class="el-form-item__error" v-if="errors.bairro">{{ errors.bairro }}</div>
      </el-form-item>

      <el-form-item label="Complemento" prop="complemento">
        <el-input v-model="ruleForm.complemento"></el-input>

      <div class="el-form-item__error" v-if="errors.complemento">{{ errors.complemento }}</div>

      </el-form-item>

      <el-form-item label="Estado" prop="estado">
        <el-input v-model="ruleForm.estado"></el-input>
          <div class="el-form-item__error" v-if="errors.estado">{{ errors.estado }}</div>
      </el-form-item>

      <el-form-item label="Cidade" prop="cidade">
        <el-input v-model="ruleForm.cidade"></el-input>
          <div class="el-form-item__error" v-if="errors.cidade">{{ errors.cidade }}</div>
      </el-form-item>

      <el-button  icon="el-icon-check" type="primary" @click="submitForm('ruleForm')" style="width: 100%">
          {{type === 'UPDATE' ? 'Atualizar' : 'Salvar'}}
      </el-button>
    </el-form>
  </el-card>

</template>

<script>

function initialState()
{
    return  {
        id: 0,
        email_proprietario: '',
        tipo_imovel: '',
        cep: '',
        endereco: '',
        numero: '',
        bairro: '',
        complemento: '',
        estado: '',
        cidade: ''
    }
}



export default {
    name: "NovoOuAtualizar",
    props :{
        isOpen      : Boolean,
        type        : String,
        rErrors     : Object,
        propriedade : Object

    },
    data(){
        return {
            errors : {},
            isLoad : false,
            tipos  : [],
            ruleForm : initialState,
            rules    : {
                email_proprietario: [
                    {  type: 'email', required: true, message: 'Por favor informe um E-mail', trigger: 'blur' },
                ],
                tipo_imovel: [
                    { required: true, message: 'Por favor selecione um tipo de Imóvel', trigger: 'change' }
                ],
                cep: [
                    {  required: true, message: 'Por favor informe o CEP', trigger: 'blur' },
                    { min: 9, max: 9, message: 'CEP invalido.', trigger: 'blur' }
                ],
                endereco: [
                    {  required: true, message: 'Por favor informe o Endereço', trigger: 'blur' }
                ],
                numero: [
                    {  required: true, message: 'Por favor informe um Número', trigger: 'blur' }
                ],
                bairro: [
                    {  required: true, message: 'Por favor informe o Bairro', trigger: 'blur' }
                ],
                complemento: [
                    { required: false, message: 'Por favor informe um Complemento', trigger: 'blur' }
                ],
                estado: [
                    { required: true, message: 'Por favor informe um Estado', trigger: 'blur' }
                ],
                cidade: [
                    { required: true, message: 'Por favor informe uma Cidade', trigger: 'blur' }
                ]
            }
        }
    },
  mounted()
  {
        axios.get(route('propriedades.create')).then((response) => {

            this.tipos = response.data.tipos;

        }).catch((erro) =>{

          console.log(erro);

        });
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
            console.log("createForm");

            this.isLoad = true;

            this.$inertia.post(route('propriedades.store'), this.ruleForm,
                {
                            onSuccess: () =>
                            {
                                this.isLoad = false;

                                this.$message({type: 'success', message: 'Propriedade cadastrada com sucesso!'});

                                this.$emit('CLOSE');
                            }
                        });

        },
        updateForm()
        {
            console.log("updateForm");
            this.isLoad = true;

            this.$inertia.put(route('propriedades.update') , this.ruleForm,
                {
                    onSuccess: () =>
                    {
                        this.isLoad = false;

                        this.$message({type: 'success', message: 'Propriedade atualizada com sucesso!'});

                        this.$emit('CLOSE');
                    }
                });
        }


    },
    watch:
    {
        isOpen:
        {
            immediate: true,
            handler(newValue)
            {
                if (newValue)
                {
                    this.isLoad = false;
                    this.errors = {};

                    if (this.type === 'UPDATE')
                    {
                        this.ruleForm = {

                            id                  : this.propriedade.id,
                            email_proprietario  : this.propriedade.email_proprietario,
                            tipo_imovel         : this.propriedade.id_tipo,
                            cep                 : this.propriedade.cep,
                            endereco            : this.propriedade.endereco,
                            numero              : this.propriedade.numero,
                            bairro              : this.propriedade.bairro,
                            complemento         : this.propriedade.complemento,
                            estado              : this.propriedade.estado,
                            cidade              : this.propriedade.cidade,
                        };

                    }

                    if (this.type === 'CREATE')
                    {
                        this.resetForm()
                    }


                }
            }

        },
        rErrors(newValue)
        {
            this.errors = newValue;
        },
    }
}
</script>

<style scoped>

</style>
