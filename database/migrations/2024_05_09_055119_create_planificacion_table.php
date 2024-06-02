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
        Schema::create('planificacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_recepcion');
            $table->unsignedBigInteger('id_comisionado');
            $table->unsignedBigInteger('id_municipio');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->string('estatus');
            $table->timestamps();

             // Establecer relación con la tabla de municipios
             $table->foreign('id_recepcion')->references('id')->on('recepcion');

            // Establecer relación con la tabla de comisionados
            $table->foreign('id_comisionado')->references('id')->on('comisionados');

            $table->foreign('id_municipio')->references('id')->on('municipios');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planificacion');
    }
};
