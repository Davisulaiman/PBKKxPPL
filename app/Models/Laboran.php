<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboran extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'nama',
        'username',
        'user_id',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
