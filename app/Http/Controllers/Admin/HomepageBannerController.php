<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageBannerController extends Controller
{
    // Menampilkan daftar homepage banner
    public function index()
    {
        $banners = HomepageBanner::all();
        return view('admin.homepage_banners.index', compact('banners'));
    }

    // Menampilkan form untuk membuat banner baru
    public function create()
    {
        return view('admin.homepage_banners.create');
    }

    // Menyimpan banner baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg',
        ]);

        // Menyimpan gambar dan mendapatkan path-nya
        $imagePath = $request->file('image')->store('images/homepage_banners', 'public');

        // Membuat entry baru di database
        HomepageBanner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.homepage_banners.index')->with('success', 'Banner created successfully!');
    }

    // Menampilkan form untuk mengedit banner
    public function edit($id)
    {
        $banner = HomepageBanner::findOrFail($id);
        return view('admin.homepage_banners.edit', compact('banner'));
    }

    // Menyimpan perubahan ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg',
        ]);

        $banner = HomepageBanner::findOrFail($id);

        // Menghapus gambar lama jika ada gambar baru
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($banner->image_path);
            $imagePath = $request->file('image')->store('images/homepage_banners', 'public');
        } else {
            $imagePath = $banner->image_path;
        }

        $banner->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.homepage_banners.index')->with('success', 'Banner updated successfully!');
    }

    // Menghapus banner
    public function destroy($id)
    {
        $banner = HomepageBanner::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return redirect()->route('admin.homepage_banners.index')->with('success', 'Banner deleted successfully!');
    }
}