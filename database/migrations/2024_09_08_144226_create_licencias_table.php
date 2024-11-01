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
            $table->unsignedBigInteger('id_comprobante_pago');
            $table->string('resolucion_apro')->nullable();
            $table->string('resolucion_hpc')->nullable();
            $table->string('catastro_la')->nullable();
            $table->string('catastro_lp')->nullable();
            $table->string('providencia')->nullable();
            $table->string('num_territorio')->nullable();
            $table->string('metodo_licencia_apro')->nullable();
            $table->string('metodo_licencia_pro')->nullable();
            $table->string('fecha_oficio');
            $table->string('fecha_inicial_ope');
            $table->string('fecha_final_ope');
            $table->unsignedBigInteger('id_plazo');
            $table->string('talonario');

            // Establecer relación con la tabla de plazos
            $table->foreign('id_comprobante_pago')->references('id')->on('comprobante_pagos');
            
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
