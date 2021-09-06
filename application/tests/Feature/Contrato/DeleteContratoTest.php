<?php

namespace Tests\Feature\Contrato;

use App\Models\Contrato;
use App\Models\Propriedade;
use App\Models\TipoDePessoaEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeleteContratoTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;


    public function test_Contrato_deleted()
    {
        Propriedade::factory()->create();

        $contrato   = Contrato::factory()->create();

        $response = $this->delete(route('contratos.delete', ['contrato' => $contrato->id]));

        $response->assertStatus(302);

    }
}
