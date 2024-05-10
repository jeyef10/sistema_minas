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
        Schema::create('inspecciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitud');
            $table->unsignedBigInteger('id_municipio');
            $table->unsignedBigInteger('id_comisionado');
            $table->string('funcionario_acomp');
            $table->string('lugar_direccion');
            $table->date('fecha_inspeccion');
            $table->string('observaciones');
            $table->string('conclusiones');
            $table->string('latitud');
            $table->string('longitud');
            $table->binary('res_fotos');
            $table->string('estatus');
            $table->timestamps();

             // Establecer relación con la tabla de municipios
             $table->foreign('id_solicitud')->references('id')->on('solicitudes');

            // Establecer relación con la tabla de municipios
            $table->foreign('id_municipio')->references('id')->on('municipios');

            // Establecer relación con la tabla de comisionados
            $table->foreign('id_comisionado')->references('id')->on('comisionados');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspecciones');
    }
};
