<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPraktikum extends Model
{
    use HasFactory;

    protected $fillable = ['npm', 'nama'];

    /**
     * Define the relationship with MataKuliahPraktikum.
     */
// In MahasiswaPraktikum.php
public function mataKuliahPraktikum()
{
    return $this->belongsToMany(MataKuliahPraktikum::class, 'mahasiswa_mata_kuliah_praktikum')
        ->withPivot('id'); // Pivot table relationship, without a separate model
}

    /**
     * Define the relationship with AbsensiMahasiswaMataKuliahPraktikum.
     */
    public function absensi()
    {
        return $this->hasMany(AbsensiMahasiswaMataKuliahPraktikum::class, 'mahasiswa_mata_kuliah_praktikum_id');
    }
}
