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
        Schema::create('absensi_mahasiswa_mata_kuliah_praktikums', function (Blueprint $table) {
            $table->id();

            // Foreign key column for the pivot table `mahasiswa_mata_kuliah_praktikum`
            $table->foreignId('mahasiswa_mata_kuliah_praktikum_id')
                ->constrained('mahasiswa_mata_kuliah_praktikum', 'id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->name('fk_absensi_mata_kuliah'); // Custom foreign key name

            // Attendance columns for pertemuan 1-10 with 'Tidak Ada Keterangan' as default
            $statuses = ['Hadir', 'Sakit', 'Izin', 'Alpa', 'Tidak Ada Keterangan'];
            $defaultStatus = 'Tidak Ada Keterangan';

            $table->enum('pertemuan_1', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_2', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_3', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_4', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_5', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_6', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_7', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_8', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_9', $statuses)->default($defaultStatus);
            $table->enum('pertemuan_10', $statuses)->default($defaultStatus);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_mahasiswa_mata_kuliah_praktikums');
    }
};
