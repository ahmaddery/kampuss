@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-users me-2"></i> Manajemen Pengguna</h3>
            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Pengguna
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
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Foto Profil</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr class="align-middle">
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td class="fw-medium">{{ $user->name }}</td>
                                    <td class="text-muted">{{ $user->email }}</td>
                                    <td>
                                        @if($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                                 width="50" height="50" 
                                                 class="rounded-circle shadow-sm object-cover" 
                                                 alt="Foto Profil {{ $user->name }}">
                                        @else
                                            <img src="{{ asset('storage/default-profile.jpg') }}" 
                                                 width="50" height="50" 
                                                 class="rounded-circle shadow-sm object-cover" 
                                                 alt="Foto Profil Default">
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->trashed())
                                            <span class="badge bg-danger text-white fw-normal px-2 py-1">
                                                <i class="fas fa-user-times me-1"></i> Nonaktif
                                            </span>
                                        @else
                                            <span class="badge bg-success text-white fw-normal px-2 py-1">
                                                <i class="fas fa-user-check me-1"></i> Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            @if($user->trashed())
                                                <!-- Pengguna yang sudah di-soft delete -->
                                                <form action="{{ route('admin.users.reactivate', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-success" title="Aktifkan">
                                                        <i class="fas fa-user-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Pengguna yang aktif -->
                                                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menonaktifkan pengguna ini?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" title="Nonaktifkan">
                                                        <i class="fas fa-user-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">
                    <i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-1"></i> Nama <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i> Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">
                            <i class="fas fa-image me-1"></i> Foto Profil
                        </label>
                        <input type="file" name="profile_picture" class="form-control" accept="image/*">
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Format: JPG, PNG, GIF. Maksimal 2MB.
                        </div>
                        @error('profile_picture')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toast configuration
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

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

    // Reset modal when closed
    document.getElementById('createUserModal').addEventListener('hidden.bs.modal', function () {
        const form = this.querySelector('form');
        form.reset();
    });
});
</script>
@endpush

@endsection
