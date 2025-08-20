@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Log Aktivitas Sistem</h1>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#clearLogsModal">
                <i class="fas fa-trash-alt"></i> Bersihkan Log Lama
            </button>
            <a href="{{ route('admin.activity-logs.export', request()->query()) }}" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Aktivitas Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['today']) }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['this_week']) }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['this_month']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
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
                                Total Aktivitas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tren Aktivitas 7 Hari Terakhir</h6>
                    <div class="dropdown no-arrow">
                        <select id="chartDays" class="form-select form-select-sm">
                            <option value="7">7 Hari</option>
                            <option value="14">14 Hari</option>
                            <option value="30">30 Hari</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" style="height: 320px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas per Kategori</h6>
                </div>
                <div class="card-body">
                    @foreach($stats['by_category'] as $category => $count)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-sm font-weight-bold">{{ ucfirst($category) }}</span>
                            <span class="text-sm">{{ number_format($count) }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ ($count / $stats['by_category']->max()) * 100 }}%"
                                 aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="{{ $stats['by_category']->max() }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Log Aktivitas</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.activity-logs.index') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="date_from" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="date_from" name="date_from" 
                               value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="date_to" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="date_to" name="date_to" 
                               value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="log_name" class="form-label">Kategori</label>
                        <select class="form-select" id="log_name" name="log_name">
                            <option value="">Semua Kategori</option>
                            @foreach($logNames as $logName)
                            <option value="{{ $logName }}" {{ request('log_name') == $logName ? 'selected' : '' }}>
                                {{ ucfirst($logName) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="user_id" class="form-label">Pengguna</label>
                        <select class="form-select" id="user_id" name="user_id">
                            <option value="">Semua Pengguna</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="warning" {{ request('status') == 'warning' ? 'selected' : '' }}>Warning</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="search" class="form-label">Cari dalam Deskripsi</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               placeholder="Masukkan kata kunci..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-list"></i> {{ request('per_page', 20) }} item
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['per_page' => 10, 'page' => 1]) }}">10 item per halaman</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['per_page' => 20, 'page' => 1]) }}">20 item per halaman</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['per_page' => 50, 'page' => 1]) }}">50 item per halaman</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['per_page' => 100, 'page' => 1]) }}">100 item per halaman</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Activity Logs Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Daftar Aktivitas 
            </h6>
        </div>
        <div class="card-body">
            <div class="activity-table-wrapper">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="120">Waktu</th>
                            <th width="100">Pengguna</th>
                            <th width="80">Kategori</th>
                            <th>Deskripsi</th>
                            <th width="80">Status</th>
                            <th width="100">IP Address</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>
                                <div class="text-sm">
                                    {{ $log->formatted_date }}<br>
                                    <span class="text-muted">{{ $log->created_at->setTimezone('Asia/Jakarta')->format('H:i:s') }} WIB</span>
                                </div>
                            </td>
                            <td>
                                @if($log->user)
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <div class="avatar-initial rounded-circle bg-label-primary">
                                                {{ substr($log->user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $log->user->name }}</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">System</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="{{ $log->icon }}"></i> {{ ucfirst($log->log_name) }}
                                </span>
                            </td>
                            <td>
                                <div class="text-sm">{{ $log->description }}</div>
                                @if($log->url && $log->method)
                                <div class="text-xs text-muted mt-1">
                                    <span class="badge badge-outline-secondary">{{ $log->method }}</span>
                                    {{ Str::limit($log->url, 50) }}
                                </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $log->status_color }}">
                                    {{ ucfirst($log->status) }}
                                </span>
                            </td>
                            <td class="text-sm">{{ $log->ip_address }}</td>
                            <td>
                                <a href="{{ route('admin.activity-logs.show', $log) }}" 
                                   class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>Tidak ada log aktivitas yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>

            @if($logs->hasPages())
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <span class="text-muted small">
                            Menampilkan 
                            <strong>{{ number_format($logs->firstItem()) }}</strong> - 
                            <strong>{{ number_format($logs->lastItem()) }}</strong> 
                            dari 
                            <strong>{{ number_format($logs->total()) }}</strong> 
                            total aktivitas
                        </span>
                        @if(request()->hasAny(['search', 'log_name', 'user_id', 'status', 'date_from', 'date_to']))
                            <span class="badge bg-info ms-2">
                                <i class="fas fa-filter"></i> Difilter
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        {{ $logs->links('custom.pagination.simple') }}
                    </div>
                </div>
            </div>
            @elseif($logs->count() > 0)
            <div class="mt-4">
                <span class="text-muted small">
                    Menampilkan {{ number_format($logs->count()) }} aktivitas
                    @if(request()->hasAny(['search', 'log_name', 'user_id', 'status', 'date_from', 'date_to']))
                        <span class="badge bg-info ms-2">
                            <i class="fas fa-filter"></i> Difilter
                        </span>
                    @endif
                </span>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Clear Logs Modal -->
