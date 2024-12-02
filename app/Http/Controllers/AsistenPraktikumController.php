<?php

namespace App\Http\Controllers;

use App\Models\AsistenPraktikum;
use App\Models\MataKuliahPraktikum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsistenPraktikumController extends Controller
{
    public function index()
    {
        // Retrieve all Asisten Praktikum data with Mata Kuliah Praktikum relationships, ordered
        $asistenPraktikum = AsistenPraktikum::with(['mataKuliahPraktikum' => function ($query) {
            $query->orderBy('kelas')->orderBy('kode_mata_kuliah');
        }])->get();

        return view('asisten_praktikum.index', compact('asistenPraktikum'));
    }


    public function create()
    {
        // Retrieve active Mata Kuliah Praktikum data and order by 'kelas' and 'kode_mata_kuliah'
        $mataKuliahPraktikum = MataKuliahPraktikum::where('status_aktif', true)
            ->orderBy('kelas')
            ->orderBy('kode_mata_kuliah')
            ->get();

        return view('asisten_praktikum.create', compact('mataKuliahPraktikum'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'npm' => 'required|unique:asisten_praktikums,npm',
            'nama_praktikan' => 'required',
            'username' => 'required|unique:asisten_praktikums,username',
            'mata_kuliah_praktikum_id' => 'required|array',
            'mata_kuliah_praktikum_id.*' => 'exists:mata_kuliah_praktikums,id', // Ensure valid mata kuliah IDs
        ]);

        // Create a new User with the role of 'asisten_dosen'
        $user = User::create([
            'name' => $request->nama_praktikan,
            'email' => "{$request->username}@gmail.com",
            'password' => Hash::make($request->username),
            'role' => 'asisten_dosen',  // Assign role
        ]);

        // Create the Asisten Praktikum and associate it with the created User
        $asistenPraktikum = AsistenPraktikum::create([
            'npm' => $request->npm,
            'nama_praktikan' => $request->nama_praktikan,
            'username' => $request->username,
            'user_id' => $user->id, // Link to the newly created user
        ]);

        // Associate Asisten Praktikum with selected Mata Kuliah Praktikum
        $asistenPraktikum->mataKuliahPraktikum()->attach($request->mata_kuliah_praktikum_id);

        return redirect()->route('asisten_praktikum.index')->with('success', 'Asisten Praktikum berhasil ditambahkan.');
    }

public function edit($id)
{
    $asisten = AsistenPraktikum::findOrFail($id);

    // Retrieve Mata Kuliah Praktikum data and order by 'kelas' and 'kode_mata_kuliah'
    $mataKuliahPraktikum = MataKuliahPraktikum::orderBy('kelas')
        ->orderBy('kode_mata_kuliah')
        ->get();

    $selectedMataKuliah = $asisten->mataKuliahPraktikum->pluck('id')->toArray();

    return view('asisten_praktikum.edit', compact('asisten', 'mataKuliahPraktikum', 'selectedMataKuliah'));
}


    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'npm' => 'required|unique:asisten_praktikums,npm,' . $id,
            'nama_praktikan' => 'required',
            'username' => 'required|unique:asisten_praktikums,username,' . $id,
            'mata_kuliah_praktikum_id' => 'required|array',
            'mata_kuliah_praktikum_id.*' => 'exists:mata_kuliah_praktikums,id', // Ensure valid mata kuliah IDs
        ]);

        // Retrieve Asisten Praktikum by ID
        $asisten = AsistenPraktikum::findOrFail($id);

        // Update Asisten Praktikum data
        $asisten->update([
            'npm' => $request->npm,
            'nama_praktikan' => $request->nama_praktikan,
            'username' => $request->username,
        ]);

        // Update the associated User data
        $user = $asisten->user;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Update password only if provided
        }
        $user->save(); // Save the User model

        // Sync selected Mata Kuliah Praktikum
        $asisten->mataKuliahPraktikum()->sync($request->mata_kuliah_praktikum_id);

        return redirect()->route('asisten_praktikum.index')->with('success', 'Asisten Praktikum berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Retrieve Asisten Praktikum by ID
        $asisten = AsistenPraktikum::findOrFail($id);

        // Detach all Mata Kuliah Praktikum relations
        $asisten->mataKuliahPraktikum()->detach();

        // Delete associated User if exists
        if ($asisten->user) {
            $asisten->user->delete();
        }

        // Delete Asisten Praktikum
        $asisten->delete();

        return redirect()->route('asisten_praktikum.index')->with('success', 'Asisten Praktikum berhasil dihapus.');
    }
}
