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
            $table->string('utm_norte');
            $table->string('utm_este');
            $table->json('res_fotos')->nullable(); // Para almacenar los nombres de las fotos en formato JSON
            $table->date('fecha_inspeccion');
            $table->string('estatus');
            $table->string('estatus_resp')->nullable();
            $table->string('longitud_terreno')->nullable();
            $table->string('ancho')->nullable();
            $table->string('profundidad')->nullable();
            $table->string('volumen')->nullable();
            $table->string('lindero_norte')->nullable();
            $table->string('lindero_sur')->nullable();
            $table->string('lindero_este')->nullable();
            $table->string('lindero_oeste')->nullable();
            $table->string('superficie')->nullable();

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
