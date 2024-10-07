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
        Schema::create('comisionados', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('nombres');
            $table->string('apellidos');
            $table->bigInteger('id_municipio')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();

            // Establecer relación con la tabla de municipios
            $table->foreign('id_municipio')->references('id')->on('municipios');

            // Establecer relación con la tabla de users
            $table->foreign('id_usuario')->references('id')->on('users');

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
        Schema::dropIfExists('comisionados');
    }
};
