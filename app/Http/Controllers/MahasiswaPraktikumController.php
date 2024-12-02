<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaPraktikumImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MahasiswaPraktikum;
use App\Models\MataKuliahPraktikum;

class MahasiswaPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all mata kuliah records with sorting
        $mataKuliahPraktikum = MataKuliahPraktikum::orderBy('kode_mata_kuliah', 'asc')
            ->orderBy('kelas', 'asc')
            ->get();

        // Fetch all mahasiswa records with sorting
        $mahasiswas = MahasiswaPraktikum::orderBy('nama', 'asc')
            ->orderBy('npm', 'asc')
            ->get();

        return view('mahasiswa_praktikum.index', compact('mataKuliahPraktikum', 'mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id)
    {
        return view('mahasiswa_praktikum.create', [
            'mataKuliahPraktikum' => MataKuliahPraktikum::findOrFail($id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'npm' => 'required|unique:mahasiswa_praktikums,npm',
            'nama' => 'required|string|max:255',
            'mata_kuliah_praktikum_id' => 'required|exists:mata_kuliah_praktikums,id',
        ]);

        // Create a new Mahasiswa record
        $mahasiswa = MahasiswaPraktikum::create($request->only('npm', 'nama'));

        $mahasiswa->mataKuliahPraktikum()->syncWithoutDetaching([$request->mata_kuliah_praktikum_id]);

        return redirect()->route('mahasiswa_praktikum.index')->with('success', 'Mahasiswa Praktikum berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch mata kuliah based on ID
        $mataKuliah = MataKuliahPraktikum::findOrFail($id);

        // Fetch Mahasiswa related to this mata kuliah using the pivot table
        $mahasiswas = $mataKuliah->mahasiswaPraktikum()->get();

        return view('mahasiswa_praktikum.show', compact('mahasiswas', 'mataKuliah'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = MahasiswaPraktikum::findOrFail($id);
        return view('mahasiswa_praktikum.edit', compact('mahasiswa'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = MahasiswaPraktikum::findOrFail($id);

        // Validate the input data
        $request->validate([
            'npm' => 'required|unique:mahasiswa_praktikums,npm,' . $mahasiswa->id,
            'nama' => 'required|string|max:255'
        ]);

        // Update Mahasiswa data
        $mahasiswa->update($request->only('npm', 'nama'));

        return redirect()->route('mahasiswa_praktikum.index')->with('success', 'Mahasiswa Praktikum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = MahasiswaPraktikum::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa_praktikum.index')->with('success', 'Mahasiswa Praktikum berhasil dihapus.');
    }
    public function import(Request $request, $mataKuliahId)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Import the Excel file with Mahasiswa data and Mata Kuliah ID
        Excel::import(new MahasiswaPraktikumImport($mataKuliahId), $request->file('file'));

        return redirect()->route('mahasiswa_praktikum.index')->with('success', 'Data mahasiswa berhasil diimport.');
    }

    public function deleteAll($mataKuliahId)
    {
        $mataKuliah = MataKuliahPraktikum::findOrFail($mataKuliahId);

        // Find all related MahasiswaPraktikum and delete them
        $mahasiswas = $mataKuliah->mahasiswaPraktikum;
        foreach ($mahasiswas as $mahasiswa) {
            $mahasiswa->delete(); // Delete each mahasiswa
        }

        // Optionally, detach all just to ensure the pivot table is cleaned up
        $mataKuliah->mahasiswaPraktikum()->detach();

        return redirect()->route('mahasiswa_praktikum.index')->with('success', 'Semua data mahasiswa dihapus.');
    }
}
