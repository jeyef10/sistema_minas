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
        Schema::create('planificacion_comisionados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_planificacion');
            $table->unsignedBigInteger('id_comisionado');

            // Establecer relación con la tabla de inspecciones
            $table->foreign('id_planificacion')->references('id')->on('planificacion');

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
        Schema::dropIfExists('planificacion_comisionados');
    }
};
