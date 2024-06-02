<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcion_recaudos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_recepcion'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_recaudo'); // Agregar columna de clave foránea

            // Establecer relación con la tabla de solicitudes
            $table->foreign('id_recepcion')->references('id')->on('recepcion');

            // Establecer relación con la tabla de recaudos
            $table->foreign('id_recaudo')->references('id')->on('recaudos');

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
        Schema::dropIfExists('recepcion_recaudos');
    }
};
