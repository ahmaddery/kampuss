@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <div class="text-muted">
            <i class="fas fa-calendar-alt"></i> {{ now()->format('d F Y, H:i') }} WIB
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-1 font-weight-bold text-primary">
                                Selamat datang kembali, {{ $user->name }}!
                            </div>
                            <div class="text-gray-600">
                                @if($user->last_login_at)
                                    Login terakhir: {{ $user->last_login_at->format('d F Y, H:i') }} WIB
                                    @if($user->last_login_ip)
                                        dari IP: {{ $user->last_login_ip }}
                                    @endif
                                @else
                                    Ini adalah login pertama Anda
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Umum -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengguna
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_users']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Berita
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_berita']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
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
                                Total Pengumuman
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_pengumuman']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
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
                                Pesan Belum Dibaca
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['unread_messages']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Aktivitas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Aktivitas Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($activityStats['today']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Aktivitas Minggu Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($activityStats['this_week']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
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
                                Aktivitas Bulan Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($activityStats['this_month']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Total Aktivitas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($activityStats['total']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart dan Info -->
    <div class="row mb-4">
        <!-- Aktivitas Terbaru -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                    <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    @forelse($recentActivities as $activity)
                    <div class="d-flex align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="avatar avatar-sm me-3">
                            <div class="avatar-initial rounded-circle bg-label-{{ $activity->status == 'success' ? 'success' : ($activity->status == 'failed' ? 'danger' : 'warning') }}">
                                <i class="{{ $activity->icon }} text-sm"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="text-sm font-weight-semibold">{{ $activity->description }}</div>
                            <div class="text-xs text-muted">
                                @if($activity->user)
                                    {{ $activity->user->name }} • 
                                @endif
                                {{ $activity->time_ago }}
                                @if($activity->ip_address)
                                    • {{ $activity->ip_address }}
                                @endif
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge {{ $activity->status_color }}">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                        <p class="text-muted">Belum ada aktivitas</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Top Kategori Aktivitas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Kategori Aktivitas</h6>
                </div>
                <div class="card-body">
                    @forelse($topCategories as $category)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-sm font-weight-bold">{{ ucfirst($category->log_name) }}</span>
                            <span class="text-sm">{{ number_format($category->count) }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ ($category->count / $topCategories->max('count')) * 100 }}%"
                                 aria-valuenow="{{ $category->count }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="{{ $topCategories->max('count') }}">
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-chart-bar fa-3x text-gray-300 mb-3"></i>
                        <p class="text-muted">Belum ada data</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Pengguna Paling Aktif -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengguna Paling Aktif Hari Ini</h6>
                </div>
                <div class="card-body">
                    @forelse($activeUsers as $activeUser)
                    <div class="d-flex align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="avatar avatar-sm me-3">
                            <div class="avatar-initial rounded-circle bg-label-primary">
                                {{ $activeUser->user ? substr($activeUser->user->name, 0, 1) : 'S' }}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="text-sm font-weight-semibold">
                                {{ $activeUser->user ? $activeUser->user->name : 'System' }}
                            </div>
                            <div class="text-xs text-muted">
                                {{ $activeUser->activity_count }} aktivitas
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge bg-info">{{ $activeUser->activity_count }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                        <p class="text-muted">Belum ada aktivitas hari ini</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Berita
                        </a>
                        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Tambah Pengumuman
                        </a>
                        <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Lihat Log Aktivitas
                        </a>
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-envelope"></i> Pesan Kontak
                            @if($stats['unread_messages'] > 0)
                                <span class="badge badge-light ml-2">{{ $stats['unread_messages'] }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="row">
        <div class="col-12">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Sistem Informasi Kampus
                            </div>
                            <div class="text-sm text-gray-600">
                                Dashboard ini menampilkan ringkasan aktivitas dan statistik sistem. 
                                Semua aktivitas pengguna akan tercatat secara otomatis untuk keperluan audit dan monitoring.
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto refresh dashboard setiap 5 menit
setInterval(function() {
    // Only refresh if user is still active (optional)
    if (document.hasFocus()) {
        location.reload();
    }
}, 300000); // 5 minutes

// Add notification for new activities (optional)
document.addEventListener('DOMContentLoaded', function() {
    // You can add real-time notifications here using websockets or polling
    console.log('Dashboard loaded');
});
</script>
@endpush
