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
        Schema::create('control_regalias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_licencia'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_pago_regalia'); // Agregar columna de clave foránea
            
            // Establecer relación con la tabla de licencias
            $table->foreign('id_licencia')->references('id')->on('licencias');
            // Establecer relación con la tabla de pago_regalias
            $table->foreign('id_pago_regalia')->references('id')->on('pago_regalias');

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
        Schema::dropIfExists('control_regalias');
    }
};
