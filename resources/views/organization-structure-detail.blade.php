@extends('layouts.app')

@section('title', $structure->unit_name . ' - Struktur Organisasi')

@section('content')
<div class="hero-section bg-gradient text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('organization-structure.index') }}" class="text-white-50">Struktur Organisasi</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $structure->unit_name }}</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">{{ $structure->unit_name }}</h1>
                @if($structure->position_title && $structure->person_name)
                    <p class="lead mb-0">{{ $structure->position_title }}: {{ $structure->person_name }}</p>
                @endif
            </div>
            <div class="col-lg-4 text-end">
                @if($structure->image_path)
                    <img src="{{ asset('storage/' . $structure->image_path) }}" 
                         alt="{{ $structure->unit_name }}" 
                         class="img-fluid rounded-3" style="max-height: 150px;">
                @else
                    <i class="fas fa-building fa-5x opacity-75"></i>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Unit Information -->
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Unit</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">NAMA UNIT</label>
                                <div class="h5 text-primary">{{ $structure->unit_name }}</div>
                            </div>
                            @if($structure->parent)
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted">UNIT INDUK</label>
                                    <div>
                                        <a href="{{ route('organization-structure.show', $structure->parent->id) }}" 
                                           class="text-decoration-none">
                                            {{ $structure->parent->unit_name }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($structure->position_title)
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted">JABATAN</label>
                                    <div><span class="badge bg-success fs-6">{{ $structure->position_title }}</span></div>
                                </div>
                            @endif
                            @if($structure->person_name)
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted">PEJABAT</label>
                                    <div class="fw-semibold">{{ $structure->person_name }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="small fw-bold text-muted">HIERARKI LENGKAP</label>
                        <div class="bg-light p-3 rounded">
                            {{ $structure->getFullPath() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sub Units -->
            @if($structure->children->count() > 0)
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fas fa-sitemap me-2"></i>Unit di Bawahnya ({{ $structure->children->count() }})</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            @foreach($structure->children as $child)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-3 text-center">
                                                    @if($child->image_path)
                                                        <img src="{{ asset('storage/' . $child->image_path) }}" 
                                                             alt="{{ $child->unit_name }}" 
                                                             class="img-fluid rounded" style="max-height: 60px;">
                                                    @else
                                                        <div class="bg-secondary rounded d-inline-flex align-items-center justify-content-center" 
                                                             style="width: 60px; height: 60px;">
                                                            <i class="fas fa-building text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-9">
                                                    <h6 class="fw-bold mb-2">
                                                        <a href="{{ route('organization-structure.show', $child->id) }}" 
                                                           class="text-decoration-none">
                                                            {{ $child->unit_name }}
                                                        </a>
                                                    </h6>
                                                    @if($child->position_title && $child->person_name)
                                                        <div class="mb-1">
                                                            <span class="badge bg-primary">{{ $child->position_title }}</span>
                                                        </div>
                                                        <div class="small text-muted">{{ $child->person_name }}</div>
                                                    @endif
                                                    @if($child->children->count() > 0)
                                                        <div class="small text-info mt-2">
                                                            <i class="fas fa-sitemap me-1"></i>{{ $child->children->count() }} sub-unit
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Navigation -->
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-compass me-2"></i>Navigasi</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('organization-structure.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                        </a>
                        @if($structure->parent)
                            <a href="{{ route('organization-structure.show', $structure->parent->id) }}" 
                               class="btn btn-outline-success">
                                <i class="fas fa-arrow-up me-1"></i> Unit Induk
                            </a>
                        @endif
                        @if($structure->children->count() > 0)
                            <hr>
                            <div class="small fw-bold text-muted mb-2">UNIT DI BAWAHNYA:</div>
                            @foreach($structure->children as $child)
                                <a href="{{ route('organization-structure.show', $child->id) }}" 
                                   class="btn btn-outline-info btn-sm mb-1">
                                    {{ $child->unit_name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistik</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <div class="h3 mb-1 text-primary">{{ $structure->children->count() }}</div>
                                <div class="small text-muted">Unit Langsung</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="h3 mb-1 text-success">{{ $structure->getAllDescendants()->count() }}</div>
                            <div class="small text-muted">Total Keturunan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.breadcrumb-dark .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}
</style>
@endpush
@endsection
