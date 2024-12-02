<?php

namespace App\Http\Controllers;

use App\Models\PraktikumTemplate;
use Illuminate\Http\Request;

class PraktikumTemplateController extends Controller
{
    public function index()
    {
        $this->authorizeRole(['laboran', 'kepala_lab']);

        $templates = PraktikumTemplate::all();
        return view('praktikum_template.index', compact('templates'));
    }

    public function create()
    {
        $this->authorizeRole(['laboran', 'kepala_lab']);
        return view('praktikum_template.create');
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['laboran', 'kepala_lab']);

        $validatedData = $request->validate([
            'google_drive_link' => [
                'required',
                'url',
                'regex:/^(https:\/\/(drive\.google\.com|bit\.ly|docs\.google\.com)\/.+)$/',
            ],
        ]);

        PraktikumTemplate::create($validatedData);

        return redirect()->route('praktikum_template.index')
            ->with('success', 'Template berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $this->authorizeRole(['laboran', 'kepala_lab']);

        $template = PraktikumTemplate::findOrFail($id);
        return view('praktikum_template.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeRole(['laboran', 'kepala_lab']);

        $template = PraktikumTemplate::findOrFail($id);

        $validatedData = $request->validate([
            'google_drive_link' => [
                'required',
                'url',
                'regex:/^(https:\/\/(drive\.google\.com|bit\.ly|docs\.google\.com)\/.+)$/',
            ],
        ]);

        $template->update($validatedData);

        return redirect()->route('praktikum_template.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeRole(['laboran', 'kepala_lab']);

        $template = PraktikumTemplate::findOrFail($id);
        $template->delete();

        return redirect()->route('praktikum_template.index')
            ->with('success', 'Template berhasil dihapus.');
    }

    public function show($id)
    {
        $template = PraktikumTemplate::findOrFail($id);
        return view('praktikum_template.show', compact('template'));
    }

    public function templateForAssistant()
    {
        // Memastikan user yang mengakses adalah asisten_dosen
        $this->authorizeRole(['asisten_dosen']);

        // Mengambil template pertama yang tersedia
        $template = PraktikumTemplate::first();

        // Jika tidak ada template yang tersedia
        if (!$template) {
            return redirect()->back()->with('error', 'Tidak ada template yang tersedia.');
        }

        // Mengarahkan user ke link Google Drive template
        return redirect()->away($template->google_drive_link);
    }


    /**
     * Authorize role for the user.
     */
    private function authorizeRole(array $roles)
    {
        $user = auth()->user();

        if (!in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }
}
