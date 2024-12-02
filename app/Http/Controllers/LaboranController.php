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

    /**
     * Display a listing of the Laboran.
     */
    public function index()
    {
        // Retrieve all Laboran data ordered by name
        $laborans = Laboran::orderBy('nama')->get();
        return view('laboran.index', compact('laborans'));
    }

    /**
     * Show the form for creating a new Laboran.
     */
    public function create()
    {
        return view('laboran.create');
    }

    /**
     * Store a newly created Laboran in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:laborans,username',
        ]);

        // Generate a default password based on username
        $password = explode('@', $request->username)[0];

        // Create a new User with the 'laboran' role
        $user = User::create([
            'name' => $request->nama,
            'email' => "{$request->username}@gmail.com",
            'password' => Hash::make($password),
            'role' => 'laboran',
        ]);

        // Create the Laboran and associate it with the created User
        Laboran::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'user_id' => $user->id,
        ]);

        return redirect()->route('laboran.index')->with('success', 'Laboran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified Laboran.
     */
    public function edit($id)
    {
        // Mengambil data Laboran berdasarkan ID
        $laboran = Laboran::findOrFail($id);

        // Mengambil data User yang terkait dengan Laboran
        $user = $laboran->user;

        return view('laboran.edit', compact('laboran', 'user'));
    }

    /**
     * Update the specified Laboran in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:laborans,username,' . $id, // Mengizinkan username yang sama jika hanya untuk ID yang sama
            'password' => 'nullable|min:8', // Validasi password (optional, minimal 8 karakter)
     
        ]);

        // Mengambil data Laboran berdasarkan ID
        $laboran = Laboran::findOrFail($id);

        // Update data Laboran
        $laboran->update([
            'nama' => $request->nama,
            'username' => $request->username,
        ]);

        // Update data User yang terkait dengan Laboran
        $user = $laboran->user;
        $user->name = $request->nama;
        $user->email = "{$request->username}@gmail.com";

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Simpan perubahan data User

        return redirect()->route('laboran.index')->with('success', 'Laboran berhasil diperbarui.');
    }


    /**
     * Remove the specified Laboran from storage.
     */
    public function destroy($id)
    {
        // Retrieve Laboran by ID
        $laboran = Laboran::findOrFail($id);

        // Delete associated User if exists
        if ($laboran->user) {
            $laboran->user->delete();
        }

        // Delete Laboran
        $laboran->delete();

        return redirect()->route('laboran.index')->with('success', 'Laboran berhasil dihapus.');
    }
}
