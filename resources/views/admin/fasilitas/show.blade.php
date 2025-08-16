@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Fasilitas</h4>
                    <div>
                        <a href="{{ route('admin.fasilitas.edit', $fasilitas) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="fw-bold" style="width: 200px;">Nama Fasilitas</td>
                                    <td>{{ $fasilitas->nama_fasilitas }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Slug</td>
                                    <td>
                                        <code>{{ $fasilitas->slug }}</code>
                                        <a href="{{ route('fasilitas.show', $fasilitas->slug) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-primary ms-2">
                                            <i class="fas fa-external-link-alt"></i> Lihat di Website
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Jurusan</td>
                                    <td>
                                        @if($fasilitas->jurusan)
                                            <span class="badge bg-info">{{ $fasilitas->jurusan->jurusan }}</span>
                                        @else
                                            <span class="badge bg-secondary">Umum (Semua Jurusan)</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Lokasi</td>
                                    <td>{{ $fasilitas->lokasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Jam Operasional</td>
                                    <td>{{ $fasilitas->jam_operasional ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kontak</td>
                                    <td>{{ $fasilitas->kontak ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Status</td>
                                    <td>
                                        <span class="badge {{ $fasilitas->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($fasilitas->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Dibuat</td>
                                    <td>{{ $fasilitas->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Diperbarui</td>
                                    <td>{{ $fasilitas->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <h5>Deskripsi Singkat</h5>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        {!! $fasilitas->deskripsi ? nl2br(e($fasilitas->deskripsi)) : '<em class="text-muted">Tidak ada deskripsi singkat</em>' !!}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5>Deskripsi Lengkap</h5>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        {!! $fasilitas->deskripsi_lengkap ? nl2br(e($fasilitas->deskripsi_lengkap)) : '<em class="text-muted">Tidak ada deskripsi lengkap</em>' !!}
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Information -->
                            <div class="mt-4">
                                <h5>Informasi SEO</h5>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>SEO Title:</strong><br>
                                                <span class="text-muted">{{ $fasilitas->seo_title ?? 'Tidak diatur' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>SEO Description:</strong><br>
                                                <span class="text-muted">{{ $fasilitas->seo_description ? Str::limit($fasilitas->seo_description, 100) : 'Tidak diatur' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5>Gambar Fasilitas</h5>
                            @if($fasilitas->gambar && count($fasilitas->gambar) > 0)
                                <div class="row">
                                    @foreach($fasilitas->gambar as $index => $gambar)
                                        <div class="col-12 mb-3">
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $gambar) }}" 
                                                     class="card-img-top" 
                                                     style="height: 200px; object-fit: cover;" 
                                                     alt="Gambar {{ $index + 1 }}">
                                                <div class="card-body p-2">
                                                    <small class="text-muted">Gambar {{ $index + 1 }}</small>
                                                    <br>
                                                    <button class="btn btn-sm btn-outline-primary" 
                                                            onclick="showImageModal('{{ asset('storage/' . $gambar) }}', '{{ $fasilitas->nama_fasilitas }} - Gambar {{ $index + 1 }}')">
                                                        <i class="fas fa-search-plus"></i> Perbesar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada gambar</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk memperbesar gambar -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showImageModal(imageSrc, title) {
    $('#modalImage').attr('src', imageSrc);
    $('#imageModalLabel').text(title);
    $('#imageModal').modal('show');
}
</script>
@endpush
@endsection
