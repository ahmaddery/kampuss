@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-graduation-cap me-2"></i> Manajemen Jurusan</h3>
            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#addJurusanModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Jurusan
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
                                <th scope="col">Jurusan</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jurusans as $index => $jurusan)
                                <tr class="align-middle">
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td class="fw-medium">{{ $jurusan->jurusan }}</td>
                                    <td class="text-muted"><code>{{ $jurusan->slug }}</code></td>
                                    <td class="text-muted">{!! Str::limit($jurusan->deskripsi, 50) !!}</td>
                                    <td>
                                        @if($jurusan->icon)
                                            <img src="{{ Storage::url($jurusan->icon) }}" width="60" height="60" class="rounded-3 shadow-sm object-cover" alt="Icon Jurusan">
                                        @else
                                            <span class="badge bg-secondary text-white fw-normal px-2 py-1">Tidak ada icon</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#showJurusanModal{{ $jurusan->id }}" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editJurusanModal{{ $jurusan->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $jurusan->id }}, '{{ $jurusan->jurusan }}')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- Hidden form for delete -->
                                        <form id="delete-form-{{ $jurusan->id }}" action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                        <!-- Modal Show Jurusan -->
                        <div class="modal fade" id="showJurusanModal{{ $jurusan->id }}" tabindex="-1" role="dialog" aria-labelledby="showJurusanModalLabel{{ $jurusan->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showJurusanModalLabel{{ $jurusan->id }}">Detail Jurusan: {{ $jurusan->jurusan }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text-xl font-semibold">Nama Jurusan:</h3>
                                        <p>{{ $jurusan->jurusan }}</p>

                                        <h3 class="text-xl font-semibold mt-2">Slug:</h3>
                                        <p><code>{{ $jurusan->slug }}</code></p>

                                        <h3 class="text-xl font-semibold mt-2">Deskripsi:</h3>
                                        <p>{{ $jurusan->deskripsi }}</p>

                                        @if($jurusan->deskripsi_lengkap)
                                        <h3 class="text-xl font-semibold mt-2">Deskripsi Lengkap:</h3>
                                        <p>{{ $jurusan->deskripsi_lengkap }}</p>
                                        @endif

                                        @if($jurusan->seo_title)
                                        <h3 class="text-xl font-semibold mt-2">SEO Title:</h3>
                                        <p>{{ $jurusan->seo_title }}</p>
                                        @endif

                                        @if($jurusan->seo_description)
                                        <h3 class="text-xl font-semibold mt-2">SEO Description:</h3>
                                        <p>{{ $jurusan->seo_description }}</p>
                                        @endif

                                        <h3 class="text-xl font-semibold mt-2">Icon:</h3>
                                        @if($jurusan->icon)
                                            <img src="{{ Storage::url($jurusan->icon) }}" alt="Icon" class="w-[100px] h-[100px] object-contain rounded-full mt-2">
                                        @else
                                            <p class="text-gray-500">Tidak ada icon</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit Jurusan -->
                        <div class="modal fade" id="editJurusanModal{{ $jurusan->id }}" tabindex="-1" role="dialog" aria-labelledby="editJurusanModalLabel{{ $jurusan->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editJurusanModalLabel{{ $jurusan->id }}">Edit Jurusan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editJurusanForm{{ $jurusan->id }}" action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <!-- Input untuk Icon (Upload Gambar) -->
                                            <div class="form-group">
                                                <label for="edit_icon{{ $jurusan->id }}">Icon (Upload Gambar) <span class="text-muted">(Opsional)</span></label>
                                                <input type="file" name="icon" id="edit_icon{{ $jurusan->id }}" class="form-control" accept="image/*" onchange="previewEditImage({{ $jurusan->id }}, this)">
                                                
                                                <!-- Menampilkan gambar lama jika ada -->
                                                @if($jurusan->icon)
                                                    <p class="mt-2">Gambar Saat Ini:</p>
                                                    <img id="current_image{{ $jurusan->id }}" src="{{ asset('storage/' . $jurusan->icon) }}" alt="Icon" width="100" class="mt-2">
                                                @endif
                                                
                                                <!-- Preview gambar baru -->
                                                <div id="edit_imagePreview{{ $jurusan->id }}" style="display: none;" class="mt-2">
                                                    <p>Preview Gambar Baru:</p>
                                                    <img id="edit_previewImg{{ $jurusan->id }}" src="" alt="Preview" width="100">
                                                </div>
                                            </div>

                                            <!-- Input untuk Nama Jurusan -->
                                            <div class="form-group">
                                                <label for="edit_jurusan{{ $jurusan->id }}">Nama Jurusan</label>
                                                <input type="text" name="jurusan" id="edit_jurusan{{ $jurusan->id }}" class="form-control" value="{{ old('jurusan', $jurusan->jurusan) }}" required>
                                            </div>

                                            <!-- Input untuk Slug -->
                                            <div class="form-group">
                                                <label for="edit_slug{{ $jurusan->id }}">Slug <span class="text-muted">(Opsional)</span></label>
                                                <input type="text" name="slug" id="edit_slug{{ $jurusan->id }}" class="form-control" value="{{ old('slug', $jurusan->slug) }}" placeholder="Contoh: teknik-informatika">
                                                <small class="form-text text-muted">URL friendly untuk routing. Biarkan kosong untuk generate otomatis.</small>
                                            </div>

                                            <!-- Input untuk Deskripsi -->
                                            <div class="form-group">
                                                <label for="edit_deskripsi{{ $jurusan->id }}">Deskripsi Singkat</label>
                                                <textarea name="deskripsi" id="edit_deskripsi{{ $jurusan->id }}" class="form-control" rows="3" required>{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                                            </div>

                                            <!-- Input untuk Deskripsi Lengkap -->
                                            <div class="form-group">
                                                <label for="edit_deskripsi_lengkap{{ $jurusan->id }}">Deskripsi Lengkap <span class="text-muted">(Opsional)</span></label>
                                                <textarea name="deskripsi_lengkap" id="edit_deskripsi_lengkap{{ $jurusan->id }}" class="form-control" rows="5">{{ old('deskripsi_lengkap', $jurusan->deskripsi_lengkap) }}</textarea>
                                                <small class="form-text text-muted">Detail lengkap untuk halaman jurusan.</small>
                                            </div>

                                            <!-- Input untuk SEO Title -->
                                            <div class="form-group">
                                                <label for="edit_seo_title{{ $jurusan->id }}">SEO Title <span class="text-muted">(Opsional)</span></label>
                                                <input type="text" name="seo_title" id="edit_seo_title{{ $jurusan->id }}" class="form-control" value="{{ old('seo_title', $jurusan->seo_title) }}" placeholder="Judul untuk SEO">
                                                <small class="form-text text-muted">Akan menggunakan nama jurusan jika kosong.</small>
                                            </div>

                                            <!-- Input untuk SEO Description -->
                                            <div class="form-group">
                                                <label for="edit_seo_description{{ $jurusan->id }}">SEO Description <span class="text-muted">(Opsional)</span></label>
                                                <textarea name="seo_description" id="edit_seo_description{{ $jurusan->id }}" class="form-control" rows="2">{{ old('seo_description', $jurusan->seo_description) }}</textarea>
                                                <small class="form-text text-muted">Meta deskripsi untuk SEO. Akan menggunakan deskripsi singkat jika kosong.</small>
                                            </div>

                                            <button type="button" class="btn btn-primary mt-3" onclick="confirmUpdate({{ $jurusan->id }})">
                                                <i class="fas fa-save"></i> Perbarui
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada data jurusan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Tambah Jurusan -->
    <div class="modal fade" id="addJurusanModal" tabindex="-1" role="dialog" aria-labelledby="addJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJurusanModalLabel"><i class="fas fa-plus-circle"></i> Tambah Jurusan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addJurusanForm" action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Input untuk Icon (Upload Gambar) -->
                        <div class="form-group">
                            <label for="add_icon">Icon (Upload Gambar) <span class="text-muted">(Opsional)</span></label>
                            <input type="file" name="icon" id="add_icon" class="form-control" accept="image/*" onchange="previewAddImage(this)">
                            
                            <!-- Preview gambar -->
                            <div id="add_imagePreview" style="display: none;" class="mt-2">
                                <p>Preview:</p>
                                <img id="add_previewImg" src="" alt="Preview" width="100">
                            </div>
                        </div>

                        <!-- Input untuk Nama Jurusan -->
                        <div class="form-group">
                            <label for="add_jurusan">Nama Jurusan</label>
                            <input type="text" name="jurusan" id="add_jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                        </div>

                        <!-- Input untuk Slug -->
                        <div class="form-group">
                            <label for="add_slug">Slug <span class="text-muted">(Opsional - akan dibuat otomatis jika kosong)</span></label>
                            <input type="text" name="slug" id="add_slug" class="form-control" value="{{ old('slug') }}" placeholder="Contoh: teknik-informatika">
                            <small class="form-text text-muted">URL friendly untuk routing. Biarkan kosong untuk generate otomatis.</small>
                        </div>

                        <!-- Input untuk Deskripsi -->
                        <div class="form-group">
                            <label for="add_deskripsi">Deskripsi Singkat</label>
                            <textarea name="deskripsi" id="add_deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- Input untuk Deskripsi Lengkap -->
                        <div class="form-group">
                            <label for="add_deskripsi_lengkap">Deskripsi Lengkap <span class="text-muted">(Opsional)</span></label>
                            <textarea name="deskripsi_lengkap" id="add_deskripsi_lengkap" class="form-control" rows="5">{{ old('deskripsi_lengkap') }}</textarea>
                            <small class="form-text text-muted">Detail lengkap untuk halaman jurusan.</small>
                        </div>

                        <!-- Input untuk SEO Title -->
                        <div class="form-group">
                            <label for="add_seo_title">SEO Title <span class="text-muted">(Opsional)</span></label>
                            <input type="text" name="seo_title" id="add_seo_title" class="form-control" value="{{ old('seo_title') }}" placeholder="Judul untuk SEO">
                            <small class="form-text text-muted">Akan menggunakan nama jurusan jika kosong.</small>
                        </div>

                        <!-- Input untuk SEO Description -->
                        <div class="form-group">
                            <label for="add_seo_description">SEO Description <span class="text-muted">(Opsional)</span></label>
                            <textarea name="seo_description" id="add_seo_description" class="form-control" rows="2">{{ old('seo_description') }}</textarea>
                            <small class="form-text text-muted">Meta deskripsi untuk SEO. Akan menggunakan deskripsi singkat jika kosong.</small>
                        </div>

                        <button type="button" class="btn btn-success mt-3" onclick="confirmStore()">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Pastikan sudah ada script berikut di bagian footer -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

@push('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Show success toast
        @if(session('toast_success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('toast_success') }}'
            });
        @endif

        // Show error toast
        @if(session('toast_error'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('toast_error') }}'
            });
        @endif

        // Show validation error toast
        @if($errors->any())
            let errorMessages = '';
            @foreach($errors->all() as $error)
                errorMessages += '{{ $error }}\n';
            @endforeach
            
            Toast.fire({
                icon: 'error',
                title: 'Validation Error',
                html: errorMessages.replace(/\n/g, '<br>')
            });
        @endif
    });

    // Confirm store function
    function confirmStore() {
        // Validate form first
        const form = document.getElementById('addJurusanForm');
        const icon = document.getElementById('add_icon').files[0];
        const jurusan = document.getElementById('add_jurusan').value.trim();
        const deskripsi = document.getElementById('add_deskripsi').value.trim();

        if (!jurusan || !deskripsi) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Nama jurusan dan deskripsi harus diisi!'
            });
            return;
        }

        // Validate file size (2MB) if file is selected
        if (icon && icon.size > 2048 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File terlalu besar!',
                text: 'Maksimal ukuran file 2MB.'
            });
            return;
        }

        Swal.fire({
            title: 'Simpan Jurusan Baru?',
            text: "Apakah Anda yakin ingin menyimpan jurusan ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sementara data disimpan.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            }
        });
    }

    // Confirm update function
    function confirmUpdate(id) {
        const form = document.getElementById('editJurusanForm' + id);
        const jurusan = document.getElementById('edit_jurusan' + id).value.trim();
        const deskripsi = document.getElementById('edit_deskripsi' + id).value.trim();

        if (!jurusan || !deskripsi) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Nama jurusan dan deskripsi harus diisi!'
            });
            return;
        }

        // Validate file size if file is selected
        const iconInput = document.getElementById('edit_icon' + id);
        if (iconInput.files[0] && iconInput.files[0].size > 2048 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File terlalu besar!',
                text: 'Maksimal ukuran file 2MB.'
            });
            return;
        }

        Swal.fire({
            title: 'Perbarui Jurusan?',
            text: "Apakah Anda yakin ingin memperbarui data jurusan ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, perbarui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memperbarui...',
                    text: 'Mohon tunggu sementara data diperbarui.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            }
        });
    }

    // Confirm delete function
    function confirmDelete(id, namaJurusan) {
        Swal.fire({
            title: 'Hapus Jurusan?',
            text: "Apakah Anda yakin ingin menghapus jurusan '" + namaJurusan + "'? Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sementara data dihapus.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Preview image for add form
    function previewAddImage(input) {
        const file = input.files[0];
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        if (file) {
            // Validate file size (2MB)
            if (file.size > 2048 * 1024) {
                Toast.fire({
                    icon: 'error',
                    title: 'File terlalu besar! Maksimal 2MB.'
                });
                input.value = '';
                document.getElementById('add_imagePreview').style.display = 'none';
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
            if (!allowedTypes.includes(file.type)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Tipe file tidak valid! Hanya JPEG, PNG, JPG, GIF, SVG yang diizinkan.'
                });
                input.value = '';
                document.getElementById('add_imagePreview').style.display = 'none';
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('add_previewImg').src = e.target.result;
                document.getElementById('add_imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);

            Toast.fire({
                icon: 'success',
                title: 'Gambar berhasil dipilih!'
            });
        } else {
            document.getElementById('add_imagePreview').style.display = 'none';
        }
    }

    // Preview image for edit form
    function previewEditImage(id, input) {
        const file = input.files[0];
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        if (file) {
            // Validate file size (2MB)
            if (file.size > 2048 * 1024) {
                Toast.fire({
                    icon: 'error',
                    title: 'File terlalu besar! Maksimal 2MB.'
                });
                input.value = '';
                document.getElementById('edit_imagePreview' + id).style.display = 'none';
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
            if (!allowedTypes.includes(file.type)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Tipe file tidak valid! Hanya JPEG, PNG, JPG, GIF, SVG yang diizinkan.'
                });
                input.value = '';
                document.getElementById('edit_imagePreview' + id).style.display = 'none';
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('edit_previewImg' + id).src = e.target.result;
                document.getElementById('edit_imagePreview' + id).style.display = 'block';
            };
            reader.readAsDataURL(file);

            Toast.fire({
                icon: 'success',
                title: 'Gambar berhasil dipilih!'
            });
        } else {
            document.getElementById('edit_imagePreview' + id).style.display = 'none';
        }
    }
    </script>
    @endpush

@endsection
