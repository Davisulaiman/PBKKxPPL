<?php

namespace App\Imports;

use App\Models\MahasiswaPraktikum;
use App\Models\MataKuliahPraktikum;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaPraktikumImport implements ToModel, WithHeadingRow
{
    protected $mataKuliahId;

    public function __construct($mataKuliahId)
    {
        $this->mataKuliahId = $mataKuliahId;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Find or create the MahasiswaPraktikum record based on NPM
        $mahasiswa = MahasiswaPraktikum::firstOrCreate(
            ['npm' => $row['npm']], // Assuming 'npm' is the column name in the Excel file
            ['nama' => $row['nama']] // Assuming 'nama' is the column name in the Excel file
        );

        // Attach MahasiswaPraktikum to MataKuliahPraktikum via pivot table
        $mahasiswa->mataKuliahPraktikum()->syncWithoutDetaching([$this->mataKuliahId]);

        return $mahasiswa;
    }
}
