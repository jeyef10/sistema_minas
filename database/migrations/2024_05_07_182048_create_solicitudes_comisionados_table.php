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
        Schema::create('solicitudes_comisionados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitud');
            $table->unsignedBigInteger('id_comisionado');
            $table->string('funcionario_acomp');
            $table->string('direccion_lugar');
            $table->string('observaciones');
            $table->string('conclusiones');
            $table->string('latitud');
            $table->string('longitud');
            $table->binary('foto');
            $table->string('estatus');

            // Establecer relación con la tabla de solicitudes
            $table->foreign('id_solicitud')->references('id')->on('solicitudes');

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
        Schema::dropIfExists('solicitudes_comsionados');
    }
};
