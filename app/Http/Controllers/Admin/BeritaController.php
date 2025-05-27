<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::all(); // Fetch all records
        return view('admin.berita.index', compact('berita')); // Pass data to the view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.berita.create'); // Show create form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image_path' => 'nullable|image|max:2048',
            'publish_date' => 'required|date',
            'author' => 'nullable|max:255',
        ]);

        // Handle file upload if present
        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
        }

        Berita::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'publish_date' => $request->publish_date,
            'author' => $request->author,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita')); // Show edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image_path' => 'nullable|image|max:2048',
            'publish_date' => 'required|date',
            'author' => 'nullable|max:255',
        ]);

        // Handle file upload if present
        $imagePath = $berita->image_path; // Keep the existing image if no new one is uploaded
        if ($request->hasFile('image_path')) {
            // Delete old image
            if ($imagePath) {
                \Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image_path')->store('images', 'public');
        }

        $berita->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'publish_date' => $request->publish_date,
            'author' => $request->author,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        // Delete image file if exists
        if ($berita->image_path) {
            \Storage::disk('public')->delete($berita->image_path);
        }

        $berita->delete(); // Soft delete the record

        return redirect()->route('admin.berita.index')->with('success', 'Berita deleted successfully.');
    }
}
