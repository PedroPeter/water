<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leitura_id');
            $table->foreign('leitura_id')->references('id')->on('leituras')->onDelete('cascade');
            $table->float('l_anterior')->default(0);
            $table->float('l_actual')->default(0);
            $table->float('val_pagar')->default(0);
            $table->tinyInteger('paga')->default(0);
            $table->smallInteger('num_multas')->default(0);
            $table->float('val_multas')->default(0);
            $table->string('observacao')->default('Nenhuma observacao feita!');
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
        Schema::drop('facturas');
    }
}
