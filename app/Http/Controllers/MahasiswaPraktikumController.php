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
        // Fetch all mahasiswa praktikum records

        $mataKuliahPraktikum = MataKuliahPraktikum::all();
        return view('mahasiswa_praktikum.index', compact('mataKuliahPraktikum')); // Return the index view with data

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa_praktikum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'npm' => 'required|unique:mahasiswa_praktikums,npm',
            'nama' => 'required|string|max:255'
        ]);

        // Create a new Mahasiswa record
        MahasiswaPraktikum::create($request->only('npm', 'nama'));

        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan');
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

        return redirect()->back()->with('success', 'Mahasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = MahasiswaPraktikum::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus');
    }
    public function import(Request $request, $mataKuliahId)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        // Import the Excel file with Mahasiswa data and Mata Kuliah ID
        Excel::import(new MahasiswaPraktikumImport($mataKuliahId), $request->file('file'));

        return redirect()->back()->with('success', 'Mahasiswa Praktikum data has been imported successfully.');
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

        return redirect()->back()->with('success', 'Semua data mahasiswa telah dihapus.');
    }
}
