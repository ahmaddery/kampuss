@extends('layouts.admin')

@section('content')

    <div class="container mt-4">
        <h1 class="text-3xl font-bold mb-6">Detail Jurusan</h1>

        <!-- Menampilkan detail jurusan -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <h2 class="text-2xl font-semibold">{{ $jurusan->jurusan }}</h2>
                <p class="text-gray-600">{{ $jurusan->deskripsi }}</p>
            </div>

            <!-- Menampilkan ikon -->
            <div class="mb-4">
                <h3 class="text-xl font-semibold">Icon:</h3>
                <img src="{{ Storage::url($jurusan->icon) }}" alt="{{ $jurusan->jurusan }}" class="w-[100px] h-[100px] object-contain rounded-full">
            </div>

            <!-- Tombol Kembali -->
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-primary">Kembali ke Daftar Jurusan</a>
        </div>
    </div>

@endsection
