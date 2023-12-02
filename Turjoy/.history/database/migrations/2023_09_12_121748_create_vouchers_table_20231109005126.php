<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->string('id');
            $table->timestamp('travel_date');
            $table->string('origin');
            $table->string('destiny');
            $table->integer('seat_quantity');
            $table->integer('base_rate');
          //  $table->integer('User_id')->nullable();
          //  $table->integer('Route_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
