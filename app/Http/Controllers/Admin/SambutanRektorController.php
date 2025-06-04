<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SambutanRektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanRektorController extends Controller
{
    public function index()
    {
        // Ambil data sambutan rektor
        $sambutan = SambutanRektor::all();
        return view('admin.sambutan_rektor.index', compact('sambutan'));
    }

    public function create()
    {
        return view('admin.sambutan_rektor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('sambutanrektor', 'public');
        }

        SambutanRektor::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.sambutan_rektor.index')->with('success', 'Sambutan Rektor berhasil ditambahkan');
    }

    public function edit($id)
    {
        $sambutan = SambutanRektor::findOrFail($id);
        return view('admin.sambutan_rektor.edit', compact('sambutan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sambutan = SambutanRektor::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($sambutan->foto && Storage::exists('public/sambutanrektor/' . $sambutan->foto)) {
                Storage::delete('public/sambutanrektor/' . $sambutan->foto);
            }

            $foto = $request->file('foto')->store('sambutanrektor', 'public');
            $sambutan->foto = $foto;
        }

        $sambutan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.sambutan_rektor.index')->with('success', 'Sambutan Rektor berhasil diperbarui');
    }

    public function destroy($id)
    {
        $sambutan = SambutanRektor::findOrFail($id);

        // Hapus foto jika ada
        if ($sambutan->foto && Storage::exists('public/sambutanrektor/' . $sambutan->foto)) {
            Storage::delete('public/sambutanrektor/' . $sambutan->foto);
        }

        $sambutan->delete();

        return redirect()->route('admin.sambutan_rektor.index')->with('success', 'Sambutan Rektor berhasil dihapus');
    }
}
