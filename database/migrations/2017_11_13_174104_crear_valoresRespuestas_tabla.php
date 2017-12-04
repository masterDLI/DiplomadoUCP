<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearValoresRespuestasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores_respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formatos_respuesta_id')->unsigned();
            $table->foreign('formatos_respuesta_id')->references('id')->on('formatos_respuestas');
            $table->string('respuesta');
            $table->float('valor');
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
        Schema::dropIfExists('valores_respuestas');
    }
}
