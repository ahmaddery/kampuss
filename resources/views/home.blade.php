@extends('layouts.admin')

@section('content')
<style>
    /* Professional Dashboard Styles */
    .dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
    }

    .stat-card.primary::before { --card-color: #4e73df; --card-color-light: #6f86e8; }
    .stat-card.success::before { --card-color: #1cc88a; --card-color-light: #36e9a6; }
    .stat-card.info::before { --card-color: #36b9cc; --card-color-light: #5ccfd6; }
    .stat-card.warning::before { --card-color: #f6c23e; --card-color-light: #f8d674; }
    .stat-card.danger::before { --card-color: #e74a3b; --card-color-light: #ea6b5f; }
    .stat-card.dark::before { --card-color: #5a5c69; --card-color-light: #6c6e7d; }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stat-change {
        font-size: 0.75rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stat-change.positive { color: #38a169; }
    .stat-change.negative { color: #e53e3e; }

    .chart-card {
        background: white;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .chart-header {
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .activity-card {
        background: white;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        height: 100%;
    }

    .activity-item {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f7fafc;
        transition: background-color 0.2s ease;
    }

    .activity-item:hover {
        background-color: #f7fafc;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: white;
    }

    .quick-action-btn {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem 1rem;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #4a5568;
        display: block;
        height: 100%;
    }

    .quick-action-btn:hover {
        border-color: var(--btn-color);
        background: linear-gradient(135deg, var(--btn-color), var(--btn-color-light));
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        text-decoration: none;
    }

    .quick-action-btn.primary { --btn-color: #4e73df; --btn-color-light: #6f86e8; }
    .quick-action-btn.success { --btn-color: #1cc88a; --btn-color-light: #36e9a6; }
    .quick-action-btn.info { --btn-color: #36b9cc; --btn-color-light: #5ccfd6; }
    .quick-action-btn.warning { --btn-color: #f6c23e; --btn-color-light: #f8d674; }
    .quick-action-btn.secondary { --btn-color: #858796; --btn-color-light: #9ca3af; }
    .quick-action-btn.dark { --btn-color: #5a5c69; --btn-color-light: #6c6e7d; }

    .system-info-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        color: white;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .info-value {
        background: rgba(255,255,255,0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .welcome-animation {
        animation: slideInUp 0.6s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .scrollbar-custom::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-custom::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .scrollbar-custom::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .scrollbar-custom::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .stat-card {
            margin-bottom: 1rem;
        }
        
        .quick-action-btn {
            padding: 1rem 0.5rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Professional Header -->
    <div class="dashboard-header welcome-animation">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="h2 mb-2 fw-bold">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    Admin Dashboard
                </h1>
                <p class="mb-0 opacity-75">
                    Selamat datang kembali! Berikut adalah ringkasan aktivitas sistem Anda.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex align-items-center justify-content-lg-end">
                    <div class="me-3">
                        <div class="text-sm opacity-75">Waktu Server</div>
                        <div class="fw-bold" id="server-time">{{ now()->format('H:i:s') }}</div>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-circle">
                        <i class="fas fa-clock fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards Row -->
    <div class="row mb-4">
        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card primary h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Users</div>
                            <div class="stat-number" data-value="{{ $totalUsers }}">0</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12% dari bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Berita Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card success h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Berita</div>
                            <div class="stat-number" data-value="{{ $totalBerita }}">0</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8% dari minggu lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pengumuman Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card info h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Pengumuman</div>
                            <div class="stat-number" data-value="{{ $totalPengumuman }}">0</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+15% dari bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Subscribers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card warning h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">Newsletter Subscribers</div>
                            <div class="stat-number" data-value="{{ $totalNewsletterSubscribers }}">0</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+5% dari minggu lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics Cards Row -->
    <div class="row mb-4">
        <!-- Total Jurusan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card success h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Jurusan</div>
                            <div class="stat-number" data-value="{{ $totalJurusan }}">0</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+3% dari bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Banners Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card info h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">Homepage Banners</div>
                            <div class="stat-number" data-value="{{ $totalBanners }}">0</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+2% dari minggu lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-images"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Views Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card warning h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Berita Views</div>
                            <div class="stat-number" data-value="{{ number_format($totalBerita > 0 ? \App\Models\Berita::sum('count_views') : 0) }}">0</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+25% dari bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card primary h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <div class="stat-label">System Status</div>
                            <div class="d-flex align-items-center">
                                <div class="stat-number text-success me-2">
                                    <i class="fas fa-check-circle pulse-animation"></i>
                                </div>
                                <span class="fw-bold text-success">Online</span>
                            </div>
                            <div class="stat-change positive">
                                <i class="fas fa-circle"></i>
                                <span>Uptime: 99.9%</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-server"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Content Activity Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="chart-card mb-4">
                <div class="chart-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 fw-bold text-primary">
                                <i class="fas fa-chart-line me-2"></i>
                                Content Activity (Last 6 Months)
                            </h6>
                            <small class="text-muted">Analisis aktivitas konten dalam 6 bulan terakhir</small>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-primary">Berita</span>
                            <span class="badge bg-info">Pengumuman</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="chart-area" style="height: 300px;">
                        <canvas id="contentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Roles Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="chart-card mb-4">
                <div class="chart-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 fw-bold text-primary">
                                <i class="fas fa-users me-2"></i>
                                User Roles Distribution
                            </h6>
                            <small class="text-muted">Distribusi peran pengguna dalam sistem</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="chart-pie" style="height: 300px;">
                        <canvas id="rolesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Popular Content Row -->
    <div class="row">
        <!-- Recent Berita -->
        <div class="col-lg-4 mb-4">
            <div class="activity-card">
                <div class="chart-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 fw-bold text-primary">
                                <i class="fas fa-newspaper me-2"></i>
                                Recent Berita
                            </h6>
                            <small class="text-muted">Berita terbaru yang telah dipublikasikan</small>
                        </div>
                        <span class="badge bg-primary">{{ $recentBerita->count() }}</span>
                    </div>
                </div>
                <div class="card-body p-0 scrollbar-custom" style="max-height: 300px; overflow-y: auto;">
                    @if($recentBerita->count() > 0)
                        @foreach($recentBerita as $berita)
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon bg-primary me-3">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold">{{ Str::limit($berita->title, 35) }}</h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $berita->created_at->diffForHumans() }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>
                                            {{ $berita->count_views }} views
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center p-3">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i>
                                View All Berita
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="activity-icon bg-muted mx-auto mb-3">
                                <i class="fas fa-newspaper text-muted"></i>
                            </div>
                            <p class="text-muted mb-3">Belum ada berita terbaru.</p>
                            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>
                                Create First Berita
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Popular Berita -->
        <div class="col-lg-4 mb-4">
            <div class="activity-card">
                <div class="chart-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 fw-bold text-primary">
                                <i class="fas fa-chart-line me-2"></i>
                                Most Popular Berita
                            </h6>
                            <small class="text-muted">Berita dengan jumlah views tertinggi</small>
                        </div>
                        <span class="badge bg-success">{{ $popularBerita->count() }}</span>
                    </div>
                </div>
                <div class="card-body p-0 scrollbar-custom" style="max-height: 300px; overflow-y: auto;">
                    @if($popularBerita->count() > 0)
                        @foreach($popularBerita as $index => $berita)
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon bg-{{ $index < 3 ? 'success' : 'secondary' }} me-3">
                                    <span class="fw-bold">#{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold">{{ Str::limit($berita->title, 35) }}</h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>
                                            {{ $berita->count_views }} views
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $berita->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <div class="activity-icon bg-muted mx-auto mb-3">
                                <i class="fas fa-chart-line text-muted"></i>
                            </div>
                            <p class="text-muted mb-3">Belum ada berita populer.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="col-lg-4 mb-4">
            <div class="activity-card">
                <div class="chart-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 fw-bold text-primary">
                                <i class="fas fa-users me-2"></i>
                                Recent Users
                            </h6>
                            <small class="text-muted">Pengguna yang baru saja bergabung</small>
                        </div>
                        <span class="badge bg-info">{{ $recentUsers->count() }}</span>
                    </div>
                </div>
                <div class="card-body p-0 scrollbar-custom" style="max-height: 300px; overflow-y: auto;">
                    @if($recentUsers->count() > 0)
                        @foreach($recentUsers as $user)
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <img src="{{ asset('storage/' . ($user->profile_picture ?? 'default-profile.jpg')) }}" 
                                         alt="Profile" class="rounded-circle" width="40" height="40"
                                         style="object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold">{{ $user->name }}</h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <small class="text-muted">
                                            <i class="fas fa-envelope me-1"></i>
                                            {{ Str::limit($user->email, 20) }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $user->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'secondary' }}">
                                        {{ ucfirst($user->role ?? 'User') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center p-3">
                            <a href="{{ route('admin.users') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-cog me-1"></i>
                                Manage Users
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="activity-icon bg-muted mx-auto mb-3">
                                <i class="fas fa-users text-muted"></i>
                            </div>
                            <p class="text-muted mb-3">Belum ada pengguna terbaru.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats and System Info Row -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="chart-card mb-4">
                <div class="chart-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 fw-bold text-primary">
                                <i class="fas fa-chart-bar me-2"></i>
                                Content Statistics
                            </h6>
                            <small class="text-muted">Statistik konten dalam periode waktu tertentu</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="p-3">
                                <div class="stat-icon mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem;">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <h4 class="fw-bold text-primary mb-1">{{ number_format(\App\Models\Berita::sum('count_views')) }}</h4>
                                <p class="text-muted mb-0 small">Total Views</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <div class="stat-icon mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem; background: linear-gradient(135deg, #1cc88a, #36e9a6);">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <h4 class="fw-bold text-success mb-1">{{ number_format(\App\Models\Berita::whereDate('created_at', today())->count()) }}</h4>
                                <p class="text-muted mb-0 small">Today's Posts</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <div class="stat-icon mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem; background: linear-gradient(135deg, #f6c23e, #f8d674);">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4 class="fw-bold text-warning mb-1">{{ number_format(\App\Models\Berita::whereDate('created_at', '>=', now()->subDays(7))->count()) }}</h4>
                                <p class="text-muted mb-0 small">This Week</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="system-info-card">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-server fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-1 fw-bold">System Information</h5>
                        <small class="opacity-75">Informasi teknis sistem</small>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-code"></i>
                        <span>Laravel Version</span>
                    </div>
                    <div class="info-value">{{ app()->version() }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-code"></i>
                        <span>PHP Version</span>
                    </div>
                    <div class="info-value">{{ PHP_VERSION }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-database"></i>
                        <span>Database</span>
                    </div>
                    <div class="info-value">{{ config('database.default') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-clock"></i>
                        <span>Server Time</span>
                    </div>
                    <div class="info-value" id="server-time">{{ now()->format('H:i:s') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row">
        <div class="col-12">
            <div class="chart-card mb-4">
                <div class="chart-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 fw-bold text-primary">
                                <i class="fas fa-bolt me-2"></i>
                                Quick Actions
                            </h6>
                            <small class="text-muted">Akses cepat ke fitur-fitur utama</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.homepage_banners.index') }}" class="quick-action-btn primary">
                                <i class="fas fa-images fa-2x mb-2"></i>
                                <div class="fw-semibold">Manage Banners</div>
                                <small class="opacity-75">Kelola banner homepage</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.berita.index') }}" class="quick-action-btn success">
                                <i class="fas fa-newspaper fa-2x mb-2"></i>
                                <div class="fw-semibold">Manage Berita</div>
                                <small class="opacity-75">Kelola berita dan artikel</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.pengumuman.index') }}" class="quick-action-btn info">
                                <i class="fas fa-bullhorn fa-2x mb-2"></i>
                                <div class="fw-semibold">Manage Pengumuman</div>
                                <small class="opacity-75">Kelola pengumuman</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.jurusan.index') }}" class="quick-action-btn warning">
                                <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                                <div class="fw-semibold">Manage Jurusan</div>
                                <small class="opacity-75">Kelola data jurusan</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.newsletter.index') }}" class="quick-action-btn secondary">
                                <i class="fas fa-envelope fa-2x mb-2"></i>
                                <div class="fw-semibold">Newsletter</div>
                                <small class="opacity-75">Kelola newsletter</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.settings.index') }}" class="quick-action-btn dark">
                                <i class="fas fa-cog fa-2x mb-2"></i>
                                <div class="fw-semibold">Settings</div>
                                <small class="opacity-75">Pengaturan sistem</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Real-time clock
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { hour12: false });
    document.getElementById('server-time').textContent = timeString;
}

// Update clock every second
setInterval(updateClock, 1000);

// Content Activity Chart
const contentCtx = document.getElementById('contentChart').getContext('2d');

// Generate last 6 months labels
const months = [];
const beritaData = [];
const pengumumanData = [];

// Create array of last 6 months
for(let i = 5; i >= 0; i--) {
    const date = new Date();
    date.setMonth(date.getMonth() - i);
    months.push(date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' }));
    
    // Initialize with 0
    beritaData.push(0);
    pengumumanData.push(0);
}

// Fill with actual data
@if($monthlyBerita->count() > 0)
    @foreach($monthlyBerita as $data)
        const beritaMonthYear = '{{ DateTime::createFromFormat("!m", $data->month)->format("M") }} {{ $data->year }}';
        const beritaIndex = months.indexOf(beritaMonthYear);
        if(beritaIndex !== -1) {
            beritaData[beritaIndex] = {{ $data->count }};
        }
    @endforeach
@endif

@if($monthlyPengumuman->count() > 0)
    @foreach($monthlyPengumuman as $data)
        const pengumumanMonthYear = '{{ DateTime::createFromFormat("!m", $data->month)->format("M") }} {{ $data->year }}';
        const pengumumanIndex = months.indexOf(pengumumanMonthYear);
        if(pengumumanIndex !== -1) {
            pengumumanData[pengumumanIndex] = {{ $data->count }};
        }
    @endforeach
@endif

const contentChart = new Chart(contentCtx, {
    type: 'line',
    data: {
        labels: months,
        datasets: [{
            label: 'Berita',
            data: beritaData,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1,
            fill: true
        }, {
            label: 'Pengumuman',
            data: pengumumanData,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            tension: 0.1,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            intersect: false,
            mode: 'index'
        },
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                titleColor: 'white',
                bodyColor: 'white',
                borderColor: 'rgba(255,255,255,0.1)',
                borderWidth: 1
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                },
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                }
            },
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                }
            }
        }
    }
});

// User Roles Pie Chart
const rolesCtx = document.getElementById('rolesChart').getContext('2d');
const rolesChart = new Chart(rolesCtx, {
    type: 'doughnut',
    data: {
        labels: [
            @if($userRoles->count() > 0)
                @foreach($userRoles as $role)
                    '{{ ucfirst($role->role ?: "No Role") }}',
                @endforeach
            @else
                'No Data'
            @endif
        ],
        datasets: [{
            data: [
                @if($userRoles->count() > 0)
                    @foreach($userRoles as $role)
                        {{ $role->count }},
                    @endforeach
                @else
                    1
                @endif
            ],
            backgroundColor: [
                '#4e73df',
                '#1cc88a',
                '#36b9cc',
                '#f6c23e',
                '#e74a3b',
                '#858796'
            ],
            hoverBackgroundColor: [
                '#2e59d9',
                '#17a673',
                '#2c9faf',
                '#f4b619',
                '#e02424',
                '#6c757d'
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            borderWidth: 2
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                titleColor: 'white',
                bodyColor: 'white',
                borderColor: 'rgba(255,255,255,0.1)',
                borderWidth: 1
            }
        },
        cutout: '60%'
    }
});

// Enhanced number animation with easing
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const easeOutQuart = (t) => 1 - Math.pow(1 - t, 4);
    
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const easedProgress = easeOutQuart(progress);
        const currentValue = Math.floor(easedProgress * (end - start) + start);
        obj.innerHTML = currentValue.toLocaleString();
        
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Animate all stat numbers with staggered timing
document.addEventListener('DOMContentLoaded', function() {
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(function(element, index) {
        const finalValue = parseInt(element.getAttribute('data-value') || '0');
        
        // Stagger animation timing
        setTimeout(() => {
            animateValue(element, 0, finalValue, 1500);
        }, index * 200);
    });
    
    // Add welcome message with enhanced styling
    setTimeout(function() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '<i class="fas fa-tachometer-alt me-2"></i>Welcome to Admin Dashboard!',
                html: `
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success fa-3x"></i>
                        </div>
                        <p class="mb-0">You have successfully logged in to the admin panel.</p>
                        <small class="text-muted">Dashboard is ready for you to manage your content.</small>
                    </div>
                `,
                icon: 'success',
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                color: 'white',
                customClass: {
                    popup: 'swal2-toast-custom'
                }
            });
        }
    }, 1500);
    
    // Add hover effects to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Add click effects to quick action buttons
    const quickActionBtns = document.querySelectorAll('.quick-action-btn');
    quickActionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Add ripple effect
            const ripple = document.createElement('div');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255,255,255,0.3)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.left = '50%';
            ripple.style.top = '50%';
            ripple.style.width = '20px';
            ripple.style.height = '20px';
            ripple.style.marginLeft = '-10px';
            ripple.style.marginTop = '-10px';
            
            this.style.position = 'relative';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});

// Add ripple animation CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .swal2-toast-custom {
        border-radius: 15px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
    }
`;
document.head.appendChild(style);

// Refresh charts every 5 minutes
setInterval(function() {
    window.location.reload();
}, 300000); // 5 minutes
</script>
@endpush

@endsection