<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahPraktikum extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah_praktikums';

    protected $fillable = ['kode_mata_kuliah', 'nama_mata_kuliah', 'kelas', 'sks', 'tanggal_praktikum', 'status_aktif'];

    /**
     * Define the relationship with MahasiswaPraktikum.
     */
    public function mahasiswaPraktikum()
    {
        return $this->belongsToMany(MahasiswaPraktikum::class, 'mahasiswa_mata_kuliah_praktikum')
            ->withPivot('id'); // Pivot table relationship, without a separate model
    }

    /**
     * Define the relationship with AsistenPraktikum.
     */
    public function asistenPraktikum()
    {
        return $this->belongsToMany(AsistenPraktikum::class, 'asisten_praktikum_mata_kuliah_praktikum');
    }

    public function laporanPraktikum()
    {
        return $this->hasMany(LaporanPraktikum::class, 'mata_kuliah_praktikum_id');
    }

    public function penilaianPraktikum()
{
    return $this->hasMany(PenilaianPraktikum::class, 'mata_kuliah_praktikum_id');
}

}
