@extends('layouts.admin')

@section('title', 'Detail Informasi Program')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Detail Informasi Program</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.informasi-program.index') }}">Informasi Program</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title mb-0">Detail Informasi Program</h4>
                        </div>
                        <div class="col-auto">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.informasi-program.edit', $informasiProgram) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('admin.informasi-program.index') }}" 
                                   class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Program Information -->
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium text-muted" style="width: 200px;">Jurusan:</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($informasiProgram->jurusan->icon)
                                                        <img src="{{ asset('storage/' . $informasiProgram->jurusan->icon) }}" 
                                                             alt="{{ $informasiProgram->jurusan->jurusan }}" 
                                                             class="me-3" 
                                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1">{{ $informasiProgram->jurusan->jurusan }}</h6>
                                                        <small class="text-muted">{{ $informasiProgram->jurusan->deskripsi }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Jenjang:</td>
                                            <td>
                                                <span class="badge bg-primary fs-6">{{ $informasiProgram->jenjang }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Durasi:</td>
                                            <td>
                                                <i class="fas fa-clock text-success me-2"></i>
                                                {{ $informasiProgram->durasi }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Total SKS:</td>
                                            <td>
                                                <i class="fas fa-book text-info me-2"></i>
                                                {{ $informasiProgram->sks }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Akreditasi:</td>
                                            <td>
                                                <span class="badge bg-success fs-6">
                                                    <i class="fas fa-certificate me-1"></i>
                                                    {{ $informasiProgram->akreditasi }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Gelar:</td>
                                            <td>
                                                <strong class="text-primary">{{ $informasiProgram->gelar }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Dibuat:</td>
                                            <td>
                                                <i class="fas fa-calendar text-muted me-2"></i>
                                                {{ $informasiProgram->created_at->format('d F Y, H:i') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Diperbarui:</td>
                                            <td>
                                                <i class="fas fa-calendar text-muted me-2"></i>
                                                {{ $informasiProgram->updated_at->format('d F Y, H:i') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Statistics Cards -->
                        <div class="col-lg-4">
                            <div class="row g-3">
                                <!-- Duration Card -->
                                <div class="col-12">
                                    <div class="card bg-gradient-primary text-white border-0">
                                        <div class="card-body text-center">
                                            <div class="mb-2">
                                                <i class="fas fa-clock fa-2x"></i>
                                            </div>
                                            <h5 class="mb-1">{{ $informasiProgram->durasi }}</h5>
                                            <p class="mb-0 small">Durasi Studi</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- SKS Card -->
                                <div class="col-12">
                                    <div class="card bg-gradient-success text-white border-0">
                                        <div class="card-body text-center">
                                            <div class="mb-2">
                                                <i class="fas fa-book fa-2x"></i>
                                            </div>
                                            <h5 class="mb-1">{{ $informasiProgram->sks }}</h5>
                                            <p class="mb-0 small">Total SKS</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accreditation Card -->
                                <div class="col-12">
                                    <div class="card bg-gradient-warning text-white border-0">
                                        <div class="card-body text-center">
                                            <div class="mb-2">
                                                <i class="fas fa-certificate fa-2x"></i>
                                            </div>
                                            <h5 class="mb-1">{{ $informasiProgram->akreditasi }}</h5>
                                            <p class="mb-0 small">Akreditasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Information -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informasi Jurusan Terkait
                    </h5>
                </div>
                <div class="card-body">
                    @if($informasiProgram->jurusan->deskripsi_lengkap)
                        <div class="mb-3">
                            <h6 class="fw-semibold">Deskripsi Lengkap:</h6>
                            <div class="text-muted">
                                {!! nl2br(e($informasiProgram->jurusan->deskripsi_lengkap)) !!}
                            </div>
                        </div>
                    @endif

                    @if($informasiProgram->jurusan->seo_title || $informasiProgram->jurusan->seo_description)
                        <div class="row">
                            @if($informasiProgram->jurusan->seo_title)
                                <div class="col-md-6 mb-3">
                                    <h6 class="fw-semibold">SEO Title:</h6>
                                    <p class="text-muted mb-0">{{ $informasiProgram->jurusan->seo_title }}</p>
                                </div>
                            @endif
                            @if($informasiProgram->jurusan->seo_description)
                                <div class="col-md-6 mb-3">
                                    <h6 class="fw-semibold">SEO Description:</h6>
                                    <p class="text-muted mb-0">{{ $informasiProgram->jurusan->seo_description }}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-semibold">Slug:</h6>
                            <code>{{ $informasiProgram->jurusan->slug }}</code>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-semibold">Link Public:</h6>
                            <a href="{{ route('jurusan.show', $informasiProgram->jurusan->slug) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i>
                                Lihat Halaman Public
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="text-end">
                <button type="button" 
                        class="btn btn-danger" 
                        onclick="confirmDelete({{ $informasiProgram->id }})">
                    <i class="fas fa-trash"></i> Hapus
                </button>
                <a href="{{ route('admin.informasi-program.edit', $informasiProgram) }}" 
                   class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus informasi program ini?</p>
                <p class="text-muted small">
                    <i class="fas fa-exclamation-triangle text-warning me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = `{{ route('admin.informasi-program.index') }}/${id}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Success message auto-hide
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endpush

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.table-borderless td {
    padding: 1rem 0.75rem;
    border-bottom: 1px solid #e9ecef;
}

.table-borderless tr:last-child td {
    border-bottom: none;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid #e3e6f0;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.badge {
    padding: 0.5rem 0.75rem;
}

code {
    color: #e83e8c;
    background-color: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}
</style>
@endpush
