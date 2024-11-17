<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPraktikum extends Model
{
    use HasFactory;

    protected $table = 'laporan_praktikum';

    protected $fillable = [
        'mata_kuliah_praktikum_id',
        'pertemuan',
        'tanggal_praktikum',
        'materi',
        'bukti_praktikum',
        'created_by'
    ];

    public function mataKuliahPraktikum()
    {
        return $this->belongsTo(MataKuliahPraktikum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
