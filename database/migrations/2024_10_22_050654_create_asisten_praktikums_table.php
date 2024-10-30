<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asisten_praktikums', function (Blueprint $table) {
            $table->id();
            $table->string('npm')->unique();
            $table->string('username')->unique();
            $table->unsignedBigInteger('user_id'); // Add user_id column as foreign key
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asisten_praktikums');
    }
};
