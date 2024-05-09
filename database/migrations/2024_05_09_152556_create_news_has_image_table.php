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
        Schema::create('news_has_image', function (Blueprint $table) {
            $table->unsignedBigInteger('id_image'); 
            $table->foreign('id_image')->references('id')->on('image');

            $table->unsignedBigInteger('id_news'); 
            $table->foreign('id_news')->references('id')->on('news');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_has_image');
    }
};
