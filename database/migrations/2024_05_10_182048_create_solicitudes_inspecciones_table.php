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
        Schema::create('solicitudes_inspecciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_inspeccion');
            $table->unsignedBigInteger('id_comisionado');

            // Establecer relación con la tabla de inspecciones
            $table->foreign('id_inspeccion')->references('id')->on('inspecciones');

            // Establecer relación con la tabla de comisionados
            $table->foreign('id_comisionado')->references('id')->on('comisionados');

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
        Schema::dropIfExists('solicitudes_inspecciones');
    }
};
