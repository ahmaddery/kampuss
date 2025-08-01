<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiProgram;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class InformasiProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasiPrograms = InformasiProgram::with('jurusan')->get();
        return view('admin.informasi-program.index', compact('informasiPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.informasi-program.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'jenjang' => 'required|string|max:10',
            'durasi' => 'required|string|max:50',
            'sks' => 'required|string|max:50',
            'akreditasi' => 'nullable|string|max:10',
            'gelar' => 'required|string|max:50',
        ]);

        InformasiProgram::create($request->all());

        return redirect()->route('admin.informasi-program.index')
                        ->with('toast_success', 'Informasi Program berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(InformasiProgram $informasiProgram)
    {
        $informasiProgram->load('jurusan');
        return view('admin.informasi-program.show', compact('informasiProgram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformasiProgram $informasiProgram)
    {
        $jurusans = Jurusan::all();
        return view('admin.informasi-program.edit', compact('informasiProgram', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformasiProgram $informasiProgram)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'jenjang' => 'required|string|max:10',
            'durasi' => 'required|string|max:50',
            'sks' => 'required|string|max:50',
            'akreditasi' => 'nullable|string|max:10',
            'gelar' => 'required|string|max:50',
        ]);

        $informasiProgram->update($request->all());

        return redirect()->route('admin.informasi-program.index')
                        ->with('toast_success', 'Informasi Program berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiProgram $informasiProgram)
    {
        $informasiProgram->delete();

        return redirect()->route('admin.informasi-program.index')
                        ->with('toast_success', 'Informasi Program berhasil dihapus!');
    }
}
