@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-history me-2"></i> Manajemen Sejarah</h3>
            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#createSejarahModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Sejarah
            </button>
        </div>

        <!-- Main Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sejarah as $index => $item)
                                <tr class="align-middle">
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td class="fw-medium">{{ $item->judul }}</td>
                                    <td class="text-muted">{!! Str::limit($item->deskripsi, 50) !!}</td>
                                    <td>
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" width="60" height="60" class="rounded-3 shadow-sm object-cover" alt="Foto Sejarah">
                                        @else
                                            <span class="badge bg-secondary text-white fw-normal px-2 py-1">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSejarahModal" 
                                                onclick="openEditModal({{ $item->id }}, '{{ $item->judul }}', `{{ $item->deskripsi }}`, '{{ $item->foto ? asset('storage/' . $item->foto) : '' }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.sejarah.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada data sejarah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Create Sejarah Modal -->
    <div class="modal fade" id="createSejarahModal" tabindex="-1" role="dialog" aria-labelledby="createSejarahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSejarahModalLabel">Tambah Sejarah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Pastikan sudah ada script berikut di bagian footer -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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