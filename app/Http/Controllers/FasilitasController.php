<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of fasilitas
     */
    public function index(Request $request)
    {
        $query = Fasilitas::with('jurusan')->aktif();

        // Filter berdasarkan jurusan
        if ($request->has('jurusan') && $request->jurusan) {
            $query->where('jurusan_id', $request->jurusan);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_fasilitas', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi', 'LIKE', "%{$search}%");
            });
        }

        $fasilitas = $query->orderBy('nama_fasilitas')->paginate(12);
        
        // Get jurusan untuk filter
        $jurusan = Jurusan::orderBy('jurusan')->get();

        return view('fasilitas.index', compact('fasilitas', 'jurusan'));
    }

    /**
     * Display the specified fasilitas
     */
    public function show($slug)
    {
        $fasilitas = Fasilitas::with('jurusan')
            ->where('slug', $slug)
            ->where('status', 'aktif')
            ->firstOrFail();

        // Fasilitas terkait (dari jurusan yang sama atau umum)
        $fasilitasTerkait = Fasilitas::with('jurusan')
            ->aktif()
            ->where('id', '!=', $fasilitas->id)
            ->where(function($query) use ($fasilitas) {
                if ($fasilitas->jurusan_id) {
                    $query->where('jurusan_id', $fasilitas->jurusan_id)
                          ->orWhereNull('jurusan_id');
                } else {
                    $query->whereNull('jurusan_id');
                }
            })
            ->limit(3)
            ->get();

        return view('fasilitas.show', compact('fasilitas', 'fasilitasTerkait'));
    }

    /**
     * Get fasilitas untuk homepage
     */
    public function getFasilitasForHomepage($limit = 6)
    {
        return Fasilitas::with('jurusan')
            ->aktif()
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
