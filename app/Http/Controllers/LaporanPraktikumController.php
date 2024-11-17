<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPraktikum;
use App\Models\MataKuliahPraktikum;
use Illuminate\Support\Facades\Auth;

class LaporanPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil hanya mata kuliah terkait dengan user yang login (misalnya sebagai asisten dosen)
        $userId = Auth::id(); // Dapatkan user yang login
        $mataKuliahPraktikum = MataKuliahPraktikum::all();

        // Ambil semua laporan praktikum dengan relasi ke mata kuliah
        $laporanPraktikum = LaporanPraktikum::with('mataKuliahPraktikum')->get();

        return view('laporan_praktikum.index', compact('mataKuliahPraktikum', 'laporanPraktikum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only accessible for assistant_dosen
        $this->authorize('create', LaporanPraktikum::class);

        // Ambil mata kuliah untuk dropdown atau pilihan lainnya
        $mataKuliahPraktikum = MataKuliahPraktikum::all();
        return view('laporan_praktikum.create', compact('mataKuliahPraktikum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', LaporanPraktikum::class);

        $request->validate([
            'mata_kuliah_praktikum_id' => 'required|exists:mata_kuliah_praktikums,id',
            'pertemuan' => 'required|integer|min:1|max:16',
            'tanggal_praktikum' => 'required|date',
            'materi' => 'required|string',
            'bukti_praktikum' => 'nullable|url'
        ]);

        LaporanPraktikum::create([
            'mata_kuliah_praktikum_id' => $request->mata_kuliah_praktikum_id,
            'pertemuan' => $request->pertemuan,
            'tanggal_praktikum' => $request->tanggal_praktikum,
            'materi' => $request->materi,
            'bukti_praktikum' => $request->bukti_praktikum, // Perbaikan pada nama input
            'created_by' => Auth::id()
        ]);

        return redirect()->route('laporan_praktikum.index')->with('success', 'Laporan praktikum berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd('lorem');
        // Retrieve MataKuliahPraktikum by ID
        $mataKuliah = MataKuliahPraktikum::findOrFail($id);

        // Pass data to view
        return view('laporan_praktikum.show', compact('mataKuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tampilkan form edit laporan praktikum
        $laporanPraktikum = LaporanPraktikum::findOrFail($id);
        return view('laporan_praktikum.edit', compact('laporanPraktikum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update laporan praktikum
        $laporanPraktikum = LaporanPraktikum::findOrFail($id);

        $request->validate([
            'pertemuan' => 'required|integer|min:1|max:16',
            'materi' => 'required|string',
            'bukti_praktikum' => 'nullable|url'
        ]);

        $laporanPraktikum->update([
            'pertemuan' => $request->pertemuan,
            'materi' => $request->materi,
            'bukti_praktikum' => $request->bukti_praktikum,
        ]);

        return redirect()->route('laporan_praktikum.index')->with('success', 'Laporan praktikum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus laporan praktikum
        $laporanPraktikum = LaporanPraktikum::findOrFail($id);
        $laporanPraktikum->delete();

        return redirect()->route('laporan_praktikum.index')->with('success', 'Laporan praktikum berhasil dihapus.');
    }

    public function print(int $mata_kuliah_id, int $pertemuan)
    {
        return view('laporan_praktikum.print', [
            'mata_kuliah_id' => $mata_kuliah_id,
            'pertemuan' => $pertemuan,
            'laporan' => LaporanPraktikum::where('mata_kuliah_praktikum_id', $mata_kuliah_id)->where('pertemuan', $pertemuan)->first()
        ]);
    }
}
