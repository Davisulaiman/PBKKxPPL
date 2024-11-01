<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('asisten_praktikum_mata_kuliah_praktikum')) {
            Schema::create('asisten_praktikum_mata_kuliah_praktikum', function (Blueprint $table) {
                $table->id();

                // Define foreign key using singular name
                $table->foreignId('asisten_praktikum_id')
                    ->constrained('asisten_praktikums')
                    ->onDelete('cascade')
                    ->name('fk_asisten_praktikum'); // Use singular for consistency

                // Define foreign key with singular name
                $table->foreignId('mata_kuliah_praktikum_id')
                    ->constrained('mata_kuliah_praktikums')
                    ->onDelete('cascade')
                    ->name('fk_mata_kuliah_praktikum');

                $table->timestamps();

                // Define unique constraint with correct names
                $table->unique(['asisten_praktikum_id', 'mata_kuliah_praktikum_id'], 'asisten_matkul_unique');
            });

    }
}

    public function down()
    {
        Schema::dropIfExists('asisten_praktikum_mata_kuliah_praktikum');
    }
};
