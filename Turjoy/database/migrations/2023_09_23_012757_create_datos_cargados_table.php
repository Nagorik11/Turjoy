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
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->string('cant_asientos')->nullable();
            $table->string('tarifa_base')->nullable();
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