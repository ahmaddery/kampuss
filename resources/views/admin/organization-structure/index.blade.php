@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-sitemap me-2"></i> Manajemen Struktur Organisasi</h3>
            <a href="{{ route('admin.organization-structure.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Tambah Unit
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

                <!-- Search and Filter -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="searchInput" placeholder="Cari unit organisasi...">
                        </div>
                    </div>
                </div>

                <!-- Organization Structure Tree -->
                <div class="table-responsive">
                    @if($structures->count() > 0)
                        <table class="table table-hover table-borderless align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-semibold text-dark ps-3">Unit Organisasi</th>
                                    <th class="fw-semibold text-dark">Jabatan</th>
                                    <th class="fw-semibold text-dark">Pejabat</th>
                                    <th class="fw-semibold text-dark">Gambar</th>
                                    <th class="fw-semibold text-dark text-center">Urutan</th>
                                    <th class="fw-semibold text-dark text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="organizationTable">
                                @foreach($structures as $structure)
                                    @include('admin.organization-structure.partials.structure-row', ['structure' => $structure, 'level' => 0])
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-sitemap fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum Ada Struktur Organisasi</h5>
                            <p class="text-muted mb-4">Mulai dengan menambahkan unit organisasi pertama.</p>
                            <a href="{{ route('admin.organization-structure.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Tambah Unit Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#organizationTable tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Delete confirmation
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var unitName = $(this).data('unit-name');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus unit "' + unitName + '"? Semua unit di bawahnya akan kehilangan parent.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.structure-level-0 { padding-left: 15px; }
.structure-level-1 { padding-left: 35px; }
.structure-level-2 { padding-left: 55px; }
.structure-level-3 { padding-left: 75px; }

.structure-row {
    border-left: 3px solid transparent;
    transition: all 0.3s ease;
}

.structure-row:hover {
    background-color: #f8f9fa;
    border-left-color: #007bff;
}

.unit-image {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 8px;
}

.unit-name {
    font-weight: 600;
    color: #2c3e50;
}

.position-badge {
    font-size: 0.85em;
    padding: 0.4em 0.8em;
}
</style>
@endpush
@endsection
