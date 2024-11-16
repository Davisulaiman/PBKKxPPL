<?php

namespace App\Http\Controllers;

use App\Models\Laboran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LaboranController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:kepala_lab'); // Middleware for access control
    }

    public function index()
    {
        $laborans = Laboran::all();
        return view('laboran.index', compact('laborans'));
    }

    public function create()
    {
        return view('laboran.create');
    }

    public function store(Request $request)
    {
        // Validation for Laboran data
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
        ]);
        $password = explode('@', $request->email)[0];

        // Create a new User with the 'laboran' role
        $user = User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'laboran',
        ]);

        // Create the Laboran record
        Laboran::create([
            'user_id' => $user->id,
            'email' => $request->email,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($password)
        ]);

        return redirect()->route('laboran.index')->with('success', 'Laboran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laboran = Laboran::findOrFail($id);
        return view('laboran.edit', compact('laboran'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input data untuk update
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
        ]);
        
        // Temukan Laboran berdasarkan ID
        $laboran = Laboran::findOrFail($id);
        $user = $laboran->user;

        // Update data pengguna
        $user->update([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        // Jika password diisi (opsional), ubah password user dan laboran
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            $laboran->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update data Laboran
        $laboran->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return redirect()->route('laboran.index')->with('success', 'Laboran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laboran = Laboran::findOrFail($id);
        $laboran->user->delete();
        $laboran->delete();

        return redirect()->route('laboran.index')->with('success', 'Laboran berhasil dihapus.');
    }
}
