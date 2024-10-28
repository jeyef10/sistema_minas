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
        Schema::create('municipio_comisionados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_comisionado'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_municipio'); // Agregar columna de clave foránea
            
            // Establecer relación con la tabla de comisionados
            $table->foreign('id_comisionado')->references('id')->on('comisionados');
            // Establecer relación con la tabla de municipios
            $table->foreign('id_municipio')->references('id')->on('municipios');
            
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
        Schema::dropIfExists('municipio_comisionados');
    }
};
