<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         \App\Models\Propriedade::factory(3000)->create();

         for($i = 0; $i <= 150; $i++)
         {
             \App\Models\Contrato::factory()->create();
         }

    }
}
