@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <div class="d-none d-sm-inline-block">
            <span class="text-muted">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Statistics Cards Row -->
    <div class="row mb-4">
        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalUsers) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Berita Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Berita</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalBerita) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pengumuman Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pengumuman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalPengumuman) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Subscribers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Newsletter Subscribers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalNewsletterSubscribers) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
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
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Jurusan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalJurusan) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Banners Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Homepage Banners</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalBanners) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Views Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Berita Views</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalBerita > 0 ? \App\Models\Berita::sum('count_views') : 0) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                System Status</div>
                            <div class="h5 mb-0 font-weight-bold text-success">
                                <i class="fas fa-check-circle"></i> Online
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-server fa-2x text-gray-300"></i>
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
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Content Activity (Last 6 Months)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="contentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Roles Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Roles Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Berita</h6>
                </div>
                <div class="card-body scrollbar-custom" style="max-height: 300px; overflow-y: auto;">
                    @if($recentBerita->count() > 0)
                        @foreach($recentBerita as $berita)
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="flex-shrink-0">
                                <i class="fas fa-newspaper text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3 ml-3">
                                <h6 class="mb-1">{{ Str::limit($berita->title, 35) }}</h6>
                                <small class="text-muted">{{ $berita->created_at->diffForHumans() }} | Views: {{ $berita->count_views }}</small>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-primary btn-sm">View All Berita</a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No recent berita found.</p>
                            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">Create First Berita</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Popular Berita -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Most Popular Berita</h6>
                </div>
                <div class="card-body scrollbar-custom" style="max-height: 300px; overflow-y: auto;">
                    @if($popularBerita->count() > 0)
                        @foreach($popularBerita as $index => $berita)
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="flex-shrink-0">
                                <span class="badge badge-{{ $index < 3 ? 'success' : 'secondary' }}">#{{ $index + 1 }}</span>
                            </div>
                            <div class="flex-grow-1 ms-3 ml-3">
                                <h6 class="mb-1">{{ Str::limit($berita->title, 35) }}</h6>
                                <small class="text-muted">{{ $berita->count_views }} views • {{ $berita->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No popular berita yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Users</h6>
                </div>
                <div class="card-body scrollbar-custom" style="max-height: 300px; overflow-y: auto;">
                    @if($recentUsers->count() > 0)
                        @foreach($recentUsers as $user)
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . ($user->profile_picture ?? 'default-profile.jpg')) }}" 
                                     alt="Profile" class="rounded-circle" width="32" height="32">
                            </div>
                            <div class="flex-grow-1 ms-3 ml-3">
                                <h6 class="mb-1">{{ $user->name }}</h6>
                                <small class="text-muted">{{ $user->email }} • {{ $user->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge badge-{{ $user->role == 'admin' ? 'primary' : 'secondary' }}">
                                    {{ ucfirst($user->role ?? 'User') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.users') }}" class="btn btn-primary btn-sm">Manage Users</a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No recent users found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Row -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Content Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="p-3">
                                <i class="fas fa-eye fa-2x text-primary mb-2"></i>
                                <h4 class="font-weight-bold text-primary">{{ number_format(\App\Models\Berita::sum('count_views')) }}</h4>
                                <p class="text-muted mb-0">Total Views</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <i class="fas fa-calendar fa-2x text-success mb-2"></i>
                                <h4 class="font-weight-bold text-success">{{ number_format(\App\Models\Berita::whereDate('created_at', today())->count()) }}</h4>
                                <p class="text-muted mb-0">Today's Posts</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h4 class="font-weight-bold text-warning">{{ number_format(\App\Models\Berita::whereDate('created_at', '>=', now()->subDays(7))->count()) }}</h4>
                                <p class="text-muted mb-0">This Week</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">System Information</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 px-0">
                            <span><i class="fas fa-server text-primary mr-2"></i>Laravel Version</span>
                            <span class="badge badge-primary">{{ app()->version() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 px-0">
                            <span><i class="fas fa-code text-success mr-2"></i>PHP Version</span>
                            <span class="badge badge-success">{{ PHP_VERSION }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 px-0">
                            <span><i class="fas fa-database text-info mr-2"></i>Database</span>
                            <span class="badge badge-info">{{ config('database.default') }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 px-0">
                            <span><i class="fas fa-clock text-warning mr-2"></i>Server Time</span>
                            <span class="badge badge-warning" id="server-time">{{ now()->format('H:i:s') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row quick-actions">
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.homepage_banners.index') }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-images mb-1"></i><br>
                                <small>Manage Banners</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-success btn-sm w-100">
                                <i class="fas fa-newspaper mb-1"></i><br>
                                <small>Manage Berita</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-info btn-sm w-100">
                                <i class="fas fa-bullhorn mb-1"></i><br>
                                <small>Manage Pengumuman</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-warning btn-sm w-100">
                                <i class="fas fa-graduation-cap mb-1"></i><br>
                                <small>Manage Jurusan</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.newsletter.index') }}" class="btn btn-secondary btn-sm w-100">
                                <i class="fas fa-envelope mb-1"></i><br>
                                <small>Newsletter</small>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-dark btn-sm w-100">
                                <i class="fas fa-cog mb-1"></i><br>
                                <small>Settings</small>
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

// Animate numbers on page load
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString();
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Animate all stat numbers
document.addEventListener('DOMContentLoaded', function() {
    const statNumbers = document.querySelectorAll('.h5.font-weight-bold');
    statNumbers.forEach(function(element) {
        const finalValue = parseInt(element.textContent.replace(/,/g, ''));
        animateValue(element, 0, finalValue, 2000);
    });
    
    // Add welcome message
    setTimeout(function() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Welcome to Admin Dashboard!',
                text: 'You have successfully logged in to the admin panel.',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
    }, 1000);
});

// Refresh charts every 5 minutes
setInterval(function() {
    window.location.reload();
}, 300000); // 5 minutes
</script>
@endpush

@endsection