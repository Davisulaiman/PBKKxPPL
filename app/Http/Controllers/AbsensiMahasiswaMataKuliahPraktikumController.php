<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswaMataKuliahPraktikum;

class AbsensiMahasiswaMataKuliahPraktikumController extends Controller
{
/**
     * Display the attendance form for a specific mahasiswa mata kuliah praktikum.
     */
    public function index($mahasiswaMataKuliahId)
    {
        // Fetch attendance record or create a new one if it doesn't exist
        $attendance = AbsensiMahasiswaMataKuliahPraktikum::firstOrNew(['mahasiswa_mata_kuliah_praktikum_id' => $mahasiswaMataKuliahId]);

        return view('attendance.index', compact('attendance', 'mahasiswaMataKuliahId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * Update the attendance for the specified mahasiswa mata kuliah praktikum.
     */
    public function update(Request $request, $mahasiswaMataKuliahId)
    {
        // Validate the request
        $request->validate([
            'pertemuan_1' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_2' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_3' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_4' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_5' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_6' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_7' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_8' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_9' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
            'pertemuan_10' => 'required|in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
        ]);

        // Find or create the attendance record
        $attendance = AbsensiMahasiswaMataKuliahPraktikum::updateOrCreate(
            ['mahasiswa_mata_kuliah_praktikum_id' => $mahasiswaMataKuliahId],
            $request->only([
                'pertemuan_1',
                'pertemuan_2',
                'pertemuan_3',
                'pertemuan_4',
                'pertemuan_5',
                'pertemuan_6',
                'pertemuan_7',
                'pertemuan_8',
                'pertemuan_9',
                'pertemuan_10',
            ])
        );

        return redirect()->back()->with('success', 'Attendance updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
