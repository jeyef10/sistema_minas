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
        Schema::create('mineral_categoria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_categoria'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_mineral'); // Agregar columna de clave foránea
            

            // Establecer relación con la tabla de categorias
            $table->foreign('id_categoria')->references('id')->on('categorias');
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
        Schema::dropIfExists('mineral_categoria');
    }
};
