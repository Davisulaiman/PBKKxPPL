<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaMataKuliahPraktikum;
use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswaMataKuliahPraktikum;
use App\Models\MahasiswaPraktikum;
use App\Models\MataKuliahPraktikum;
use Illuminate\Support\Facades\Log;

class AbsensiMahasiswaMataKuliahPraktikumController extends Controller
{

    public function indexMahasiswa($mahasiswaMataKuliahId)
    {
        // Fetch attendance record or create a new one if it doesn't exist
        $attendance = AbsensiMahasiswaMataKuliahPraktikum::firstOrNew(['mahasiswa_mata_kuliah_praktikum_id' => $mahasiswaMataKuliahId]);

        return view('attendance.index', compact('attendance', 'mahasiswaMataKuliahId'));
    }

public function printMahasiswa($mahasiswaMataKuliahId)
{
            // Fetch attendance record or create a new one if it doesn't exist
            $attendance = AbsensiMahasiswaMataKuliahPraktikum::firstOrNew(['mahasiswa_mata_kuliah_praktikum_id' => $mahasiswaMataKuliahId]);

            return view('attendance.print', compact('attendance', 'mahasiswaMataKuliahId'));
}

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
     * Store a newly created attendance record in storage.
     */
    public function store(Request $request)
    {
        // Implement store logic here if needed
    }

    //
    //
    //
    public function index()
    {
        $user = auth()->user();
        $asisten = $user->asistenPraktikum;
        $mataKuliahPraktikum = $asisten ? $asisten->mataKuliahPraktikum : collect(); // Mengambil data atau koleksi kosong jika tidak ada
        return view('kehadiran.index', compact('mataKuliahPraktikum'));
    }


    /**
     * Display the specified attendance record.
     */
    public function show(string $id)
    {
        // Retrieve MataKuliahPraktikum by ID
        $mataKuliah = MataKuliahPraktikum::findOrFail($id);

        // Pass data to view
        return view('kehadiran.show', compact('mataKuliah'));
    }

    public function showAbsensiPertemuan($mataKuliahId, $pertemuan)
    {
        // Retrieve the MataKuliahPraktikum by ID
        $mataKuliah = MataKuliahPraktikum::findOrFail($mataKuliahId);

        // Retrieve the mahasiswa enrolled in this MataKuliahPraktikum
        $mahasiswaList = $mataKuliah->mahasiswaPraktikum;

        // Pluck the mahasiswa data along with their attendance status for the given pertemuan
        $mahasiswaStatusAbsensi = $mahasiswaList->map(function($mahasiswa) use ($mataKuliahId, $pertemuan) {

            // Find the related MahasiswaMataKuliahPraktikum record for this mahasiswa and mataKuliah
            $mahasiswaMataKuliahPraktikum = MahasiswaMataKuliahPraktikum::where('mahasiswa_praktikum_id', $mahasiswa->id)
                ->where('mata_kuliah_praktikum_id', $mataKuliahId)
                ->first();

            // If MahasiswaMataKuliahPraktikum exists, find the attendance record
            if ($mahasiswaMataKuliahPraktikum) {
                $absensi = AbsensiMahasiswaMataKuliahPraktikum::where('mahasiswa_mata_kuliah_praktikum_id', $mahasiswaMataKuliahPraktikum->id)->first();

                // Dynamically get the status for the given pertemuan
                $status = $absensi ? $absensi->$pertemuan : 'Tidak Ada Keterangan';
            } else {
                $status = 'Tidak Ada Keterangan';
            }

            // Return the mahasiswa data along with the status
            return [
                'mahasiswa' => $mahasiswa,
                'statusMahasiswa' => $status, // Use 'statusMahasiswa' as the key here
            ];
        });

        // Pass data to the view
        return view('kehadiran.absensi_pertemuan', compact('mataKuliah', 'mahasiswaStatusAbsensi', 'pertemuan'));
    }

