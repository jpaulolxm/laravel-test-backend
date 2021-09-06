<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    private $table = "contratos";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table)
        {
            $table->id();
            $table->integer('id_user')->index();
            $table->integer('id_propriedade')->index();
            $table->tinyInteger('id_tipo_pessoa')->index();
            $table->string('documento', 20)->index();
            $table->string('email', 50)->index();
            $table->string('nome', 100)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
