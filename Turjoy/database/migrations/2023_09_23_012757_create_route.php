<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('Route', function (Blueprint $table) {
            $table->id();
            $table->string('origin')->nullable();
            $table->string('destiny')->nullable();
            $table->string('seat_quantity')->nullable();
            $table->string('base_rate')->nullable();
            $table->string('type')->nullable();
            // Agrega otras columnas si es necesario
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Route');
    }

};
