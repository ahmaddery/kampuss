<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display the specified jurusan by slug.
     */
    public function show($slug)
    {
        $jurusan = Jurusan::with('informasiProgram')->where('slug', $slug)->firstOrFail();
        
        return view('jurusan.show', compact('jurusan'));
    }

    /**
     * Display a listing of all jurusan for public view.
     */
    public function index()
    {
        $jurusans = Jurusan::with('informasiProgram')->get();
        
        return view('jurusan.index', compact('jurusans'));
    }
}
