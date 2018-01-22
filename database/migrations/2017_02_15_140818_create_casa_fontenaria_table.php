<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasaFontenariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casa_fontenaria', function (Blueprint $table) {
            $table->integer('casa_id');
            $table->integer('fontenaria_id');
            $table->foreign('casa_id')->references('id')->on('casas')->onDelete('cascade');
            $table->foreign('fontenaria_id')->references('id')->on('fontenarias')->onDelete('cascade');
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
        Schema::drop('casa_fontenarias');

    }
}
