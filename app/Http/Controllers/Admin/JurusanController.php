<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    // Menampilkan semua data jurusan
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    // Menampilkan detail jurusan
    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.show', compact('jurusan'));
    }

    // Menampilkan form untuk membuat jurusan baru
    public function create()
    {
        return view('admin.jurusan.create');
    }

    // Menyimpan data jurusan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jurusan' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:jurusan,slug',
            'deskripsi' => 'required|string',
            'deskripsi_lengkap' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);

        $imagePath = null;
        // Upload gambar ke storage dan simpan path-nya
        if ($request->hasFile('icon')) {
            $imagePath = $request->file('icon')->store('images/jurusan', 'public');
        }

        // Generate slug if not provided
        $slug = $request->slug ?: \Illuminate\Support\Str::slug($request->jurusan);

        // Simpan data jurusan dengan path gambar
        Jurusan::create([
            'icon' => $imagePath,
            'jurusan' => $request->jurusan,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'seo_title' => $request->seo_title ?: $request->jurusan,
            'seo_description' => $request->seo_description ?: $request->deskripsi,
        ]);

        return redirect()->route('admin.jurusan.index')->with('toast_success', 'Jurusan berhasil dibuat!');
    }

    // Menampilkan form untuk mengedit jurusan
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    // Menyimpan perubahan data jurusan
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jurusan' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:jurusan,slug,' . $id,
            'deskripsi' => 'required|string',
            'deskripsi_lengkap' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);

        $jurusan = Jurusan::findOrFail($id);

        // Jika ada gambar baru yang diupload, hapus gambar lama dan simpan gambar baru
        if ($request->hasFile('icon')) {
            // Hapus gambar lama dari storage jika ada
            if ($jurusan->icon && Storage::disk('public')->exists($jurusan->icon)) {
                Storage::disk('public')->delete($jurusan->icon);
            }

            $imagePath = $request->file('icon')->store('images/jurusan', 'public');
            $jurusan->icon = $imagePath; // Simpan path gambar baru
        }

        // Generate slug if not provided or if jurusan name changed
        $slug = $request->slug;
        if (!$slug || $request->jurusan !== $jurusan->jurusan) {
            $slug = \Illuminate\Support\Str::slug($request->jurusan);
        }

        // Update data jurusan
        $jurusan->update([
            'jurusan' => $request->jurusan,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'seo_title' => $request->seo_title ?: $request->jurusan,
            'seo_description' => $request->seo_description ?: $request->deskripsi,
        ]);

        return redirect()->route('admin.jurusan.index')->with('toast_success', 'Jurusan berhasil diperbarui!');
    }

    // Menghapus jurusan
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($jurusan->icon && Storage::disk('public')->exists($jurusan->icon)) {
            Storage::disk('public')->delete($jurusan->icon);
        }

        // Hapus data jurusan
        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')->with('toast_success', 'Jurusan berhasil dihapus!');
    }
}
