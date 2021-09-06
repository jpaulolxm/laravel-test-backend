<?php

namespace Tests\Feature\Propriedade;

use App\Models\Propriedade;
use App\Models\TipoDePropriedadeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Inertia\Testing\Assert;

class PropriedadeInertiaTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_propriedade_index()
    {
        $this->get(route('propriedades.index'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Propriedade/Index')
                ->has('propriedades')
            );

    }

}
