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
        Schema::create('mahasiswa_praktikums', function (Blueprint $table) {
            $table->id();

            // Kolom NPM dengan panjang maksimum 10 karakter
            $table->string('npm', 10)->unique();

            // Kolom nama mahasiswa
            $table->string('nama');


            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_praktikums');
    }
};
