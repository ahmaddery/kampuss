<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::with('jurusan')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::orderBy('jurusan')->get();
        return view('admin.fasilitas.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'deskripsi_lengkap' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama_fasilitas']);

        // Handle gambar upload
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('fasilitas', 'public');
                $gambarPaths[] = $path;
            }
        }
        $validated['gambar'] = $gambarPaths;

        // Auto-fill SEO jika kosong
        if (empty($validated['seo_title'])) {
            $validated['seo_title'] = $validated['nama_fasilitas'];
        }
        if (empty($validated['seo_description'])) {
            $validated['seo_description'] = $validated['deskripsi'] ?? 'Fasilitas ' . $validated['nama_fasilitas'];
        }

        Fasilitas::create($validated);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilitas)
    {
        $fasilitas->load('jurusan');
        return view('admin.fasilitas.show', compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fasilitas $fasilitas)
    {
        $jurusan = Jurusan::orderBy('jurusan')->get();
        return view('admin.fasilitas.edit', compact('fasilitas', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'deskripsi_lengkap' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Update slug jika nama berubah
        if ($fasilitas->nama_fasilitas !== $validated['nama_fasilitas']) {
            $validated['slug'] = Str::slug($validated['nama_fasilitas']);
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($fasilitas->gambar) {
                foreach ($fasilitas->gambar as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // Upload gambar baru
            $gambarPaths = [];
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('fasilitas', 'public');
                $gambarPaths[] = $path;
            }
            $validated['gambar'] = $gambarPaths;
        }

        // Auto-fill SEO jika kosong
        if (empty($validated['seo_title'])) {
            $validated['seo_title'] = $validated['nama_fasilitas'];
        }
        if (empty($validated['seo_description'])) {
            $validated['seo_description'] = $validated['deskripsi'] ?? 'Fasilitas ' . $validated['nama_fasilitas'];
        }

        $fasilitas->update($validated);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilitas)
    {
        // Hapus gambar
        if ($fasilitas->gambar) {
            foreach ($fasilitas->gambar as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
    }

    /**
     * Toggle status fasilitas
     */
    public function toggleStatus(Fasilitas $fasilitas)
    {
        $fasilitas->status = $fasilitas->status === 'aktif' ? 'nonaktif' : 'aktif';
        $fasilitas->save();

        return response()->json([
            'success' => true,
            'status' => $fasilitas->status,
            'message' => 'Status fasilitas berhasil diubah!'
        ]);
    }
}
