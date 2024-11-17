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
        Schema::create('penilaian_praktikum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_praktikum_id')->constrained('mata_kuliah_praktikums')->onDelete('cascade');
            $table->string('google_drive_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_praktikums');
    }
};
