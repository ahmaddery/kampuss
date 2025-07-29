@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('admin.organization-structure.index') }}">Struktur Organisasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Unit</li>
                </ol>
            </nav>
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-eye me-2"></i> Detail Unit Organisasi</h3>
        </div>

        <div class="row">
            <!-- Main Information -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-building me-2"></i> Informasi Unit</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-semibold text-muted small">NAMA UNIT</label>
                                    <div class="fs-5 fw-bold text-primary">{{ $organizationStructure->unit_name }}</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="fw-semibold text-muted small">UNIT INDUK</label>
                                    <div>
                                        @if($organizationStructure->parent)
                                            <a href="{{ route('admin.organization-structure.show', $organizationStructure->parent->id) }}" 
                                               class="text-decoration-none">
                                                {{ $organizationStructure->parent->unit_name }}
                                            </a>
                                        @else
                                            <span class="text-muted">Unit Tingkat Atas</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="fw-semibold text-muted small">URUTAN TAMPIL</label>
                                    <div><span class="badge bg-secondary fs-6">{{ $organizationStructure->order_position }}</span></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-semibold text-muted small">JABATAN</label>
                                    <div>
                                        @if($organizationStructure->position_title)
                                            <span class="badge bg-success fs-6">{{ $organizationStructure->position_title }}</span>
                                        @else
                                            <span class="text-muted">Tidak ada jabatan</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="fw-semibold text-muted small">NAMA PEJABAT</label>
                                    <div>
                                        @if($organizationStructure->person_name)
                                            <span class="fw-medium">{{ $organizationStructure->person_name }}</span>
                                        @else
                                            <span class="text-muted">Tidak ada pejabat</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="fw-semibold text-muted small">HIERARKI LENGKAP</label>
                                    <div>{{ $organizationStructure->getFullPath() }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <label class="fw-semibold text-muted small">TANGGAL DIBUAT</label>
                                <div>{{ $organizationStructure->created_at->format('d F Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Children Units -->
                @if($organizationStructure->children->count() > 0)
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-sitemap me-2"></i> Unit di Bawahnya ({{ $organizationStructure->children->count() }})</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Unit</th>
                                            <th>Jabatan</th>
                                            <th>Pejabat</th>
                                            <th>Urutan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($organizationStructure->children as $child)
                                            <tr>
                                                <td>
                                                    <div class="fw-medium">{{ $child->unit_name }}</div>
                                                </td>
                                                <td>
                                                    @if($child->position_title)
                                                        <span class="badge bg-primary">{{ $child->position_title }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($child->person_name)
                                                        {{ $child->person_name }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $child->order_position }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.organization-structure.show', $child->id) }}" 
                                                           class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.organization-structure.edit', $child->id) }}" 
                                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Image -->
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-image me-2"></i> Logo/Gambar</h5>
                    </div>
                    <div class="card-body p-4 text-center">
                        @if($organizationStructure->image_path)
                            <img src="{{ asset('storage/' . $organizationStructure->image_path) }}" 
                                 alt="{{ $organizationStructure->unit_name }}" 
                                 class="img-fluid rounded border" style="max-height: 200px;">
                        @else
                            <div class="text-muted py-5">
                                <i class="fas fa-image fa-3x mb-3"></i>
                                <div>Tidak ada gambar</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-cogs me-2"></i> Aksi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.organization-structure.edit', $organizationStructure->id) }}" 
                               class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i> Edit Unit
                            </a>
                            <a href="{{ route('admin.organization-structure.create') }}?parent_id={{ $organizationStructure->id }}" 
                               class="btn btn-success">
                                <i class="fas fa-plus me-1"></i> Tambah Unit Anak
                            </a>
                            <hr>
                            <form action="{{ route('admin.organization-structure.destroy', $organizationStructure->id) }}" 
                                  method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash me-1"></i> Hapus Unit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i> Statistik</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-end">
                                    <div class="h3 mb-1 text-primary">{{ $organizationStructure->children->count() }}</div>
                                    <div class="small text-muted">Unit Anak</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="h3 mb-1 text-success">{{ $organizationStructure->getAllDescendants()->count() }}</div>
                                <div class="small text-muted">Total Keturunan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Delete confirmation
    $('.delete-form').submit(function(e) {
        e.preventDefault();
        var form = this;
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus unit "{{ $organizationStructure->unit_name }}"?',
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
@endsection
