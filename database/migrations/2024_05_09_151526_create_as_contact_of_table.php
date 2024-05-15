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
        Schema::create('as_contact_of', function (Blueprint $table) {

            $table->unsignedBigInteger('id_teacher'); 
            $table->foreign('id_teacher')->references('id_users')->on('teacher');

            $table->unsignedBigInteger('id_student'); 
            $table->foreign('id_student')->references('id_users')->on('student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('as_contact_of');
    }
};
