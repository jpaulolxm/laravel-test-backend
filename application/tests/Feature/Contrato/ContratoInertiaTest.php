<?php

namespace Tests\Feature\Contrato;

use App\Models\Propriedade;
use App\Models\TipoDePropriedadeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Inertia\Testing\Assert;

class ContratoInertiaTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_contrato_index()
    {
        $this->get(route('contratos.index'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Contrato/Index')
                ->has('contratos')
            );

    }

}
