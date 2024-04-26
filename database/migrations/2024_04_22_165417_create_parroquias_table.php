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
        Schema::create('parroquias', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_municipio')->nullable(false);
            $table->string('nom_parroquia', 250)->nullable(false);
            $table->timestamps();

            // Establecer relación con la tabla municipios 
            $table->foreign('id_municipio')->references('id')->on('municipios'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parroquias');
    }
};
