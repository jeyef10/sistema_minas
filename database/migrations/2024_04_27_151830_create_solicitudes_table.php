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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitante'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_mineral'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_regalia'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_plazo'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_municipio'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_parroquia'); // Agregar columna de clave foránea
            $table->integer('num_regalias');
            $table->integer('volumen');
            $table->string('direccion');
            $table->string('fecha');
            $table->string('observaciones')->nullable();
            $table->string('estatus');
            $table->timestamps();

            // Establecer relación con la tabla de solicitantes
            $table->foreign('id_solicitante')->references('id')->on('solicitantes');
            // Establecer relación con la tabla de minerales
            $table->foreign('id_mineral')->references('id')->on('minerales');
            // Establecer relación con la tabla de tipo de tasa de regalias
            $table->foreign('id_regalia')->references('id')->on('regalias');
            // Establecer relación con la tabla de tipo de tasa de regalias
            $table->foreign('id_plazo')->references('id')->on('plazos');

            // Establecer relación con la tabla de municipios
            $table->foreign('id_municipio')->references('id')->on('municipios');
            // Establecer relación con la tabla de parroquias
            $table->foreign('id_parroquia')->references('id')->on('parroquias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
};
