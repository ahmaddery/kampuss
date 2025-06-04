@extends('layouts.admin')

@section('content')
    <h1>Edit Sejarah</h1>

    <form action="{{ route('admin.sejarah.update', $sejarah->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" name="judul" id="judul" value="{{ old('judul', $sejarah->judul) }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10">{{ old('deskripsi', $sejarah->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto">
            @if($sejarah->foto)
                <img src="{{ asset('storage/' . $sejarah->foto) }}" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
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
