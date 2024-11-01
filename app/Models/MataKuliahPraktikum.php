<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahPraktikum extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah_praktikums';

    protected $fillable = ['kode_mata_kuliah', 'nama_mata_kuliah', 'kelas', 'sks', 'tanggal_praktikum', 'status_aktif'];

    public function asistenPraktikum()
    {
        return $this->belongsToMany(AsistenPraktikum::class, 'asisten_praktikum_mata_kuliah_praktikum');
    }

    public function mahasiswaPraktikum()
    {
        return $this->belongsToMany(MahasiswaPraktikum::class, 'mahasiswa_mata_kuliah_praktikum');
    }
}
