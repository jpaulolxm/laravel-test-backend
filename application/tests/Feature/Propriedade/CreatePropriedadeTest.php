<?php

namespace Tests\Feature\Propriedade;

use App\Models\Propriedade;
use App\Models\TipoDePropriedadeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreatePropriedadeTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;


    public function test_propriedade_created()
    {
        $propriedade = [

                'bairro'             => 	"CRESPO",
                'cep'                => 	"69000-000",
                'cidade'             => 	"MANAUS",
                'complemento'        => 	"",
                'email_proprietario' => 	"jpaulolxm@gmail.com",
                'endereco'           => 	"RUA ADELINO PAES NETO",
                'estado'             => 	"AMAZONAS",
                'id'                 => 	0,
                'numero'             => 	"84",
                'tipo_imovel'        => 	TipoDePropriedadeEnum::SALA_COMERCIAL,

            ];

        $response = $this->post(route('propriedades.store', $propriedade));


        $response->assertStatus(302);

    }
}
