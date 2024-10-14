<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AsistenPraktikum extends Authenticatable
{
    use HasFactory;

    protected $table = 'asisten_praktikum';
    protected $fillable = ['id', 'NPM','nama_praktikan', 'username', 'password', 'mata_kuliah_id'];

    // Relasi ke tabel MataKuliahPraktikum
    public function mataKuliahPraktikum()
    {
        return $this->belongsTo(MataKuliahPraktikum::class, 'mata_kuliah_id');
    }
}
