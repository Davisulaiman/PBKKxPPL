<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPraktikum extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'npm'];

    /**
     * Define the relationship with MataKuliahPraktikum.
     */
    public function mataKuliahPraktikum()
    {
        return $this->belongsToMany(MataKuliahPraktikum::class, 'mahasiswa_mata_kuliah_praktikum')
                    ->withPivot('id'); // Include pivot fields if needed
    }

    /**
     * Define the relationship with AbsensiMahasiswaMataKuliahPraktikum.
     */
    public function absensi()
    {
        return $this->hasMany(AbsensiMahasiswaMataKuliahPraktikum::class, 'mahasiswa_mata_kuliah_praktikum_id');
    }
}
