<?php

namespace Database\Factories;

use App\Models\Contrato;
use App\Models\Propriedade;
use App\Models\StatusPropriedadeEnum;
use App\Models\TipoDePessoaEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contrato::class;


    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition():array
    {
        $idTipoPessoa = $this->faker->numberBetween(1, 2);

        if($idTipoPessoa === TipoDePessoaEnum::FISICA)
        {
            $documento = $this->faker->cpf();
        }else{
            $documento = $this->faker->cnpj();
        }


        return [

             'id_user'        => 1,
             'id_propriedade' => Propriedade::where('id_status', '=', StatusPropriedadeEnum::NAO_CONTRADO)->first()->id,
             'id_tipo_pessoa' => $idTipoPessoa,
             'documento'      => $documento,
             'email'          => $this->faker->email(),
             'nome'           => $this->faker->name(),

        ];
    }

}
