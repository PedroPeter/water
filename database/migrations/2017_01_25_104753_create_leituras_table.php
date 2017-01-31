<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeiturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leitutas', function (Blueprint $table) {
            $table->integer('casa_id');
            $table->foreign('casa_id')->references('id')->on('casas')->onDelete('cascade');
            $table->integer('agua_id');
            $table->foreign('agua_id')->references('id')->on('aguas')->onDelete('cascade');
            $table->float('consumo');
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
        //
    }
}
