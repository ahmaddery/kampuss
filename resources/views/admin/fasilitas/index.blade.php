@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Kelola Fasilitas</h4>
                    <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Fasilitas
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($fasilitas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Fasilitas</th>
                                        <th>Jurusan</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fasilitas as $item)
                                        <tr>
                                            <td>
                                                @if($item->gambar_utama_url)
                                                    <img src="{{ $item->gambar_utama_url }}" 
                                                         alt="{{ $item->nama_fasilitas }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->nama_fasilitas }}</strong>
                                                @if($item->deskripsi)
                                                    <br><small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->jurusan)
                                                    <span class="badge bg-info">{{ $item->jurusan->jurusan }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Umum</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->lokasi ?? '-' }}</td>
                                            <td>
                                                <button class="btn btn-sm toggle-status {{ $item->status === 'aktif' ? 'btn-success' : 'btn-secondary' }}" 
                                                        data-id="{{ $item->id }}" 
                                                        data-status="{{ $item->status }}">
                                                    {{ ucfirst($item->status) }}
                                                </button>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.fasilitas.show', $item) }}" 
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.fasilitas.edit', $item) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.fasilitas.destroy', $item) }}" 
                                                          method="POST" 
                                                          class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm" 
                                                                onclick="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $fasilitas->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada fasilitas</h5>
                            <p class="text-muted">Klik tombol "Tambah Fasilitas" untuk menambahkan fasilitas pertama.</p>
                            <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Fasilitas
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
    $('.toggle-status').click(function() {
        const button = $(this);
        const id = button.data('id');
        const currentStatus = button.data('status');
        
        $.ajax({
            url: `/admin/fasilitas/${id}/toggle-status`,
            type: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    button.data('status', response.status);
                    button.text(response.status.charAt(0).toUpperCase() + response.status.slice(1));
                    
                    if (response.status === 'aktif') {
                        button.removeClass('btn-secondary').addClass('btn-success');
                    } else {
                        button.removeClass('btn-success').addClass('btn-secondary');
                    }
                    
                    // Show toast or notification
                    if (typeof toastr !== 'undefined') {
                        toastr.success(response.message);
                    } else {
                        alert(response.message);
                    }
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengubah status.');
            }
        });
    });
});
</script>
@endpush
@endsection
