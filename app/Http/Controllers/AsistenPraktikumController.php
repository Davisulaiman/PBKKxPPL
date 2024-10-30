<?php

namespace App\Http\Controllers;

use App\Models\AsistenPraktikum;
use App\Models\MataKuliahPraktikum;
use Illuminate\Http\Request;

class AsistenPraktikumController extends Controller
{
    public function index()
    {
        // Mengambil semua data Asisten Praktikum beserta Mata Kuliah Praktikum yang terhubung
        $asistenPraktikum = AsistenPraktikum::with('MataKuliahPraktikum')->get();
        return view('asisten_praktikum', compact('asistenPraktikum'));
    }

    public function create()
    {
        // Mengambil data Mata Kuliah Praktikum yang aktif
        $mataKuliahPraktikum = MataKuliahPraktikum::where('status_aktif', true)->get();
        return view('create_asisten_praktikum', compact('mataKuliahPraktikum'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'npm' => 'required|unique:asisten_praktikum',
            'nama_praktikan' => 'required',
            'username' => 'required|unique:asisten_praktikum',
            'mata_kuliah_praktikum_id' => 'required|array',
        ]);

        // Membuat Asisten Praktikum baru
        $asistenPraktikum = AsistenPraktikum::create($request->only(['npm', 'nama_praktikan', 'username']));

        // Menghubungkan Asisten Praktikum dengan Mata Kuliah Praktikum yang dipilih
        $asistenPraktikum->mataKuliahPraktikum()->attach($request->mata_kuliah_praktikum_id);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('asisten_praktikum')->with('success', 'Asisten Praktikum berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Mengambil data Asisten Praktikum berdasarkan ID
        $asisten = AsistenPraktikum::findOrFail($id);

        // Mengambil data Mata Kuliah Praktikum yang aktif
        $mataKuliahPraktikum = MataKuliahPraktikum::where('status_aktif', true)->get();

        // Mengambil Mata Kuliah Praktikum yang sudah dipilih sebelumnya
        $selectedMataKuliah = $asisten->mataKuliahPraktikum->pluck('id')->toArray();

        // Mengirim data ke view edit
        return view('asisten_praktikum.edit', compact('asisten', 'mataKuliahPraktikum', 'selectedMataKuliah'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'npm' => 'required|unique:asisten_praktikum,npm,'.$id,
            'nama_praktikan' => 'required',
            'username' => 'required|unique:asisten_praktikum,username,'.$id,
            'mata_kuliah' => 'required|array',
            'mata_kuliah.*' => 'exists:mata_kuliah_praktikum,id'
        ]);

        // Mengambil data Asisten Praktikum berdasarkan ID
        $asisten = AsistenPraktikum::findOrFail($id);

        // Memperbarui data Asisten Praktikum
        $asisten->update([
            'npm' => $request->npm,
            'nama_praktikan' => $request->nama_praktikan,
            'username' => $request->username
        ]);

        // Sinkronisasi Mata Kuliah Praktikum yang dipilih
        $asisten->MataKuliahPraktikum()->sync($request->mata_kuliah);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('asisten_praktikum')
            ->with('success', 'Asisten Praktikum berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Mengambil data Asisten Praktikum berdasarkan ID
        $asisten = AsistenPraktikum::findOrFail($id);

        // Menghapus semua relasi dengan Mata Kuliah Praktikum
        $asisten->MataKuliahPraktikum()->detach();

        // Menghapus Asisten Praktikum
        $asisten->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('asisten_praktikum')
            ->with('success', 'Asisten Praktikum berhasil dihapus.');
    }
}
