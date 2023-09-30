<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('datos_cargados', function (Blueprint $table) {
            $table->id();
            $table->string('origen');
            $table->string('destino');
            $table->integer('cant_asientos');
            $table->integer('tarifa_base');
            $table->string('type')->nullable();
            // Agrega otras columnas si es necesario
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('datos_cargados');
    }
    
};