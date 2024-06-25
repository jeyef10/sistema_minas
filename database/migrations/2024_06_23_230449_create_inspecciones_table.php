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

            $table->unsignedBigInteger('id_planificacion');
            $table->string('funcionario_acomp');
            $table->string('lugar_direccion');
            $table->text('observaciones'); // Cambiado a 'text' para permitir más caracteres
            $table->text('conclusiones'); // Cambiado a 'text' para permitir más caracteres
            $table->string('latitud');
            $table->string('longitud');
            $table->string('res_fotos');
            $table->date('fecha_inspeccion');
            $table->string('estatus');

            $table->timestamps();

            // Establecer relación con la tabla de planificación
            $table->foreign('id_planificacion')->references('id')->on('planificacion');

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
