<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mahasiswa_mata_kuliah_praktikum', function (Blueprint $table) {
            $table->id();
            // Foreign key for MahasiswaPraktikum
            $table->unsignedBigInteger('mahasiswa_praktikum_id');
            $table->foreign('mahasiswa_praktikum_id')->references('id')->on('mahasiswa_praktikums')->onDelete('cascade');

            // Foreign key for MataKuliahPraktikum
            $table->unsignedBigInteger('mata_kuliah_praktikum_id');
            $table->foreign('mata_kuliah_praktikum_id')->references('id')->on('mata_kuliah_praktikums')->onDelete('cascade');

            // Add any additional fields if needed, like timestamps
            $table->timestamps();

            // Composite primary key
            // $table->primary(['mahasiswa_praktikum_id', 'mata_kuliah_praktikum_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_mata_kuliah_praktikum');
    }
};
