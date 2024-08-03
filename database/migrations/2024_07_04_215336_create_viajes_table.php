<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ciudad_origen_id');
            $table->unsignedBigInteger('ciudad_destino_id');
            $table->dateTime('hora_salida');
            $table->dateTime('hora_llegada');
            $table->timestamps();


            $table->foreign('ciudad_origen_id')->references('id')->on('ciudades');
            $table->foreign('ciudad_destino_id')->references('id')->on('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viajes');
    }
}
