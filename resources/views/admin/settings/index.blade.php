@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan</h1>
        <p class="text-muted">Kelola pengaturan sistem dan konfigurasi website</p>
    </div>

    <!-- Settings Overview Cards -->
    <div class="row">
        <!-- Status Halaman -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">
                                <i class="fas fa-toggle-on text-primary"></i> Status Halaman
                            </h5>
                            <p class="card-text text-muted">Kelola status aktif/nonaktif halaman website</p>
                            <a href="{{ route('admin.settings.pages') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-cog"></i> Kelola Status
                            </a>
                        </div>
                        <div class="text-right">
                            <i class="fas fa-file-alt fa-2x text-primary opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengaturan Umum -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow mb-4 border-left-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">
                                <i class="fas fa-cogs text-success"></i> Pengaturan Umum
                            </h5>
                            <p class="card-text text-muted">Konfigurasi informasi website dan sistem</p>
                            <a href="{{ route('admin.settings.general') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-edit"></i> Konfigurasi
                            </a>
                        </div>
                        <div class="text-right">
                            <i class="fas fa-cog fa-2x text-success opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengaturan PMB -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">
                                <i class="fas fa-graduation-cap text-warning"></i> Pengaturan PMB
                            </h5>
                            <p class="card-text text-muted">Kelola pengaturan Penerimaan Mahasiswa Baru</p>
                            <a href="{{ route('admin.settings.pmb') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-users"></i> Kelola PMB
                            </a>
                        </div>
                        <div class="text-right">
                            <i class="fas fa-user-graduate fa-2x text-warning opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Settings -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-wrench"></i> Pengaturan Lainnya
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Email Settings -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-primary">
                                    <i class="fas fa-envelope"></i> Pengaturan Email
                                </h6>
                                <p class="text-muted mb-2">Konfigurasi SMTP dan template email</p>
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-clock"></i> Segera Hadir
                                </button>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-primary">
                                    <i class="fas fa-shield-alt"></i> Pengaturan Keamanan
                                </h6>
                                <p class="text-muted mb-2">Kelola password policy dan akses</p>
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-clock"></i> Segera Hadir
                                </button>
                            </div>
                        </div>

                        <!-- Backup Settings -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-primary">
                                    <i class="fas fa-database"></i> Backup & Restore
                                </h6>
                                <p class="text-muted mb-2">Kelola backup database dan file</p>
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-clock"></i> Segera Hadir
                                </button>
                            </div>
                        </div>

                        <!-- Performance Settings -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-primary">
                                    <i class="fas fa-tachometer-alt"></i> Optimasi Performa
                                </h6>
                                <p class="text-muted mb-2">Cache, CDN, dan optimasi website</p>
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-clock"></i> Segera Hadir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Info -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Panduan Pengaturan
                            </div>
                            <div class="text-sm">
                                <strong>Tips untuk Admin:</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Status Halaman:</strong> Gunakan untuk maintenance halaman tertentu tanpa mengganggu seluruh website</li>
                                    <li><strong>Pengaturan Umum:</strong> Update informasi kontak, media sosial, dan konfigurasi sistem</li>
                                    <li><strong>PMB:</strong> Kelola pengaturan khusus untuk periode penerimaan mahasiswa baru</li>
                                    <li><strong>Backup:</strong> Selalu lakukan backup sebelum mengubah pengaturan penting</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lightbulb fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.opacity-25 {
    opacity: 0.25;
}
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
</style>
@endpush
@endsection
