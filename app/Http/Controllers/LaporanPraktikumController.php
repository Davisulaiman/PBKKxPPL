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
            // Ambil mata kuliah yang hanya terkait dengan asisten dosen yang login, tetap dengan pengurutan
            $mataKuliahPraktikum = $user->asistenPraktikum->mataKuliahPraktikum()
                ->orderBy('kode_mata_kuliah', 'asc')
                ->orderBy('kelas', 'asc')
                ->get();
        } else {
            // Laboran dan Kepala Lab dapat melihat semua mata kuliah dengan pengurutan
            $mataKuliahPraktikum = MataKuliahPraktikum::orderBy('kode_mata_kuliah', 'asc')
                ->orderBy('kelas', 'asc')
                ->get();
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
    public function edit(int $mata_kuliah_id, int $pertemuan)
    {
        $laporanPraktikum = LaporanPraktikum::where('mata_kuliah_praktikum_id', $mata_kuliah_id)
            ->where('pertemuan', $pertemuan)
            ->first();

        if (!$laporanPraktikum) {
            return redirect()->route('laporan_praktikum.index')
            ->with('error', 'Maaf, data laporan praktikum tidak ditemukan. Silakan tambahkan data terlebih dahulu.');
        }

        return view('laporan_praktikum.edit', compact('laporanPraktikum'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari laporan praktikum berdasarkan ID
        $laporanPraktikum = LaporanPraktikum::find($id);

        // Jika data tidak ditemukan, redirect dengan alert
        if (!$laporanPraktikum) {
            return redirect()->route('laporan_praktikum.index')
                ->with('error', 'Maaf, data laporan praktikum tersebut tidak ditemukan. Silakan tambahkan data terlebih dahulu.');
        }

        // Validasi data input
        $validatedData = $request->validate([
            'pertemuan' => 'required|integer|min:1|max:16',
            'materi' => 'required|string|max:255',
            'bukti_praktikum' => [
                'nullable',
                'url',
                'regex:/^(https:\/\/drive\.google\.com\/.*)$/'
            ]
        ]);

        // Perbarui data laporan praktikum
        $laporanPraktikum->update($validatedData);

        // Redirect ke halaman utama dengan pesan sukses
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