    public function showPrint($mataKuliahId, $pertemuan)
    {
        // Retrieve the MataKuliahPraktikum by ID
        $mataKuliah = MataKuliahPraktikum::findOrFail($mataKuliahId);

        // Retrieve the mahasiswa enrolled in this MataKuliahPraktikum
        $mahasiswaList = $mataKuliah->mahasiswaPraktikum;

        // Pluck the mahasiswa data along with their attendance status for the given pertemuan
        $mahasiswaStatusAbsensi = $mahasiswaList->map(function($mahasiswa) use ($mataKuliahId, $pertemuan) {

            // Find the related MahasiswaMataKuliahPraktikum record for this mahasiswa and mataKuliah
            $mahasiswaMataKuliahPraktikum = MahasiswaMataKuliahPraktikum::where('mahasiswa_praktikum_id', $mahasiswa->id)
                ->where('mata_kuliah_praktikum_id', $mataKuliahId)
                ->first();

            // If MahasiswaMataKuliahPraktikum exists, find the attendance record
            if ($mahasiswaMataKuliahPraktikum) {
                $absensi = AbsensiMahasiswaMataKuliahPraktikum::where('mahasiswa_mata_kuliah_praktikum_id', $mahasiswaMataKuliahPraktikum->id)->first();

                // Dynamically get the status for the given pertemuan
                $status = $absensi ? $absensi->$pertemuan : 'Tidak Ada Keterangan';
            } else {
                $status = 'Tidak Ada Keterangan';
            }

            // Return the mahasiswa data along with the status
            return [
                'mahasiswa' => $mahasiswa,
                'statusMahasiswa' => $status, // Use 'statusMahasiswa' as the key here
            ];
        });

        // Pass data to the view
        return view('kehadiran.print', compact('mataKuliah', 'mahasiswaStatusAbsensi', 'pertemuan'));
    }

    public function updateAbsensiPertemuan(Request $request, $mataKuliahId, $pertemuan)
    {
        // Validate request data
        $request->validate([
            'status' => 'required|array',
            'status.*' => 'in:Hadir,Sakit,Izin,Alpa,Tidak Ada Keterangan',
        ]);

        // Loop through the status array and update attendance records
        foreach ($request->status as $mahasiswaId => $status) {
            // Find the student (Mahasiswa) and the corresponding course (MataKuliah)
            $mahasiswa = MahasiswaPraktikum::find($mahasiswaId);
            $mataKuliah = MataKuliahPraktikum::find($mataKuliahId);

            // Use firstOrCreate to get or create the MahasiswaMataKuliahPraktikum pivot record
            $mahasiswaMataKuliahPraktikum = MahasiswaMataKuliahPraktikum::firstOrCreate(
                [
                    'mahasiswa_praktikum_id' => $mahasiswaId,
                    'mata_kuliah_praktikum_id' => $mataKuliahId,
                ]
            );

            // Update or create the attendance record
            AbsensiMahasiswaMataKuliahPraktikum::updateOrCreate(
                [
                    'mahasiswa_mata_kuliah_praktikum_id' => $mahasiswaMataKuliahPraktikum->id,
                ],
                [
                    // Dynamically set the attendance status for the specific meeting
                    $pertemuan => $status,
                ]
            );
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Absensi updated successfully for pertemuan ' . $pertemuan);
    }

    public function __construct()
    {
        // Middleware untuk memastikan hanya Kepala Laboran dan Laboran yang bisa mengakses laporan presensi
        $this->middleware('role:kepala_lab,laboran')->only('showLaporanPresensi');
    }

    public function showLaporanPresensi($mataKuliahId)
    {
        // Ambil data dari model terkait
        $mataKuliah = MataKuliahPraktikum::findOrFail($mataKuliahId);
        $mahasiswaStatusAbsensi = $mataKuliah->mahasiswaPraktikum;

        // Kirim data ke view di folder laporan_absensi
        return view('laporan_absensi.index', compact('mataKuliah', 'mahasiswaStatusAbsensi'));
    }


    /**
     * Remove the specified attendance record from storage.
     */
    public function destroy(string $id)
    {
        // Implement destroy logic here if needed
    }
}
