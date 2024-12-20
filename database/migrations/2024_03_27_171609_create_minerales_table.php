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
        Schema::create('minerales', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('nombre');
            $table->string('categoria');
            $table->string('tasa')->nullable();
            // $table->string('valor_tasa')->nullable();
            $table->string('moneda_longitud')->nullable();
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
        Schema::dropIfExists('minerales');
    }
};
