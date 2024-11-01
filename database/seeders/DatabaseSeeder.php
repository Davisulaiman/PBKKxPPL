<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AsistenPraktikum;
use App\Models\MataKuliahPraktikum;
use App\Models\MahasiswaPraktikum;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Membuat beberapa Asisten Praktikum
        // $asisten2 = AsistenPraktikum::create(attributes: ['npm' => '987654321',  'username' => 'janedoe']);
        // $asisten1 = AsistenPraktikum::create(['npm' => '123456789',  'username' => 'johndoe']);

        // // Membuat beberapa Mata Kuliah Praktikum
        // $mataKuliah1 = MataKuliahPraktikum::create(['kode_mata_kuliah' => 'MK001', 'nama_mata_kuliah' => 'Pemrograman 1', 'kelas' => 'A', 'sks' => 3, 'tanggal_praktikum' => '2024-10-01', 'status_aktif' => true]);
        // $mataKuliah2 = MataKuliahPraktikum::create(['kode_mata_kuliah' => 'MK002', 'nama_mata_kuliah' => 'Jaringan Komputer', 'kelas' => 'B', 'sks' => 3, 'tanggal_praktikum' => '2024-10-02', 'status_aktif' => true]);

        // $asisten1->mataKuliahPraktikum()->attach([$mataKuliah1->id, $mataKuliah2->id]);
        // $asisten2->mataKuliahPraktikum()->attach($mataKuliah2->id);

        // Seed Mahasiswa
        $mahasiswa1 = MahasiswaPraktikum::create([
            'nama' => 'Andi',
            'npm' => '1234567890',
        ]);

        $mahasiswa2 = MahasiswaPraktikum::create([
            'nama' => 'Budi',
            'npm' => '1234567891',
        ]);

        $mahasiswa3 = MahasiswaPraktikum::create([
            'nama' => 'Cindy',
            'npm' => '1234567892',
        ]);

        // Seed Mata Kuliah Praktikum
        $mataKuliah1 = MataKuliahPraktikum::create([
            'kode_mata_kuliah' => 'MK001',
            'nama_mata_kuliah' => 'Pemrograman Dasar',
            'kelas' => 'A',
            'sks' => 3,
            'tanggal_praktikum' => '2024-01-10',
            'status_aktif' => true,
        ]);

        $mataKuliah2 = MataKuliahPraktikum::create([
            'kode_mata_kuliah' => 'MK002',
            'nama_mata_kuliah' => 'Struktur Data',
            'kelas' => 'B',
            'sks' => 4,
            'tanggal_praktikum' => '2024-01-11',
            'status_aktif' => true,
        ]);

        // Populate the pivot table
        $mahasiswa1->mataKuliahPraktikum()->attach([$mataKuliah1->id]);
        $mahasiswa2->mataKuliahPraktikum()->attach([$mataKuliah1->id, $mataKuliah2->id]);
        $mahasiswa3->mataKuliahPraktikum()->attach([$mataKuliah2->id]);
        $this->call(UsersTableSeeder::class);
    }
}
