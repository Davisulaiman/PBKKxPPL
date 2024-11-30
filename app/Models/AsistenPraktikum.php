<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AsistenPraktikum extends Model
{
    use HasFactory;

    protected $table = 'asisten_praktikums';

    protected $fillable = ['npm', 'username', 'user_id'];

    // Definisikan relasi many-to-many ke MataKuliahPraktikum
    public function mataKuliahPraktikum()
    {
        return $this->belongsToMany(MataKuliahPraktikum::class, 'asisten_praktikum_mata_kuliah_praktikum');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
