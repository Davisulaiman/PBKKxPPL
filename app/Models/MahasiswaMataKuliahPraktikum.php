<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMataKuliahPraktikum extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default plural form
    protected $table = 'mahasiswa_mata_kuliah_praktikum';

    // Define the fillable attributes (if you plan to insert or update records via mass-assignment)
    protected $fillable = [
        'mahasiswa_praktikum_id',
        'mata_kuliah_praktikum_id',
    ];

    /**
     * Define the relationship with MahasiswaPraktikum.
     */
    public function mahasiswaPraktikum()
    {
        return $this->belongsTo(MahasiswaPraktikum::class, 'mahasiswa_praktikum_id');
    }

    /**
     * Define the relationship with MataKuliahPraktikum.
     */
    public function mataKuliahPraktikum()
    {
        return $this->belongsTo(MataKuliahPraktikum::class, 'mata_kuliah_praktikum_id');
    }

    /**
     * Define the relationship with AbsensiMahasiswaMataKuliahPraktikum.
     */
    public function absensi()
    {
        return $this->hasOne(AbsensiMahasiswaMataKuliahPraktikum::class, 'mahasiswa_mata_kuliah_praktikum_id');
    }
}
