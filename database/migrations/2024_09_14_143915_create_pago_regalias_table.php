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
        Schema::create('pago_regalias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_licencia');
            $table->unsignedBigInteger('id_mineral');
            $table->string('metodo_apro')->nullable();
            $table->string('metodo_pro')->nullable(); 
            $table->string('monto_apro')->nullable();
            $table->string('monto_pro')->nullable();
            $table->string('resultado_apro')->nullable();
            $table->string('resultado_pro')->nullable();
            $table->json('comprobante');
            $table->date('fecha_pago');
            $table->date('fecha_venci');
            $table->string('estatus_regalia');

            // Establecer relación con la tabla de la licencias
            $table->foreign('id_licencia')->references('id')->on('licencias');

            // Establecer relación con la tabla de minerales
            $table->foreign('id_mineral')->references('id')->on('minerales');


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
        Schema::dropIfExists('pago_regalias');
    }
};
