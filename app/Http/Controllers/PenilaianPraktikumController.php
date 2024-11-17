<?php

namespace App\Http\Controllers;

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
        $penilaianPraktikum = PenilaianPraktikum::with('mataKuliahPraktikum')->get();
        return view('penilaian_praktikum.index', compact('penilaianPraktikum'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataKuliahPraktikum = MataKuliahPraktikum::all();
        return view('penilaian_praktikum.create', compact('mataKuliahPraktikum'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
        PenilaianPraktikum::create($request->all());
        return redirect()->route('penilaian_praktikum.index')->with('success', 'Penilaian Praktikum berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadTemplate()
    {
        $filePath = public_path('template_file/TEMPLATE PENILAIAN PRAKTIKUM.xlsx');
        return response()->download($filePath);
    }

}
