<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPraktikum extends Model
{
    use HasFactory;

    protected $table = 'penilaian_praktikum';

    protected $fillable = ['mata_kuliah_praktikum_id', 'google_drive_link'];

    /**
     * Define the relationship with MataKuliahPraktikum.
     */
    public function mataKuliahPraktikum()
    {
        return $this->belongsTo(MataKuliahPraktikum::class, 'mata_kuliah_praktikum_id');
    }
}
