<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Notificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->string('cliente')->nullable();
            $table->string('encuesta')->nullable();
            $table->string('resultado')->nullable();
            $table->string('encuestador')->nullable();
            $table->integer('leido')->unsigned();
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
        Schema::dropIfExists('Notificaciones');
    }
}
