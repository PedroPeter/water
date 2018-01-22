<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFontenariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fontenarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('bairro');
            $table->string('rua_avenida');
            $table->string('descricao');
            $table->integer('numero');
            $table->integer('max_clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fontenarias');

    }
}
