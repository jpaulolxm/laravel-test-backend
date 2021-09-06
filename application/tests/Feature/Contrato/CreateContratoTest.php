<?php

namespace Tests\Feature\Contrato;

use App\Models\Propriedade;
use App\Models\TipoDePessoaEnum;
use App\Models\TipoDePropriedadeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateContratoTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;


    public function test_contrato_created()
    {
        $propriedade = Propriedade::factory()->create();

        $contrato = [

            'cnpj'        =>	"",
            'cpf'         =>	"531.515.852-72",
            'email'       =>	"jpaulolxm@gmail.com",
            'id'          =>	0,
            'nome'        =>	"JOAO PAULO",
            'propriedade' =>	$propriedade->id,
            'tipo_pessoa' =>	TipoDePessoaEnum::FISICA,

            ];

        $response = $this->post(route('contratos.store', $contrato));


        $response->assertStatus(302);

    }
}
