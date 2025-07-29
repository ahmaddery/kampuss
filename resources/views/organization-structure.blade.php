@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Struktur Organisasi</h1>
                <p class="lead mb-0">Mengenal struktur kepemimpinan dan organisasi universitas</p>
            </div>
            <div class="col-lg-4 text-end">
                <i class="fas fa-sitemap fa-5x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Navigation Tabs -->
    <div class="row mb-5">
        <div class="col-12">
            <ul class="nav nav-pills nav-justified bg-light p-3 rounded-3" id="organizationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="hierarchy-tab" data-bs-toggle="pill" 
                            data-bs-target="#hierarchy" type="button" role="tab">
                        <i class="fas fa-sitemap me-2"></i> Hierarki
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tree-tab" data-bs-toggle="pill" 
                            data-bs-target="#tree" type="button" role="tab">
                        <i class="fas fa-project-diagram me-2"></i> Bagan Organisasi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="leadership-tab" data-bs-toggle="pill" 
                            data-bs-target="#leadership" type="button" role="tab">
                        <i class="fas fa-users me-2"></i> Kepemimpinan
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="organizationTabsContent">
        <!-- Hierarchy View -->
        <div class="tab-pane fade show active" id="hierarchy" role="tabpanel">
            @if($structures->count() > 0)
                <div class="row">
                    @foreach($structures as $structure)
                        <div class="col-12 mb-4">
                            @include('partials.organization-card', ['structure' => $structure])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-sitemap fa-5x text-muted mb-4"></i>
                    <h3 class="text-muted">Struktur Organisasi Belum Tersedia</h3>
                    <p class="text-muted">Informasi struktur organisasi sedang dalam proses pembaruan.</p>
                </div>
            @endif
        </div>

        <!-- Tree View -->
        <div class="tab-pane fade" id="tree" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="organizationTree" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Memuat bagan organisasi...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leadership View -->
        <div class="tab-pane fade" id="leadership" role="tabpanel">
            <div class="row">
                @foreach($structures as $structure)
                    @if($structure->position_title && $structure->person_name)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-3">
                                <div class="card-body text-center p-4">
                                    @if($structure->image_path)
                                        <img src="{{ asset('storage/' . $structure->image_path) }}" 
                                             alt="{{ $structure->unit_name }}" 
                                             class="img-fluid rounded-circle mb-3" 
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                             style="width: 100px; height: 100px;">
                                            <i class="fas fa-user fa-2x text-white"></i>
                                        </div>
                                    @endif
                                    <h5 class="card-title fw-bold">{{ $structure->person_name }}</h5>
                                    <p class="text-primary fw-semibold mb-2">{{ $structure->position_title }}</p>
                                    <p class="text-muted small mb-0">{{ $structure->unit_name }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    {{-- Include children with positions --}}
                    @foreach($structure->children as $child)
                        @if($child->position_title && $child->person_name)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 shadow-sm border-0 rounded-3">
                                    <div class="card-body text-center p-4">
                                        @if($child->image_path)
                                            <img src="{{ asset('storage/' . $child->image_path) }}" 
                                                 alt="{{ $child->unit_name }}" 
                                                 class="img-fluid rounded-circle mb-3" 
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                                 style="width: 100px; height: 100px;">
                                                <i class="fas fa-user fa-2x text-white"></i>
                                            </div>
                                        @endif
                                        <h5 class="card-title fw-bold">{{ $child->person_name }}</h5>
                                        <p class="text-primary fw-semibold mb-2">{{ $child->position_title }}</p>
                                        <p class="text-muted small mb-0">{{ $child->unit_name }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.organization-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.organization-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.nav-pills .nav-link {
    border-radius: 10px;
    font-weight: 600;
    margin: 0 5px;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

#organizationTree {
    min-height: 400px;
    overflow: auto;
}

.tree-node {
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 10px;
    padding: 15px;
    margin: 10px;
    position: relative;
    transition: all 0.3s ease;
}

.tree-node:hover {
    border-color: #007bff;
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

.tree-node.has-position {
    background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
    border-color: #007bff;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Load organization tree when tab is clicked
    $('#tree-tab').on('click', function() {
        loadOrganizationTree();
    });

    function loadOrganizationTree() {
        $.ajax({
            url: '{{ route("organization-structure.tree") }}',
            method: 'GET',
            success: function(data) {
                renderTree(data);
            },
            error: function() {
                $('#organizationTree').html(`
                    <div class="text-center py-5">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h5 class="text-muted">Gagal memuat bagan organisasi</h5>
                        <button class="btn btn-primary btn-sm" onclick="loadOrganizationTree()">
                            <i class="fas fa-refresh me-1"></i> Coba Lagi
                        </button>
                    </div>
                `);
            }
        });
    }

    function renderTree(nodes) {
        let html = '<div class="d-flex flex-column align-items-center">';
        
        nodes.forEach(function(node, index) {
            html += renderNode(node, 0);
        });
        
        html += '</div>';
        $('#organizationTree').html(html);
    }

    function renderNode(node, level) {
        let hasPosition = node.position_title && node.person_name;
        let nodeClass = hasPosition ? 'tree-node has-position' : 'tree-node';
        
        let html = `<div class="${nodeClass}" data-level="${level}">`;
        
        if (node.image_path) {
            html += `<img src="{{ asset('storage/') }}/${node.image_path}" alt="${node.text}" 
                          style="width: 50px; height: 50px; object-fit: cover;" class="rounded mb-2">`;
        }
        
        html += `<div class="fw-bold">${node.text}</div>`;
        
        if (hasPosition) {
            html += `<div class="text-primary small fw-semibold">${node.position_title}</div>`;
            html += `<div class="text-muted small">${node.person_name}</div>`;
        }
        
        html += '</div>';
        
        if (node.children && node.children.length > 0) {
            html += '<div class="d-flex justify-content-center flex-wrap">';
            node.children.forEach(function(child) {
                html += renderNode(child, level + 1);
            });
            html += '</div>';
        }
        
        return html;
    }
});
</script>
@endpush
@endsection
