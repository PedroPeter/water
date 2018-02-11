<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagems', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cliente_id')->unsigned();
                $table->integer('gerente_id')->unsigned();
                $table->text('chat');
                $table->timestamps();
            });
            $table->timestamps();
            $table->rememberToken();
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagems');
    }
}
