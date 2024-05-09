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
        Schema::create('is_renting', function (Blueprint $table) {
            $table->unsignedBigInteger('id_customer'); 
            $table->foreign('id_customer')->references('id_users')->on('customer');

            $table->unsignedBigInteger('id_instrument'); 
            $table->foreign('id_instrument')->references('id')->on('instrument');

            $table->date('date_start');
            $table->date('date_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('is_renting');
    }
};
