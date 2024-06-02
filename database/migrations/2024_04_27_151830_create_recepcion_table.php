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
        Schema::create('recepcion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitante'); // Agregar columna de clave foránea
            $table->bigInteger('id_municipio')->nullable(); ;// Agregar columna de clave foránea
            $table->unsignedBigInteger('id_mineral');// Agregar columna de clave foránea
            $table->string('direccion');
            // $table->string('condernada');
            $table->string('fecha');
            
            $table->timestamps();

            // Establecer relación con la tabla de recepción
            $table->foreign('id_solicitante')->references('id')->on('solicitantes');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->foreign('id_mineral')->references('id')->on('minerales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepcion');
    }
};
