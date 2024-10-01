<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahPraktikum;
use Illuminate\Http\Request;

class MataKuliahPraktikumController extends Controller
{
    public function index()
    {
        $mataKuliahPraktikum = MataKuliahPraktikum::all();
        return view('mata_kuliah_praktikum', compact('mataKuliahPraktikum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('create_matkul');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mata_kuliah' => 'required|unique:mata_kuliah_praktikum',
            'nama_mata_kuliah' => 'required',
            'kelas' => 'required',
            'sks' => 'required|integer',
            'tanggal_praktikum' => 'required|date',
            'status_aktif' => 'required|boolean',
        ]);

        MataKuliahPraktikum::create($request->all());
        return redirect()->route('mata_kuliah_praktikum.index')->with('success', 'Mata Kuliah Praktikum berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliahPraktikum $mata_kuliah_praktikum)
    {
        return view('mata_kuliah_praktikum.edit', compact('mata_kuliah_praktikum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliahPraktikum $mata_kuliah_praktikum)
    {
        $request->validate([
            'nama_mata_kuliah' => 'required',
            'kelas' => 'required',
            'sks' => 'required|integer',
            'tanggal_praktikum' => 'required|date',
            'status_aktif' => 'required|boolean',
        ]);

        $mata_kuliah_praktikum->update($request->all());
        return redirect()->route('mata_kuliah_praktikum.index')->with('success', 'Mata Kuliah Praktikum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mata_kuliah_praktikum = MataKuliahPraktikum::findOrFail($id);
        $mata_kuliah_praktikum->delete();
        return redirect()->route('mata_kuliah_praktikum.index')->with('success', 'Mata Kuliah Praktikum berhasil dihapus.');
    }
}
