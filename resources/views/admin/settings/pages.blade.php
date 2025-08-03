@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Status Halaman Website</h1>
            <p class="text-muted">Kelola status aktif/nonaktif halaman website</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Pengaturan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Status Halaman</li>
            </ol>
        </nav>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Halaman Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $settings->where('is_active', true)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Halaman Nonaktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $settings->where('is_active', false)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Halaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $settings->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Persentase Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $settings->count() > 0 ? round(($settings->where('is_active', true)->count() / $settings->count()) * 100) : 0 }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percentage fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt"></i> Aksi Massal
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.settings.bulk-activate') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin mengaktifkan SEMUA halaman?')">
                                    <i class="fas fa-check-circle"></i> Aktifkan Semua Halaman
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.settings.bulk-deactivate') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('PERINGATAN: Tindakan ini akan menonaktifkan SEMUA halaman! Apakah Anda yakin?')">
                                    <i class="fas fa-times-circle"></i> Nonaktifkan Semua Halaman
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-toggle-on"></i> Daftar Halaman Website
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="pageStatusTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 25%">Nama Halaman</th>
                                    <th style="width: 35%">Deskripsi</th>
                                    <th style="width: 15%">Status</th>
                                    <th style="width: 15%">URL</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $index => $setting)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                @if($setting->page_name == 'sambutan-rektor')
                                                    <i class="fas fa-user-tie text-primary"></i>
                                                @elseif($setting->page_name == 'sejarah')
                                                    <i class="fas fa-history text-warning"></i>
                                                @elseif($setting->page_name == 'visi-misi')
                                                    <i class="fas fa-eye text-info"></i>
                                                @elseif($setting->page_name == 'struktur-organisasi')
                                                    <i class="fas fa-sitemap text-secondary"></i>
                                                @elseif($setting->page_name == 'berita')
                                                    <i class="fas fa-newspaper text-success"></i>
                                                @elseif($setting->page_name == 'pengumuman')
                                                    <i class="fas fa-bullhorn text-danger"></i>
                                                @elseif($setting->page_name == 'jurusan')
                                                    <i class="fas fa-graduation-cap text-purple"></i>
                                                @else
                                                    <i class="fas fa-file-alt text-muted"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <strong>{{ $setting->page_title }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $setting->page_name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $setting->description }}</td>
                                    <td>
                                        @if($setting->is_active)
                                            <span class="badge badge-success badge-pill">
                                                <i class="fas fa-check-circle"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-danger badge-pill">
                                                <i class="fas fa-times-circle"></i> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/' . $setting->page_name) }}" target="_blank" class="text-primary text-decoration-none">
                                            <i class="fas fa-external-link-alt"></i> Lihat Halaman
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.settings.toggle-page-status', $setting->page_name) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-sm {{ $setting->is_active ? 'btn-danger' : 'btn-success' }}"
                                                    onclick="return confirm('Apakah Anda yakin ingin {{ $setting->is_active ? 'menonaktifkan' : 'mengaktifkan' }} halaman {{ $setting->page_title }}?')"
                                                    data-toggle="tooltip" 
                                                    title="{{ $setting->is_active ? 'Klik untuk menonaktifkan' : 'Klik untuk mengaktifkan' }}">
                                                <i class="fas fa-{{ $setting->is_active ? 'eye-slash' : 'eye' }}"></i>
                                                {{ $setting->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Informasi Penting</div>
                            <div class="text-sm">
                                <strong>Catatan:</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Halaman Nonaktif:</strong> Pengunjung akan diarahkan ke halaman utama dengan pesan maintenance</li>
                                    <li><strong>Admin Access:</strong> Admin tetap dapat mengakses halaman admin meskipun halaman publik dinonaktifkan</li>
                                    <li><strong>Real-time Effect:</strong> Perubahan status berlaku secara langsung tanpa delay</li>
                                    <li><strong>SEO Impact:</strong> Halaman nonaktif tidak akan diindeks oleh search engine</li>
                                    <li><strong>User Experience:</strong> Gunakan fitur ini dengan bijak untuk menjaga experience pengunjung</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-info-circle fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto hide alerts after 5 seconds
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);

// Initialize tooltips
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

// DataTable for better table functionality
$(document).ready(function() {
    $('#pageStatusTable').DataTable({
        "pageLength": 10,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ halaman",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 halaman",
            "infoFiltered": "(disaring dari _MAX_ total halaman)",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "emptyTable": "Tidak ada data yang tersedia di tabel"
        }
    });
});

// Refresh page status every 30 seconds
setInterval(function() {
    // You can implement auto-refresh here if needed
    // location.reload();
}, 30000);
</script>
@endpush
@endsection
