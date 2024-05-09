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
        Schema::create('instrument_has_order', function (Blueprint $table) {
            $table->unsignedBigInteger('id_instrument'); 
            $table->foreign('id_instrument')->references('id')->on('instrument');

            $table->unsignedBigInteger('id_order'); 
            $table->foreign('id_order')->references('id')->on('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrument_has_order');
    }
};
