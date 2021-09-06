<?php

namespace Database\Factories;

use App\Models\Propriedade;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropriedadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Propriedade::class;


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
        return [
            'id_user'            => 1,
            'id_tipo'            => $this->faker->numberBetween(1, 3),
            'email_proprietario' => $this->faker->email(),
            'cep'                => $this->faker->postcode(),
            'bairro'             => $this->faker->streetName(),
            'endereco'           => $this->faker->streetAddress(),
            'numero'             => $this->faker->numberBetween(1000, 9999),
            'complemento'        => $this->faker->email(),
            'estado'             => $this->faker->state(),
            'cidade'             => $this->faker->city(),
            'id_status'          => 1,

        ];
    }

}
