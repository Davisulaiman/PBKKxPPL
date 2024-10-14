<?php

namespace App\Http\Controllers;

use App\Models\AsistenPraktikum;
use App\Models\MataKuliahPraktikum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsistenPraktikumController extends Controller
{
    // Menampilkan daftar asisten praktikum
    public function index()
    {
        // Mengambil semua data asisten beserta mata kuliah yang terhubung
        $asistenPraktikum = AsistenPraktikum::with('mataKuliahPraktikum')->get();

        return view('asisten_praktikum', compact('asistenPraktikum'));
    }

    // Menampilkan form untuk menambah asisten praktikum
    public function create()
    {
        // Mengambil data mata kuliah untuk dropdown
        $mataKuliahPraktikum = MataKuliahPraktikum::all();
        return view('create_asisten_praktikum', compact('mataKuliahPraktikum'));
    }

    // Menyimpan data asisten praktikum

    public function store(Request $request)
    {
        // Validasi input yang diberikan
        $request->validate([
            'npm' => 'required|string|max:20|unique:asisten_praktikum,npm',
            'nama_praktikan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:asisten_praktikum',
            'password' => 'required|string|min:8|confirmed',
            'mata_kuliah_id' => 'required|integer|exists:mata_kuliah_praktikum,id',
        ]);

        // Buat asisten praktikum baru
        $asisten = new AsistenPraktikum();
        $asisten->npm = $request->npm;
        $asisten->nama_praktikan = $request->nama_praktikan;
        $asisten->username = $request->username;

        // Hash password sebelum disimpan
        $asisten->password = bcrypt($request->password);

        $asisten->mata_kuliah_id = $request->mata_kuliah_id;
        $asisten->save();

        // Redirect ke halaman daftar asisten praktikum dengan pesan sukses
        return redirect()->route('asisten_praktikum.index')
                         ->with('success', 'Asisten praktikum berhasil ditambahkan.');
    }


    // Mengedit data asisten
    public function edit($id)
    {
        $asistenPraktikum = AsistenPraktikum::find($id);
        $mataKuliahPraktikum = MataKuliahPraktikum::all();
        return view('asisten_praktikum.edit', compact('asistenPraktikum', 'mataKuliahPraktikum'));
    }

    // Memperbarui data asisten praktikum
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_praktikan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:asisten_praktikum,username,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'mata_kuliah_id' => 'required|integer|exists:mata_kuliah_praktikum,id',
        ]);

        $asistenPraktikum = AsistenPraktikum::find($id);
        $asistenPraktikum->nama_praktikan = $request->nama_praktikan;
        $asistenPraktikum->username = $request->username;
        $asistenPraktikum->mata_kuliah_id = $request->mata_kuliah_id;

        // Jika ada input password, lakukan update
        if ($request->password) {
            $asistenPraktikum->password = Hash::make($request->password);
        }

        $asistenPraktikum->save();
        return redirect()->route('asisten_praktikum.index')->with('success', 'Asisten Praktikum Berhasil Diperbarui.');
    }

    // Menghapus asisten praktikum
    public function destroy($id)
    {
        $asistenPraktikum = AsistenPraktikum::find($id);
        $asistenPraktikum->delete();
        return redirect()->route('asisten_praktikum.index')->with('success', 'Asisten Praktikum Berhasil Dihapus.');
    }
}
