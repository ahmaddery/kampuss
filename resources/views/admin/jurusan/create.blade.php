@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Tambah Jurusan Baru</h1>

        <!-- Form untuk menambah jurusan baru -->
        <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Input untuk Icon (Upload Gambar) -->
            <div class="form-group">
                <label for="icon">Icon (Upload Gambar)</label>
                <input type="file" name="icon" id="icon" class="form-control">
            </div>

            <!-- Input untuk Nama Jurusan -->
            <div class="form-group">
                <label for="jurusan">Nama Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan') }}">
            </div>

            <!-- Input untuk Deskripsi -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>
@endsection
