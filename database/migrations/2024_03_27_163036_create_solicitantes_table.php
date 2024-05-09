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
        Schema::create('solicitantes', function (Blueprint $table) {
            $table->id(); 
            $table->string('tipo')->nullable();           
            $table->unsignedBigInteger('solicitante_especifico_id')->nullable(); // Cambia a snake case
            $table->string('solicitante_especifico_type')->nullable(); // Cambia a snake case
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
        Schema::dropIfExists('solicitantes');
    }
};