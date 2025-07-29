@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-envelope me-2"></i> Manajemen Newsletter</h3>
            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Langganan
            </button>
        </div>

        <!-- Main Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <!-- Filter Form -->
                <form action="{{ route('admin.newsletter.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1">Tipe Langganan</label>
                        <select name="type" class="form-select form-select-sm shadow-sm">
                            <option value="">📁 Semua Tipe</option>
                            <option value="berita" {{ request('type') == 'berita' ? 'selected' : '' }}>📰 Berita</option>
                            <option value="pengumuman" {{ request('type') == 'pengumuman' ? 'selected' : '' }}>📢 Pengumuman</option>
                            <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>📦 Semua Konten</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1">Status</label>
                        <select name="status" class="form-select form-select-sm shadow-sm">
                            <option value="">📊 Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>✅ Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>❌ Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small text-muted mb-1">Cari Email</label>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control shadow-sm" placeholder="🔍 Cari email..." value="{{ request('search') }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    @if(request('type') || request('status') || request('search'))
                        <div class="col-md-2">
                            <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary btn-sm w-100 shadow-sm">
                                <i class="fas fa-times-circle me-1"></i> Reset
                            </a>
                        </div>
                    @endif
                </form>

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
                                <th scope="col">Email</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Status</th>
                                <th scope="col">Terakhir Dikirim</th>
                                <th scope="col">Dibuat</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $index => $subscription)
                                <tr class="align-middle">
                                    <td class="ps-4">{{ $subscriptions->firstItem() + $index }}</td>
                                    <td>{{ $subscription->email }}</td>
                                    <td>
                                        <span class="badge bg-info text-white fw-normal px-2 py-1">
                                            {{ ucfirst($subscription->type ?? 'Semua') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $subscription->is_active ? 'bg-success text-white' : 'bg-danger text-white' }} fw-normal px-2 py-1">
                                            {{ $subscription->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>{{ $subscription->last_sent_at ? $subscription->last_sent_at->format('d M Y H:i') : '—' }}</td>
                                    <td>{{ $subscription->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $subscription->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.newsletter.toggle-active', $subscription->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn {{ $subscription->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $subscription->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    <i class="fas {{ $subscription->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.newsletter.destroy', $subscription->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada data langganan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $subscriptions->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.newsletter.store') }}" method="POST" class="modal-content border-0 shadow-lg">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createModalLabel"><i class="fas fa-envelope me-2"></i> Tambah Langganan Newsletter</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label for="create_email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="create_email" name="email" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="create_type" class="form-label fw-medium">Tipe Langganan <span class="text-danger">*</span></label>
                    <select name="type" id="create_type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="all">Semua Konten</option>
                        <option value="berita">Berita Saja</option>
                        <option value="pengumuman">Pengumuman Saja</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="create_is_active" name="is_active" value="1" checked>
                    <label class="form-check-label" for="create_is_active">Aktif</label>
                </div>
                <small class="text-muted d-block">Pelanggan aktif akan menerima email secara berkala.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
@foreach($subscriptions as $subscription)
<div class="modal fade" id="editModal{{ $subscription->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $subscription->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.newsletter.update', $subscription->id) }}" method="POST" class="modal-content border-0 shadow-lg">
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editModalLabel{{ $subscription->id }}"><i class="fas fa-edit me-2"></i> Edit Langganan Newsletter</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="email{{ $subscription->id }}" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email{{ $subscription->id }}" name="email" value="{{ old('email', $subscription->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="type{{ $subscription->id }}" class="form-label fw-medium">Tipe Langganan <span class="text-danger">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type{{ $subscription->id }}" name="type" required>
                        <option value="all" {{ old('type', $subscription->type) == 'all' ? 'selected' : '' }}>Semua Konten</option>
                        <option value="berita" {{ old('type', $subscription->type) == 'berita' ? 'selected' : '' }}>Berita Saja</option>
                        <option value="pengumuman" {{ old('type', $subscription->type) == 'pengumuman' ? 'selected' : '' }}>Pengumuman Saja</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="is_active{{ $subscription->id }}" name="is_active" value="1" {{ old('is_active', $subscription->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active{{ $subscription->id }}">Aktif</label>
                </div>
                <small class="text-muted d-block">Jika diaktifkan, pelanggan akan menerima email newsletter.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection

@section('styles')
<style>
    .table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .table tr {
        transition: background-color 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    .btn-group .btn {
        margin-right: 2px;
        transition: all 0.2s ease;
    }
    .btn-group .btn:hover {
        transform: translateY(-1px);
    }
    .badge {
        font-size: 0.85rem;
        border-radius: 0.5rem;
    }
    .modal-content {
        border-radius: 0.75rem;
    }
    .form-control, .form-select {
        border-radius: 0.5rem;
        transition: border-color 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .input-group .btn {
        border-radius: 0.5rem;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto-submit filter form on select change
        $('select[name="type"], select[name="status"]').on('change', function() {
            $(this).closest('form').submit();
        });

        // Add animation to buttons
        $('.btn-group .btn').on('click', function() {
            $(this).addClass('animate__animated animate__pulse');
            setTimeout(() => $(this).removeClass('animate__animated animate__pulse'), 500);
        });
    });
</script>
@endsection