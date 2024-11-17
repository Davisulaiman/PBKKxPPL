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
        Schema::create('laporan_praktikum', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_kuliah_praktikum_id');
            $table->integer('pertemuan');
            $table->string('materi');
            $table->date('tanggal_praktikum');
            $table->string('bukti_praktikum')->nullable();
            $table->unsignedBigInteger('created_by'); // user ID who created the report
            $table->timestamps();

            $table->foreign('mata_kuliah_praktikum_id')->references('id')->on('mata_kuliah_praktikums');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_praktikums');
    }
};
