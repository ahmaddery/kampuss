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
        $sambutan = SambutanRektor::orderBy('created_at', 'desc')->get();
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
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'foto.required' => 'Foto harus diupload.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus: jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        try {
            $foto = $request->file('foto')->store('sambutan-rektor', 'public');

            SambutanRektor::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $foto,
            ]);

            return redirect()->route('admin.sambutan_rektor.index')
                           ->with('success', 'Sambutan Rektor berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat menyimpan data.')
                           ->withInput();
        }
    }

    public function show($id)
    {
        $sambutan = SambutanRektor::findOrFail($id);
        return view('admin.sambutan_rektor.show', compact('sambutan'));
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
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus: jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        try {
            $sambutan = SambutanRektor::findOrFail($id);
            
            if ($request->hasFile('foto')) {
                if ($sambutan->foto && Storage::disk('public')->exists($sambutan->foto)) {
                    Storage::disk('public')->delete($sambutan->foto);
                }
                $sambutan->foto = $request->file('foto')->store('sambutan-rektor', 'public');
            }

            $sambutan->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $sambutan->foto,
            ]);

            return redirect()->route('admin.sambutan_rektor.index')
                           ->with('success', 'Sambutan Rektor berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat memperbarui data.')
                           ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $sambutan = SambutanRektor::findOrFail($id);

            if ($sambutan->foto && Storage::disk('public')->exists($sambutan->foto)) {
                Storage::disk('public')->delete($sambutan->foto);
            }

            $sambutan->delete();

            return redirect()->route('admin.sambutan_rektor.index')
                           ->with('success', 'Sambutan Rektor berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}