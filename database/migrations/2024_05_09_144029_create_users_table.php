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
        Schema::create('users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('username');
            $table->string('first_name', length:32);
            $table->string('last_name', length:32);
            $table->char('phone', length:11);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_address'); 
            $table->unsignedBigInteger('id_image')->nullable(); 
            $table->foreign('id_address')->references('id')->on('address');
            $table->foreign('id_image')->references('id')->on('image');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
