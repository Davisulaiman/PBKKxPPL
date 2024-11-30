<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenilaianPraktikum;
use App\Models\MataKuliahPraktikum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PenilaianPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Cek peran pengguna: asisten_dosen, laboran, atau kepala_lab
        if ($user->role === 'asisten_dosen') {
            // Ambil mata kuliah hanya terkait dengan asisten dosen yang login
            $penilaianPraktikum = PenilaianPraktikum::whereHas('mataKuliahPraktikum', function ($query) use ($user) {
                $query->whereIn('id', $user->asistenPraktikum->mataKuliahPraktikum->pluck('id')); // Sesuaikan dengan relasi
            })->with(['mataKuliahPraktikum'])->get();
        } else {
            // Laboran dan Kepala Lab dapat melihat semua penilaian
            $penilaianPraktikum = PenilaianPraktikum::with(['mataKuliahPraktikum' => function($query) {
                $query->orderBy('kode_mata_kuliah', 'asc')
                      ->orderBy('kelas', 'asc');
            }])->get();
        }

        return view('penilaian_praktikum.index', compact('penilaianPraktikum'));
    }

    public function create()
    {
        $user = auth()->user();

        // Hanya ambil mata kuliah terkait untuk asisten dosen yang login
        $mataKuliahPraktikum = $user->role === 'asisten_dosen'
            ? $user->asistenPraktikum->mataKuliahPraktikum ?? collect()
            : MataKuliahPraktikum::all();

        return view('penilaian_praktikum.create', compact('mataKuliahPraktikum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_praktikum_id' => 'required|exists:mata_kuliah_praktikums,id',
            'google_drive_link' => [
                'required',
                'url',
                'regex:/^(https:\/\/drive\.google\.com\/.*)$/'
            ],
        ]);

        $user = auth()->user();

        // Validasi tambahan untuk memastikan asisten dosen hanya mengakses mata kuliah yang terkait
        if ($user->role === 'asisten_dosen' && !$user->asistenPraktikum->mataKuliahPraktikum->pluck('id')->contains($request->mata_kuliah_praktikum_id)) {
            abort(403, 'Anda tidak memiliki akses untuk mata kuliah ini.');
        }

        PenilaianPraktikum::create($request->all());
        return redirect()->route('penilaian_praktikum.index')->with('success', 'Penilaian Praktikum berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $penilaianPraktikum = PenilaianPraktikum::findOrFail($id);
        $user = auth()->user();

        // Cek akses untuk asisten dosen
        if ($user->role === 'asisten_dosen' && !$user->asistenPraktikum->mataKuliahPraktikum->pluck('id')->contains($penilaianPraktikum->mata_kuliah_praktikum_id)) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit penilaian ini.');
        }

        $mataKuliahPraktikum = $user->role === 'asisten_dosen'
            ? $user->asistenPraktikum->mataKuliahPraktikum ?? collect()
            : MataKuliahPraktikum::all();

        return view('penilaian_praktikum.edit', compact('penilaianPraktikum', 'mataKuliahPraktikum'));
    }

    public function update(Request $request, string $id)
    {
        $penilaianPraktikum = PenilaianPraktikum::findOrFail($id);
        $user = auth()->user();

        // Cek akses untuk asisten dosen
        if ($user->role === 'asisten_dosen' && !$user->asistenPraktikum->mataKuliahPraktikum->pluck('id')->contains($penilaianPraktikum->mata_kuliah_praktikum_id)) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate penilaian ini.');
        }

        $request->validate([
            'mata_kuliah_praktikum_id' => 'required|exists:mata_kuliah_praktikums,id',
            'google_drive_link' => [
                'required',
                'url',
                'regex:/^(https:\/\/drive\.google\.com\/.*)$/'
            ],
        ]);

        $penilaianPraktikum->update($request->all());
        return redirect()->route('penilaian_praktikum.index')->with('success', 'Penilaian Praktikum berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $penilaianPraktikum = PenilaianPraktikum::findOrFail($id);
        $user = auth()->user();

        // Cek akses untuk asisten dosen
        if ($user->role === 'asisten_dosen' && !$user->asistenPraktikum->mataKuliahPraktikum->pluck('id')->contains($penilaianPraktikum->mata_kuliah_praktikum_id)) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus penilaian ini.');
        }

        $penilaianPraktikum->delete();
        return redirect()->route('penilaian_praktikum.index')->with('success', 'Penilaian Praktikum berhasil dihapus.');
    }

    public function template()
{
    $user = auth()->user();

    // Cek jika user adalah asisten_dosen
    if ($user->role === 'asisten_dosen') {
        return redirect('https://docs.google.com/spreadsheets/d/1ilQcxefKpGpRBcV0N40OuEgJqVUm45gE/edit?usp=drive_link&ouid=101105418489584668609&rtpof=true&sd=true');
    }

    return abort(403, 'Anda tidak memiliki akses ke template ini.');
}

public function editTemplate()
{
    $user = auth()->user();

    // Cek akses hanya untuk laboran dan kepala_lab
    if (in_array($user->role, ['laboran', 'kepala_lab'])) {
        return redirect('https://docs.google.com/spreadsheets/d/1ilQcxefKpGpRBcV0N40OuEgJqVUm45gE/edit?usp=drive_link&ouid=101105418489584668609&rtpof=true&sd=true');
    }

    return abort(403, 'Anda tidak memiliki akses untuk mengedit template ini.');
}


    public function downloadTemplate()
    {
        $filePath = public_path('template_file/TEMPLATE PENILAIAN PRAKTIKUM.xlsx');
        return response()->download($filePath);
    }

    public function exportPdf()
    {
        $user = auth()->user();

        // Allow only 'laboran' and 'kepala_lab' roles to access this functionality
        if (!in_array($user->role, ['laboran', 'kepala_lab'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengekspor PDF.');
        }

        // Retrieve the data to be used in the PDF with the same ordering as in the index method
        $penilaianPraktikum = PenilaianPraktikum::with(['mataKuliahPraktikum' => function($query) {
            $query->orderBy('kode_mata_kuliah', 'asc')
                  ->orderBy('kelas', 'asc');
        }])->get();

        // Generate and download the PDF
        $pdf = PDF::loadView('penilaian_praktikum.pdf', compact('penilaianPraktikum'));
        return $pdf->download('penilaian_praktikum.pdf');
    }
    }
