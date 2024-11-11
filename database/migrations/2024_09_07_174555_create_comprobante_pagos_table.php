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
        Schema::create('comprobante_pagos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_inspeccion');
            $table->unsignedBigInteger('id_tipo_pago');
            $table->string('banco')->nullable();
            $table->string('n_referencia')->nullable();
            $table->json('comprobante_pdf')->nullable();
            $table->text('observaciones_com')->nullable();
            $table->string('timbre_fiscal');
            $table->string('observaciones_fiscal')->nullable(); // Cambiado a 'text' para permitir más caracteres
            $table->date('fecha_pago');
            $table->string('estatus_pago');

            $table->timestamps();

            // Establecer relación con la tabla de inspecciones
            $table->foreign('id_inspeccion')->references('id')->on('inspecciones');

            // Establecer relación con la tabla de tipo_pagos
            $table->foreign('id_tipo_pago')->references('id')->on('tipo_pagos');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobante_pagos');
    }
};
