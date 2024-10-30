<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AsistenPraktikum;
use App\Models\MataKuliahPraktikum;

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

        $this->call(UsersTableSeeder::class);

            // Membuat beberapa Asisten Praktikum
            $asisten1 = AsistenPraktikum::create(['npm' => '123456789', 'nama_praktikan' => 'John Doe', 'username' => 'johndoe']);
            $asisten2 = AsistenPraktikum::create(['npm' => '987654321', 'nama_praktikan' => 'Jane Doe', 'username' => 'janedoe']);

            // Membuat beberapa Mata Kuliah Praktikum
            $mataKuliah1 = MataKuliahPraktikum::create(['kode_mata_kuliah' => 'MK001', 'nama_mata_kuliah' => 'Pemrograman 1', 'kelas' => 'A', 'sks' => 3, 'tanggal_praktikum' => '2024-10-01', 'status_aktif' => true]);
            $mataKuliah2 = MataKuliahPraktikum::create(['kode_mata_kuliah' => 'MK002', 'nama_mata_kuliah' => 'Jaringan Komputer', 'kelas' => 'B', 'sks' => 3, 'tanggal_praktikum' => '2024-10-02', 'status_aktif' => true]);

            $asisten1->mataKuliahPraktikum()->attach([$mataKuliah1->id, $mataKuliah2->id]);
            $asisten2->mataKuliahPraktikum()->attach($mataKuliah2->id);

    }


}
