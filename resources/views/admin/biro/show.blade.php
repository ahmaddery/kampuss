@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Biro</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('home') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.biro.index') }}">Biro</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ $biro->nama_biro }}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $biro->nama_biro }}</h4>
                            <div class="ms-auto">
                                <a href="{{ route('admin.biro.edit', $biro) }}" class="btn btn-primary btn-sm me-2">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('admin.biro.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Basic Information -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Informasi Dasar</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="200"><strong>Nama Biro:</strong></td>
                                                <td>{{ $biro->nama_biro }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Slug:</strong></td>
                                                <td><code>{{ $biro->slug }}</code></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong></td>
                                                <td>
                                                    @if($biro->status == 'aktif')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Non-aktif</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Dibuat:</strong></td>
                                                <td>{{ $biro->created_at->format('d F Y, H:i') }} WIB</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Diperbarui:</strong></td>
                                                <td>{{ $biro->updated_at->format('d F Y, H:i') }} WIB</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Description -->
                                @if($biro->deskripsi)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Deskripsi Singkat</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $biro->deskripsi }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($biro->deskripsi_lengkap)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Deskripsi Lengkap</h5>
                                    </div>
                                    <div class="card-body">
                                        <div style="white-space: pre-wrap;">{{ $biro->deskripsi_lengkap }}</div>
                                    </div>
                                </div>
                                @endif

                                <!-- SEO Information -->
                                @if($biro->seo_title || $biro->seo_description)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Informasi SEO</h5>
                                    </div>
                                    <div class="card-body">
                                        @if($biro->seo_title)
                                            <div class="mb-3">
                                                <strong>SEO Title:</strong><br>
                                                {{ $biro->seo_title }}
                                            </div>
                                        @endif
                                        @if($biro->seo_description)
                                            <div>
                                                <strong>SEO Description:</strong><br>
                                                {{ $biro->seo_description }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <!-- Logo -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Logo Biro</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($biro->logo)
                                            <img src="{{ asset('storage/' . $biro->logo) }}" 
                                                 alt="{{ $biro->nama_biro }}" 
                                                 class="img-fluid rounded"
                                                 style="max-width: 200px;">
                                        @else
                                            <div class="text-muted py-5">
                                                <i class="fas fa-building fa-3x mb-3"></i>
                                                <p>Tidak ada logo</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Preview Link -->
                                @if($biro->status == 'aktif')
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Aksi</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('biro.show', $biro->slug) }}" 
                                           target="_blank" 
                                           class="btn btn-info btn-sm btn-block">
                                            <i class="fa fa-eye"></i> Lihat di Website
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Gallery -->
                        @if($biro->gambar && count($biro->gambar) > 0)
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Galeri Dokumentasi</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($biro->gambar as $index => $gambar)
                                        <div class="col-md-3 col-6 mb-3">
                                            <a href="{{ asset('storage/' . $gambar) }}" 
                                               data-lightbox="biro-gallery" 
                                               data-title="Dokumentasi {{ $biro->nama_biro }} - {{ $index + 1 }}">
                                                <img src="{{ asset('storage/' . $gambar) }}" 
                                                     alt="Dokumentasi {{ $index + 1 }}" 
                                                     class="img-fluid rounded shadow-sm"
                                                     style="width: 100%; height: 150px; object-fit: cover; cursor: pointer;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Lightbox for gallery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endpush
