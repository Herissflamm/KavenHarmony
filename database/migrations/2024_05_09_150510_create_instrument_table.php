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
        Schema::create('instrument', function (Blueprint $table) {
            $table->id();
            $table->string('name', length:45);
            $table->text('description');

            $table->unsignedBigInteger('id_type_instrument'); 
            $table->foreign('id_type_instrument')->references('id')->on('type_instrument');

            $table->unsignedBigInteger('id_seller'); 
            $table->foreign('id_seller')->references('id_users')->on('seller');

            $table->unsignedBigInteger('id_state'); 
            $table->foreign('id_state')->references('id')->on('state');

            $table->unsignedBigInteger('id_sell'); 
            $table->foreign('id_sell')->references('id')->on('sell');

            $table->unsignedBigInteger('id_rent')->nullable(); 
            $table->foreign('id_rent')->references('id')->on('rent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrument');
    }
};
