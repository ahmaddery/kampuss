@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Manajemen Biro</h3>
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
                    <a href="#">Biro</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Daftar Biro</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Daftar Biro</h4>
                            <a href="{{ route('admin.biro.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Tambah Biro
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Logo</th>
                                        <th>Nama Biro</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($biros as $index => $biro)
                                        <tr>
                                            <td>{{ $biros->firstItem() + $index }}</td>
                                            <td>
                                                @if($biro->logo)
                                                    <img src="{{ asset('storage/' . $biro->logo) }}" 
                                                         alt="{{ $biro->nama_biro }}" 
                                                         class="rounded" 
                                                         width="50" height="50"
                                                         style="object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-building text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $biro->nama_biro }}</strong>
                                                @if($biro->deskripsi)
                                                    <br><small class="text-muted">{{ Str::limit($biro->deskripsi, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <code>{{ $biro->slug }}</code>
                                            </td>
                                            <td>
                                                @if($biro->status == 'aktif')
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-danger">Non-aktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $biro->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('admin.biro.show', $biro) }}" 
                                                       class="btn btn-link btn-info btn-lg" 
                                                       data-bs-toggle="tooltip" 
                                                       title="Lihat Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.biro.edit', $biro) }}" 
                                                       class="btn btn-link btn-primary btn-lg" 
                                                       data-bs-toggle="tooltip" 
                                                       title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-link btn-danger btn-lg" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Hapus"
                                                            onclick="confirmDelete({{ $biro->id }}, '{{ $biro->nama_biro }}')">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $biro->id }}" 
                                                          action="{{ route('admin.biro.destroy', $biro) }}" 
                                                          method="POST" 
                                                          style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div class="py-4">
                                                    <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">Belum ada data biro</h5>
                                                    <p class="text-muted">Klik tombol "Tambah Biro" untuk menambah data.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($biros->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $biros->links() }}
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
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus biro "${name}"`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Initialize DataTables
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
