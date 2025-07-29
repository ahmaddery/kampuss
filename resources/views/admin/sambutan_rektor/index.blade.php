@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-microphone-alt me-2"></i> Manajemen Sambutan Rektor</h3>
            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Sambutan
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
                            @forelse ($sambutan as $index => $item)
                                <tr class="align-middle">
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td class="fw-medium">{{ $item->judul }}</td>
                                    <td class="text-muted">{!! Str::limit(strip_tags($item->deskripsi), 50) !!}</td>
                                    <td>
                                        @if($item->foto)
                                            <img src="{{ Storage::url($item->foto) }}" width="60" height="60" class="rounded-3 shadow-sm object-cover" alt="Foto Sambutan">
                                        @else
                                            <span class="badge bg-secondary text-white fw-normal px-2 py-1">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('{{ $item->id }}', '{{ $item->judul }}')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada data sambutan rektor.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded">
                <div class="modal-header bg-success text-white rounded-top">
                    <h5 class="modal-title" id="createModalLabel">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Sambutan Rektor
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" action="{{ route('admin.sambutan_rektor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_judul" class="form-label">
                                        <i class="fas fa-heading me-1"></i>
                                        Judul <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="judul" 
                                           class="form-control" 
                                           id="create_judul" 
                                           value="{{ old('judul') }}" 
                                           placeholder="Masukkan judul sambutan"
                                           required>
                                    @error('judul') 
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="create_foto" class="form-label">
                                        <i class="fas fa-image me-1"></i>
                                        Foto <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" 
                                           name="foto" 
                                           class="form-control" 
                                           id="create_foto" 
                                           accept="image/*" 
                                           required>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Format: JPG, PNG, GIF. Maksimal 2MB.
                                    </div>
                                    <div id="createImagePreview" class="mt-2" style="display: none;">
                                        <img id="createPreviewImg" src="#" class="img-thumbnail rounded" width="150" alt="Preview">
                                    </div>
                                    @error('foto') 
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_deskripsi" class="form-label">
                                        <i class="fas fa-align-left me-1"></i>
                                        Deskripsi <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="deskripsi" 
                                              class="form-control" 
                                              id="create_deskripsi" 
                                              rows="10" 
                                              placeholder="Masukkan deskripsi sambutan">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi') 
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-success" id="createSubmitBtn">
                            <i class="fas fa-save me-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modals -->
    @foreach($sambutan as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content rounded">
                    <div class="modal-header bg-warning text-dark rounded-top">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                            <i class="fas fa-edit me-2"></i>
                            Edit Sambutan Rektor
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm{{ $item->id }}" action="{{ route('admin.sambutan_rektor.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit_judul{{ $item->id }}" class="form-label">
                                            <i class="fas fa-heading me-1"></i>
                                            Judul <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               name="judul" 
                                               class="form-control" 
                                               id="edit_judul{{ $item->id }}" 
                                               value="{{ old('judul', $item->judul) }}" 
                                               required>
                                        @error('judul') 
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_foto{{ $item->id }}" class="form-label">
                                            <i class="fas fa-image me-1"></i>
                                            Foto Baru (Opsional)
                                        </label>
                                        <input type="file" 
                                               name="foto" 
                                               class="form-control" 
                                               id="edit_foto{{ $item->id }}" 
                                               accept="image/*">
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Kosongkan jika tidak ingin mengubah foto.
                                        </div>
                                        <div id="editImagePreview{{ $item->id }}" class="mt-2" style="display: none;">
                                            <img id="editPreviewImg{{ $item->id }}" src="#" class="img-thumbnail rounded" width="150" alt="Preview">
                                        </div>
                                        @error('foto') 
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if ($item->foto)
                                        <div class="mb-3">
                                            <label class="form-label">Foto Saat Ini:</label>
                                            <div>
                                                <img src="{{ Storage::url($item->foto) }}" 
                                                     class="img-thumbnail rounded" 
                                                     width="150" 
                                                     alt="Current Image">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit_deskripsi{{ $item->id }}" class="form-label">
                                            <i class="fas fa-align-left me-1"></i>
                                            Deskripsi <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="deskripsi" 
                                                  class="form-control" 
                                                  id="edit_deskripsi{{ $item->id }}" 
                                                  rows="12">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                                        @error('deskripsi') 
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>
                                Tutup
                            </button>
                            <button type="submit" class="btn btn-warning" id="editSubmitBtn{{ $item->id }}">
                                <i class="fas fa-save me-1"></i>
                                Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // CKEditor instances storage
            let editorInstances = {};

            // Toast configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            // Initialize CKEditor for create modal
            document.addEventListener('DOMContentLoaded', function() {
                // Remove required attribute from textareas
                document.getElementById('create_deskripsi').removeAttribute('required');
                @foreach($sambutan as $item)
                    document.getElementById('edit_deskripsi{{ $item->id }}').removeAttribute('required');
                @endforeach

                // Create editor
                ClassicEditor
                    .create(document.querySelector('#create_deskripsi'), {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'link', '|',
                                'bulletedList', 'numberedList', '|',
                                'outdent', 'indent', '|',
                                'blockQuote', 'insertTable', '|',
                                'undo', 'redo'
                            ]
                        },
                        table: {
                            contentToolbar: [
                                'tableColumn',
                                'tableRow',
                                'mergeTableCells'
                            ]
                        }
                    })
                    .then(editor => {
                        editorInstances['create_deskripsi'] = editor;
                    })
                    .catch(error => {
                        console.error('Error initializing create editor:', error);
                    });

                // Edit editors
                @foreach($sambutan as $item)
                    ClassicEditor
                        .create(document.querySelector('#edit_deskripsi{{ $item->id }}'), {
                            toolbar: {
                                items: [
                                    'heading', '|',
                                    'bold', 'italic', 'link', '|',
                                    'bulletedList', 'numberedList', '|',
                                    'outdent', 'indent', '|',
                                    'blockQuote', 'insertTable', '|',
                                    'undo', 'redo'
                                ]
                            },
                            table: {
                                contentToolbar: [
                                    'tableColumn',
                                    'tableRow',
                                    'mergeTableCells'
                                ]
                            }
                        })
                        .then(editor => {
                            editorInstances['edit_deskripsi{{ $item->id }}'] = editor;
                        })
                        .catch(error => {
                            console.error('Error initializing edit editor {{ $item->id }}:', error);
                        });
                @endforeach

                // Image preview for create modal
                document.getElementById('create_foto').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        if (file.size > 2048 * 1024) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Ukuran file terlalu besar! Maksimal 2MB.'
                            });
                            this.value = '';
                            document.getElementById('createImagePreview').style.display = 'none';
                            return;
                        }

                        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                        if (!allowedTypes.includes(file.type)) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Tipe file tidak valid! Hanya JPEG, PNG, JPG, GIF.'
                            });
                            this.value = '';
                            document.getElementById('createImagePreview').style.display = 'none';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('createPreviewImg').src = e.target.result;
                            document.getElementById('createImagePreview').style.display = 'block';
                        };
                        reader.readAsDataURL(file);

                        Toast.fire({
                            icon: 'success',
                            title: 'Gambar berhasil dipilih!'
                        });
                    } else {
                        document.getElementById('createImagePreview').style.display = 'none';
                    }
                });

                // Image preview for edit modals
                @foreach($sambutan as $item)
                    document.getElementById('edit_foto{{ $item->id }}').addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            if (file.size > 2048 * 1024) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Ukuran file terlalu besar! Maksimal 2MB.'
                                });
                                this.value = '';
                                document.getElementById('editImagePreview{{ $item->id }}').style.display = 'none';
                                return;
                            }

                            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                            if (!allowedTypes.includes(file.type)) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Tipe file tidak valid! Hanya JPEG, PNG, JPG, GIF.'
                                });
                                this.value = '';
                                document.getElementById('editImagePreview{{ $item->id }}').style.display = 'none';
                                return;
                            }

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('editPreviewImg{{ $item->id }}').src = e.target.result;
                                document.getElementById('editImagePreview{{ $item->id }}').style.display = 'block';
                            };
                            reader.readAsDataURL(file);

                            Toast.fire({
                                icon: 'success',
                                title: 'Gambar berhasil dipilih!'
                            });
                        } else {
                            document.getElementById('editImagePreview{{ $item->id }}').style.display = 'none';
                        }
                    });
                @endforeach

                // Show session messages as toasts
                @if(session('success'))
                    Toast.fire({
                        icon: 'success',
                        title: '{{ session('success') }}'
                    });
                @endif

                @if(session('error'))
                    Toast.fire({
                        icon: 'error',
                        title: '{{ session('error') }}'
                    });
                @endif

                @if($errors->any())
                    Toast.fire({
                        icon: 'error',
                        title: 'Periksa input Anda dan coba lagi.'
                    });
                @endif
            });

            // Custom validation function
            function validateForm(formId, editorId) {
                const form = document.getElementById(formId);
                const editor = editorInstances[editorId];

                if (!editor || editor.getData().trim() === '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Deskripsi harus diisi!'
                    });
                    return false;
                }

                const requiredFields = form.querySelectorAll('input[required]');
                for (let field of requiredFields) {
                    if (!field.value.trim()) {
                        field.focus();
                        Toast.fire({
                            icon: 'error',
                            title: `Field ${field.previousElementSibling.textContent.replace('*', '').trim()} harus diisi!`
                        });
                        return false;
                    }
                }

                return true;
            }

            // Handle create form submission
            document.getElementById('createForm').addEventListener('submit', function(e) {
                e.preventDefault();

                if (!validateForm('createForm', 'create_deskripsi')) {
                    return;
                }

                Swal.fire({
                    title: 'Simpan Sambutan?',
                    text: "Apakah Anda yakin ingin menyimpan sambutan ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const submitBtn = document.getElementById('createSubmitBtn');
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';

                        if (editorInstances['create_deskripsi']) {
                            document.getElementById('create_deskripsi').value = editorInstances['create_deskripsi'].getData();
                        }

                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu sebentar.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        this.submit();
                    }
                });
            });

            // Handle edit form submissions
            @foreach($sambutan as $item)
                document.getElementById('editForm{{ $item->id }}').addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (!validateForm('editForm{{ $item->id }}', 'edit_deskripsi{{ $item->id }}')) {
                        return;
                    }

                    Swal.fire({
                        title: 'Perbarui Sambutan?',
                        text: "Apakah Anda yakin ingin memperbarui sambutan ini?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#ffc107',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Ya, perbarui!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const submitBtn = document.getElementById('editSubmitBtn{{ $item->id }}');
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memperbarui...';

                            if (editorInstances['edit_deskripsi{{ $item->id }}']) {
                                document.getElementById('edit_deskripsi{{ $item->id }}').value = editorInstances['edit_deskripsi{{ $item->id }}'].getData();
                            }

                            Swal.fire({
                                title: 'Memperbarui...',
                                text: 'Mohon tunggu sebentar.',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            this.submit();
                        }
                    });
                });
            @endforeach

            // Reset create form when modal is closed
            document.getElementById('createModal').addEventListener('hidden.bs.modal', function () {
                const form = this.querySelector('form');
                form.reset();
                if (editorInstances['create_deskripsi']) {
                    editorInstances['create_deskripsi'].setData('');
                }
                document.getElementById('createImagePreview').style.display = 'none';
                const submitBtn = document.getElementById('createSubmitBtn');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>Simpan';
            });

            // Confirm delete function
            function confirmDelete(id, title) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Apakah Anda yakin ingin menghapus sambutan:<br><strong>"${title}"</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash me-1"></i>Ya, Hapus!',
                    cancelButtonText: '<i class="fas fa-times me-1"></i>Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('deleteForm');
                        form.action = '{{ route("admin.sambutan_rektor.destroy", "") }}/' + id;
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            }
        </script>
    @endpush
@endsection