<?php

namespace Tests\Feature\Propriedade;

use App\Models\Propriedade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeletePropriedadeTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;


    public function test_propriedade_deleted()
    {
        $propriedade = Propriedade::factory()->create();

        $response = $this->delete(route('propriedades.delete', ['propriedade' => $propriedade->id]));

        $response->assertStatus(302);

    }
}
