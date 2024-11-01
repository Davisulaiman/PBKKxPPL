<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPraktikum extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'npm'];

    // Specify any relationships, accessors, or mutators if needed
    // Example: Relationship with MataKuliah model, if needed
    public function mataKuliahPraktikum()
    {
        return $this->belongsToMany(MataKuliahPraktikum::class, 'mahasiswa_mata_kuliah_praktikum');
    }

}
