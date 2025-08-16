<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BiroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biros = Biro::orderBy('nama_biro')->paginate(10);
        return view('admin.biro.index', compact('biros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.biro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_biro' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:biro,slug',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
            'deskripsi_lengkap' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Biro::generateUniqueSlug($validated['nama_biro']);
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('biro/logo', 'public');
        }

        // Handle multiple images upload
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('biro/gambar', 'public');
            }
        }
        $validated['gambar'] = $gambarPaths;

        Biro::create($validated);

        return redirect()->route('admin.biro.index')
            ->with('success', 'Biro berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Biro $biro)
    {
        return view('admin.biro.show', compact('biro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biro $biro)
    {
        return view('admin.biro.edit', compact('biro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biro $biro)
    {
        $validated = $request->validate([
            'nama_biro' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:biro,slug,' . $biro->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
            'deskripsi_lengkap' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Generate slug if not provided or changed
        if (empty($validated['slug']) || $biro->nama_biro !== $validated['nama_biro']) {
            $validated['slug'] = Biro::generateUniqueSlug($validated['nama_biro']);
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($biro->logo) {
                Storage::disk('public')->delete($biro->logo);
            }
            $validated['logo'] = $request->file('logo')->store('biro/logo', 'public');
        }

        // Handle multiple images upload
        if ($request->hasFile('gambar')) {
            // Delete old images if new ones are uploaded
            if ($biro->gambar) {
                foreach ($biro->gambar as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $gambarPaths = [];
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('biro/gambar', 'public');
            }
            $validated['gambar'] = $gambarPaths;
        }

        $biro->update($validated);

        return redirect()->route('admin.biro.index')
            ->with('success', 'Biro berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biro $biro)
    {
        // Delete logo
        if ($biro->logo) {
            Storage::disk('public')->delete($biro->logo);
        }

        // Delete images
        if ($biro->gambar) {
            foreach ($biro->gambar as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $biro->delete();

        return redirect()->route('admin.biro.index')
            ->with('success', 'Biro berhasil dihapus.');
    }
}
