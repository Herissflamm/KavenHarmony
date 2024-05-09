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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->decimal('shipping_price');
            $table->decimal('total_price');
            $table->unsignedBigInteger('id_customer'); 
            $table->foreign('id_customer')->references('id_users')->on('customer');

            $table->unsignedBigInteger('id_status'); 
            $table->foreign('id_status')->references('id')->on('order_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
