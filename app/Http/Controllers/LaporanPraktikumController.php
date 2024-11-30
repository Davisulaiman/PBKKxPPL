<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPraktikum;
use App\Models\MataKuliahPraktikum;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

class LaporanPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Cek peran pengguna: asisten_dosen, laboran, atau kepala_lab
        if ($user->role === 'asisten_dosen') {
            // Ambil mata kuliah yang hanya terkait dengan asisten dosen yang login
            $mataKuliahPraktikum = $user->asistenPraktikum->mataKuliahPraktikum ?? collect(); // Pastikan hubungan sudah terdefinisi di model
        } else {
            // Laboran dan Kepala Lab dapat melihat semua mata kuliah
            $mataKuliahPraktikum = MataKuliahPraktikum::all();
        }

        return view('laporan_praktikum.index', compact('mataKuliahPraktikum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($mata_kuliah_id, $pertemuan)
    {
        $mataKuliahPraktikum = MataKuliahPraktikum::findOrFail($mata_kuliah_id);
        return view('laporan_praktikum.create', compact('mataKuliahPraktikum', 'pertemuan'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
{
    // Debugging log untuk mengecek nilai bukti_praktikum
    // dd($request->bukti_praktikum);

    // $this->authorize('create', LaporanPraktikum::class);

    $request->validate([
        'mata_kuliah_praktikum_id' => 'required|exists:mata_kuliah_praktikums,id',
        'pertemuan' => 'required|integer|min:1|max:16',
        'tanggal_praktikum' => 'required|date',
        'materi' => 'required|string',
        'bukti_praktikum' => [
            'nullable',
            'url',
            'regex:/^(https:\/\/drive\.google\.com\/.*)$/'
        ] // Validasi untuk memastikan bahwa link Google Drive sesuai pola tertentu
    ]);

    $laporan = LaporanPraktikum::create([
        'mata_kuliah_praktikum_id' => $request->mata_kuliah_praktikum_id,
        'pertemuan' => $request->pertemuan,
        'tanggal_praktikum' => $request->tanggal_praktikum,
        'materi' => $request->materi,
        'bukti_praktikum' => $request->bukti_praktikum,
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

    public function rekap(int $mata_kuliah_id)
    {
        // Ambil semua laporan praktikum dari pertemuan 1-16 untuk mata kuliah terkait
        $laporan = LaporanPraktikum::where('mata_kuliah_praktikum_id', $mata_kuliah_id)
            ->whereBetween('pertemuan', [1, 16])
            ->orderBy('pertemuan')
            ->get();

        $mataKuliah = MataKuliahPraktikum::findOrFail($mata_kuliah_id);

        return view('laporan_praktikum.rekap', compact('laporan', 'mataKuliah'));
    }

    public function rekapPdf(int $mata_kuliah_id)
    {
        // Ambil data mata kuliah dan laporan
        $mataKuliah = MataKuliahPraktikum::findOrFail($mata_kuliah_id);
        $laporan = LaporanPraktikum::where('mata_kuliah_praktikum_id', $mata_kuliah_id)
            ->orderBy('pertemuan')
            ->get();

        // Dapatkan asisten untuk mata kuliah ini melalui tabel pivot
        $asistenPraktikum = $mataKuliah->asistenPraktikum;

        // Ambil dua asisten pertama
        $asistenDosen1 = $asistenPraktikum->first();
        $asistenDosen2 = $asistenPraktikum->skip(1)->first();

        // Ambil user untuk setiap asisten dengan fallback
        $userAsistenDosen1 = $asistenDosen1 ? $asistenDosen1->user : null;
        $userAsistenDosen2 = $asistenDosen2 ? $asistenDosen2->user : null;

        // Siapkan data untuk PDF dengan fallback
        $pdf = Pdf::loadView('laporan_praktikum.rekap_pdf', [
            'laporan' => $laporan,
            'mataKuliah' => $mataKuliah,
            'asistenDosen1' => $userAsistenDosen1 ?? new User(), // Fallback ke objek kosong
            'asistenDosen2' => $userAsistenDosen2 ?? new User() // Fallback ke objek kosong
        ])->setPaper('a4', 'portrait');

        // Return file PDF untuk diunduh
        return $pdf->download('rekap_laporan_praktikum_' . $mataKuliah->kode_mata_kuliah . '.pdf');
    }
}
