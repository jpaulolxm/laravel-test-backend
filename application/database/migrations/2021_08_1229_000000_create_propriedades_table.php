<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropriedadesTable extends Migration
{

    private $table = "propriedades";

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
            $table->tinyInteger('id_tipo')->index();
            $table->string('email_proprietario', 50);
            $table->string('cep', 9);
            $table->string('bairro', 50)->index();;
            $table->string('endereco', 50)->index();;
            $table->string('numero', 50);
            $table->string('complemento', 50)->nullable();
            $table->string('estado', 50)->index();;
            $table->string('cidade', 50)->index();;
            $table->tinyInteger('id_status')->index();
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
