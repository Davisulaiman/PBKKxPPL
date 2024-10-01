<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahPraktikum extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah_praktikum';
    protected $fillable = [
        'kode_mata_kuliah',
        'nama_mata_kuliah',
        'kelas',
        'sks',
        'tanggal_praktikum',
        'status_aktif',
    ];
}
