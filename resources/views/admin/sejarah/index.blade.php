@extends('layouts.admin')

@section('content')
    <h1>Daftar Sejarah</h1>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createSejarahModal">
        Tambah Sejarah
    </button>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sejarah as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{!! Str::limit($item->deskripsi, 50) !!}</td>
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" width="100" alt="Foto Sejarah">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSejarahModal" 
                            onclick="openEditModal({{ $item->id }}, '{{ $item->judul }}', '{{ $item->deskripsi }}', '{{ $item->foto ? asset('storage/' . $item->foto) : '' }}')">
                            Edit
                        </button>
                        <form action="{{ route('admin.sejarah.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Create Sejarah Modal -->
    <div class="modal fade" id="createSejarahModal" tabindex="-1" role="dialog" aria-labelledby="createSejarahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSejarahModalLabel">Tambah Sejarah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.sejarah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="create_judul" value="{{ old('judul') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="create_deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="create_deskripsi" rows="10">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="create_foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="create_foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Sejarah Modal -->
    <div class="modal fade" id="editSejarahModal" tabindex="-1" role="dialog" aria-labelledby="editSejarahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSejarahModalLabel">Edit Sejarah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editSejarahForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="edit_judul" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="edit_deskripsi" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="edit_foto">
                            <img id="edit_foto_preview" src="" width="100" style="display:none; margin-top:10px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Pastikan sudah ada script berikut di bagian footer -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        let createEditor, editEditor;

        // Initialize CKEditor for Create Modal
        ClassicEditor
            .create(document.querySelector('#create_deskripsi'))
            .then(editor => {
                createEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        // Initialize CKEditor for Edit Modal
        ClassicEditor
            .create(document.querySelector('#edit_deskripsi'))
            .then(editor => {
                editEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        function openEditModal(id, judul, deskripsi, foto) {
            // Set form action dynamically
            document.getElementById('editSejarahForm').action = '{{ route("admin.sejarah.update", ":id") }}'.replace(':id', id);
            
            // Set form values
            document.getElementById('edit_judul').value = judul;
            editEditor.setData(deskripsi);
            
            // Handle photo preview
            const fotoPreview = document.getElementById('edit_foto_preview');
            if (foto) {
                fotoPreview.src = foto;
                fotoPreview.style.display = 'block';
            } else {
                fotoPreview.style.display = 'none';
            }
        }
    </script>
@endsection