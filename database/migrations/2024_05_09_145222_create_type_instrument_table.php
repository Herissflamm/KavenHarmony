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
        Schema::create('type_instrument', function (Blueprint $table) {
            $table->id();
            $table->string('type', length:45);
            $table->unsignedBigInteger('id_categories'); 
            $table->foreign('id_categories')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_instrument');
    }
};