<div class="modal fade" id="clearLogsModal" tabindex="-1" aria-labelledby="clearLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clearLogsModalLabel">Bersihkan Log Lama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.activity-logs.clear') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Peringatan!</strong> Aksi ini akan menghapus semua log aktivitas yang lebih lama dari periode yang ditentukan dan tidak dapat dibatalkan.
                    </div>
                    <div class="mb-3">
                        <label for="days" class="form-label">Hapus log yang lebih lama dari (hari):</label>
                        <select class="form-select" id="days" name="days" required>
                            <option value="30">30 Hari</option>
                            <option value="60">60 Hari</option>
                            <option value="90">90 Hari</option>
                            <option value="180">180 Hari</option>
                            <option value="365">1 Tahun</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Hapus Log Lama</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.pagination-wrapper {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-top: 20px;
}

.pagination-info span {
    font-weight: 600;
}

@media (max-width: 768px) {
    .pagination-wrapper {
        padding: 10px;
    }
    
    .pagination-prev,
    .pagination-next {
        margin-bottom: 10px;
    }
    
    .pagination-info {
        margin-bottom: 10px;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: center !important;
    }
}

.activity-table-wrapper {
    min-height: 400px;
}

.badge-filter {
    font-size: 0.7rem;
    padding: 0.25em 0.5em;
}

.dropdown-toggle::after {
    margin-left: 0.5rem;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Activity Chart
let activityChart;

function loadActivityChart(days = 7) {
    fetch(`{{ route('admin.activity-logs.chart-data') }}?days=${days}`)
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('activityChart').getContext('2d');
            
            if (activityChart) {
                activityChart.destroy();
            }
            
            activityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [
                        {
                            label: 'Total',
                            data: data.map(item => item.total),
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            tension: 0.1,
                            fill: true
                        },
                        {
                            label: 'Auth',
                            data: data.map(item => item.auth),
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.1)',
                            tension: 0.1
                        },
                        {
                            label: 'Berita',
                            data: data.map(item => item.berita),
                            borderColor: 'rgb(54, 162, 235)',
                            backgroundColor: 'rgba(54, 162, 235, 0.1)',
                            tension: 0.1
                        },
                        {
                            label: 'Admin',
                            data: data.map(item => item.admin),
                            borderColor: 'rgb(255, 205, 86)',
                            backgroundColor: 'rgba(255, 205, 86, 0.1)',
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading chart data:', error);
        });
}

// Load initial chart
document.addEventListener('DOMContentLoaded', function() {
    loadActivityChart();
    
    // Chart days selector
    document.getElementById('chartDays').addEventListener('change', function() {
        loadActivityChart(this.value);
    });
});

// Auto refresh chart every 5 minutes
setInterval(() => {
    const selectedDays = document.getElementById('chartDays').value;
    loadActivityChart(selectedDays);
}, 300000);

// Smooth scroll to top when pagination clicked
document.addEventListener('click', function(e) {
    if (e.target.closest('.pagination-prev a') || e.target.closest('.pagination-next a')) {
        setTimeout(() => {
            document.querySelector('.card.shadow.mb-4').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }, 100);
    }
});

// Remember scroll position
window.addEventListener('beforeunload', function() {
    sessionStorage.setItem('activityLogsScrollPos', window.pageYOffset);
});

window.addEventListener('load', function() {
    const scrollPos = sessionStorage.getItem('activityLogsScrollPos');
    if (scrollPos) {
        window.scrollTo(0, parseInt(scrollPos));
        sessionStorage.removeItem('activityLogsScrollPos');
    }
});

// Enhanced keyboard navigation
document.addEventListener('keydown', function(e) {
    // Alt + Left Arrow = Previous page
    if (e.altKey && e.key === 'ArrowLeft') {
        const prevBtn = document.querySelector('.pagination-prev a');
        if (prevBtn) {
            e.preventDefault();
            prevBtn.click();
        }
    }
    
    // Alt + Right Arrow = Next page  
    if (e.altKey && e.key === 'ArrowRight') {
        const nextBtn = document.querySelector('.pagination-next a');
        if (nextBtn) {
            e.preventDefault();
            nextBtn.click();
        }
    }
    
    // Ctrl + F = Focus search
    if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        const searchInput = document.getElementById('search');
        if (searchInput) {
            searchInput.focus();
        }
    }
});

// Loading indicator for pagination
document.addEventListener('click', function(e) {
    if (e.target.closest('.pagination-prev a') || e.target.closest('.pagination-next a')) {
        const btn = e.target.closest('a');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        btn.style.pointerEvents = 'none';
        
        // Restore if page load fails
        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.style.pointerEvents = 'auto';
        }, 5000);
    }
});
</script>
@endpush
