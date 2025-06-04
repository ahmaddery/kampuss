<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class SejarahController extends Controller
{
    // Menampilkan daftar Sejarah
    public function index()
    {
        $sejarah = Sejarah::all();
        return view('admin.sejarah.index', compact('sejarah'));
    }

    // Menampilkan form untuk menambah Sejarah
    public function create()
    {
        return view('admin.sejarah.create');
    }

    // Menyimpan data Sejarah baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('sejarah', 'public');
        }

        Sejarah::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit Sejarah
    public function edit($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        return view('admin.sejarah.edit', compact('sejarah'));
    }

    // Memperbarui data Sejarah
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sejarah = Sejarah::findOrFail($id);

        $fotoPath = $sejarah->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage
            if ($fotoPath) {
                Storage::delete('public/' . $fotoPath);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('sejarah', 'public');
        }

        $sejarah->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil diperbarui');
    }

    // Menghapus data Sejarah
    public function destroy($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        
        // Hapus foto dari storage jika ada
        if ($sejarah->foto) {
            Storage::delete('public/' . $sejarah->foto);
        }

        $sejarah->delete();

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil dihapus');
    }
}
