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
        Schema::create('sell', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->unsignedBigInteger('id_discount')->nullable(); 
            $table->foreign('id_discount')->references('id')->on('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell');
    }
};
