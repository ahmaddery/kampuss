@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Edit Sambutan Rektor</h2>

        <form action="{{ route('admin.sambutan_rektor.update', $sambutan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $sambutan->judul) }}" required>
                @error('judul') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="editor" rows="10" required>{{ old('deskripsi', $sambutan->deskripsi) }}</textarea>
                @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                @error('foto') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            @if ($sambutan->foto)
                <div class="mb-3">
                    <img src="{{ Storage::url($sambutan->foto) }}" width="100" alt="Current Image">
                </div>
            @endif

            <button type="submit" class="btn btn-warning">Perbarui</button>
        </form>
    </div>

    <!-- Include CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
