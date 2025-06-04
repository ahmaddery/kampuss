@extends('layouts.admin')

@section('content')
    <h1>Tambah Sejarah</h1>

    <form action="{{ route('admin.sejarah.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" name="judul" id="judul" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <!-- Include CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
