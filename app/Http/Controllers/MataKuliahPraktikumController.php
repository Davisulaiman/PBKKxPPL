<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahPraktikum;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class MataKuliahPraktikumController extends Controller
{
    public function index()
    {
        $mataKuliahPraktikum = MataKuliahPraktikum::orderBy('kode_mata_kuliah', 'asc')
                                                    ->orderBy('kelas', 'asc')
                                                    ->get();

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
            'kode_mata_kuliah' => 'required',
            'nama_mata_kuliah' => 'required',
            'kelas' => 'required',
            'sks' => 'required|integer',
            'tanggal_praktikum' => 'required|date',
            'status_aktif' => 'required|boolean',
        ]);

        $matkul = MataKuliahPraktikum::where('kode_mata_kuliah', $request->kode_mata_kuliah)->first();

        if (isNull($matkul)) {
            MataKuliahPraktikum::create($request->all());
            return redirect()->route('mata_kuliah_praktikum.index')->with('success', 'Mata Kuliah Praktikum berhasil ditambahkan.');
        }
        if ($matkul->kelas == $request->kelas) {
            return redirect()->route('mata_kuliah_praktikum.index')->with('error', 'Mata Kuliah Praktikum dengan kode ' . $request->kode_mata_kuliah . ' sudah ada.');
        }else{
            MataKuliahPraktikum::create($request->all());
            return redirect()->route('mata_kuliah_praktikum.index')->with('success', 'Mata Kuliah Praktikum berhasil ditambahkan.');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $mata_kuliah_praktikum = MataKuliahPraktikum::where('kode_mata_kuliah', $id)->first()->getAttributes();
        return view('edit_matkul', ['id' => $id, 'mata_kuliah_praktikum' => compact('mata_kuliah_praktikum')['mata_kuliah_praktikum']]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mata_kuliah' => 'required',
            'nama_mata_kuliah' => 'required',
            'kelas' => 'required',
            'sks' => 'required|integer',
            'tanggal_praktikum' => 'required|date',
            'status_aktif' => 'required|boolean',
        ]);

        MataKuliahPraktikum::where('kode_mata_kuliah', $id)->first()->update($request->all());
        return redirect()->route('mata_kuliah_praktikum.index')->with('success', 'Mata Kuliah Praktikum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MataKuliahPraktikum::where('kode_mata_kuliah', $id)->first()->delete();
        return redirect()->route('mata_kuliah_praktikum.index')->with('success', 'Mata Kuliah Praktikum berhasil dihapus.');
    }

}
