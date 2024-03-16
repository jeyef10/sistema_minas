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
        Schema::create('historico_sidi', function (Blueprint $table) {
            $table->id();
            $table->string('tablaafectada');
            $table->string('operacion');
            $table->date('fecha');
            $table->string('usuario_bd');
            $table->longText('usuario')->nullable();
            $table->longText('datos_nuevos')->nullable();
            $table->longText('datos_viejos')->nullable();
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
        Schema::dropIfExists('historico_sidi');
    }
};
