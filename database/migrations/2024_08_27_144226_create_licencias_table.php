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
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_inspeccion');
            $table->string('resolucion_apro')->nullable();
            $table->string('resolucion_hpc')->nullable();
            $table->string('catastro_la')->nullable();
            $table->string('catastro_lp')->nullable();
            $table->string('providencia')->nullable();
            $table->string('num_territorio')->nullable();
            $table->string('fecha_oficio');
            $table->unsignedBigInteger('id_plazo');
            $table->string('talonario');

            // Establecer relación con la tabla de plazos
            $table->foreign('id_inspeccion')->references('id')->on('inspecciones');
            
            // Establecer relación con la tabla de plazos
            $table->foreign('id_plazo')->references('id')->on('plazos');
            

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
        Schema::dropIfExists('licencias');
    }
};
