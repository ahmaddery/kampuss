@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-info-circle me-2"></i> Manajemen Informasi Program</h3>
            <a href="{{ route('admin.informasi-program.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Tambah Informasi Program
            </a>
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
                                <th scope="col">Program Studi</th>
                                <th scope="col">Jenjang</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">SKS</th>
                                <th scope="col">Akreditasi</th>
                                <th scope="col">Gelar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($informasiPrograms as $index => $informasi)
                                <tr class="align-middle">
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td class="fw-medium">{{ $informasi->jurusan->jurusan }}</td>
                                    <td><span class="badge bg-primary">{{ $informasi->jenjang }}</span></td>
                                    <td>{{ $informasi->durasi }}</td>
                                    <td>{{ $informasi->sks }}</td>
                                    <td>
                                        @if($informasi->akreditasi)
                                            <span class="badge bg-success">{{ $informasi->akreditasi }}</span>
                                        @else
                                            <span class="badge bg-secondary">Belum ada</span>
                                        @endif
                                    </td>
                                    <td class="fw-medium">{{ $informasi->gelar }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.informasi-program.show', $informasi) }}" class="btn btn-outline-info" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.informasi-program.edit', $informasi) }}" class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $informasi->id }}, '{{ $informasi->jurusan->jurusan }}')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- Hidden form for delete -->
                                        <form id="delete-form-{{ $informasi->id }}" action="{{ route('admin.informasi-program.destroy', $informasi) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Belum ada data informasi program.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
    });

    // Confirm delete function
    function confirmDelete(id, namaProgram) {
        Swal.fire({
            title: 'Hapus Informasi Program?',
            text: "Apakah Anda yakin ingin menghapus informasi program '" + namaProgram + "'? Data yang dihapus tidak dapat dikembalikan!",
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
    </script>
@endpush

@endsection
