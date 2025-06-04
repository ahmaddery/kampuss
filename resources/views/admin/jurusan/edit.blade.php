@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Jurusan</h1>

        <!-- Form untuk mengedit jurusan -->
        <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input untuk upload gambar ikon -->
            <div class="form-group">
                <label for="icon">Icon (Upload Gambar)</label>
                <input type="file" name="icon" id="icon" class="form-control">
                
                <!-- Menampilkan gambar lama jika ada -->
                @if($jurusan->icon)
                    <p class="mt-2">Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $jurusan->icon) }}" alt="Icon" width="100" class="mt-2">
                @endif
            </div>

            <!-- Input untuk Nama Jurusan -->
            <div class="form-group">
                <label for="jurusan">Nama Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan', $jurusan->jurusan) }}" required>
            </div>

            <!-- Input untuk Deskripsi -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
        </form>
    </div>
@endsection
