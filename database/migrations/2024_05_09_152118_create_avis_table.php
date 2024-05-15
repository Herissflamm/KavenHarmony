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
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->string('note', length:11);
            $table->text('description');

            $table->unsignedBigInteger('id_seller'); 
            $table->foreign('id_seller')->references('id_users')->on('seller');

            $table->unsignedBigInteger('id_customer'); 
            $table->foreign('id_customer')->references('id_users')->on('customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
