<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswaMataKuliahPraktikum extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = [
        'mahasiswa_mata_kuliah_praktikum_id',
        'pertemuan_1',
        'pertemuan_2',
        'pertemuan_3',
        'pertemuan_4',
        'pertemuan_5',
        'pertemuan_6',
        'pertemuan_7',
        'pertemuan_8',
        'pertemuan_9',
        'pertemuan_10',
    ];

    // Define constants for attendance status
    public const STATUS_HADIR = 'Hadir';
    public const STATUS_SAKIT = 'Sakit';
    public const STATUS_IZIN = 'Izin';
    public const STATUS_ALPA = 'Alpa';
    public const STATUS_TIDAK_ADA_KETERANGAN = 'Tidak Ada Keterangan';

    // Define available statuses as an array
    public static function getStatuses()
    {
        return [
            self::STATUS_HADIR,
            self::STATUS_SAKIT,
            self::STATUS_IZIN,
            self::STATUS_ALPA,
            self::STATUS_TIDAK_ADA_KETERANGAN,
        ];
    }

    /**
     * Define the relationship with the MahasiswaPraktikum model through the pivot.
     */
    // public function mataKuliahPraktikum()
    // {
    //     return $this->belongsToMany(MataKuliahPraktikum::class, 'mahasiswa_mata_kuliah_praktikum')
    //                 ->withPivot('id'); // Include pivot fields if needed
    // }

    public function mahasiswaMataKuliahPraktikum()
    {
        return $this->belongsTo(MahasiswaMataKuliahPraktikum::class);
    }

}
