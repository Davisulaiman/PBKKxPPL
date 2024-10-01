<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahPraktikumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliah_praktikum', function (Blueprint $table) {
            // Kolom nomor sebagai auto increment ID
            $table->id('nomor');

            // Kode Mata Kuliah sebagai primary key
            $table->string('kode_mata_kuliah')->unique();

            // Kolom lainnya
            $table->string('nama_mata_kuliah');

            // Kolom kelas dengan tipe enum (pilihan A atau B)
            $table->enum('kelas', ['A', 'B']);

            // Jumlah SKS (integer)
            $table->integer('sks');

            // Tanggal Praktikum
            $table->date('tanggal_praktikum');

            // Status Aktif sebagai boolean (Aktif, Tidak Aktif)
            $table->boolean('status_aktif')->default(true); // 1 = Aktif, 0 = Tidak Aktif

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mata_kuliah_praktikum');
    }
}
