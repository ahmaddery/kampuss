@extends('layouts.admin')

@section('title', 'Detail Log Aktivitas')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Log Aktivitas</h1>
        <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Main Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Aktivitas</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Tanggal & Waktu</label>
                                <div class="mt-1">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    {{ $activityLog->created_at->format('d F Y, H:i:s') }}
                                    <br>
                                    <small class="text-muted">{{ $activityLog->time_ago }}</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-muted">Kategori</label>
                                <div class="mt-1">
                                    <span class="badge bg-secondary fs-6">
                                        <i class="{{ $activityLog->icon }} me-1"></i>
                                        {{ ucfirst($activityLog->log_name) }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-muted">Status</label>
                                <div class="mt-1">
                                    <span class="badge {{ $activityLog->status_color }} fs-6">
                                        @if($activityLog->status == 'success')
                                            <i class="fas fa-check me-1"></i>
                                        @elseif($activityLog->status == 'failed')
                                            <i class="fas fa-times me-1"></i>
                                        @else
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                        @endif
                                        {{ ucfirst($activityLog->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Pengguna</label>
                                <div class="mt-1">
                                    @if($activityLog->user)
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md me-3">
                                                <div class="avatar-initial rounded-circle bg-label-primary fs-5">
                                                    {{ substr($activityLog->user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $activityLog->user->name }}</div>
                                                <div class="text-muted small">{{ $activityLog->user->email }}</div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">
                                            <i class="fas fa-robot me-2"></i>System
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-muted">IP Address</label>
                                <div class="mt-1">
                                    <i class="fas fa-globe text-info me-2"></i>
                                    {{ $activityLog->ip_address ?: 'Tidak diketahui' }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-muted">Batch UUID</label>
                                <div class="mt-1">
                                    <code class="text-muted">{{ $activityLog->batch_uuid ?: 'Tidak ada' }}</code>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Deskripsi</label>
                                <div class="mt-1 p-3 bg-light rounded">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    {{ $activityLog->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Information -->
            @if($activityLog->url || $activityLog->method || $activityLog->user_agent)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Request</h6>
                </div>
                <div class="card-body">
                    @if($activityLog->method && $activityLog->url)
                    <div class="mb-3">
                        <label class="fw-bold text-muted">HTTP Request</label>
                        <div class="mt-1">
                            <span class="badge 
                                @if($activityLog->method == 'GET') bg-success
                                @elseif($activityLog->method == 'POST') bg-primary
                                @elseif($activityLog->method == 'PUT') bg-warning
                                @elseif($activityLog->method == 'DELETE') bg-danger
                                @else bg-secondary @endif
                            ">{{ $activityLog->method }}</span>
                            <code class="ms-2">{{ $activityLog->url }}</code>
                        </div>
                    </div>
                    @endif

                    @if($activityLog->user_agent)
                    <div class="mb-3">
                        <label class="fw-bold text-muted">User Agent</label>
                        <div class="mt-1">
                            <small class="text-muted font-monospace">{{ $activityLog->user_agent }}</small>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Properties/Additional Data -->
            @if($activityLog->properties && count($activityLog->properties) > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tambahan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            @foreach($activityLog->properties as $key => $value)
                            <tr>
                                <td class="fw-bold text-muted" style="width: 200px;">{{ ucfirst(str_replace('_', ' ', $key)) }}:</td>
                                <td>
                                    @if(is_array($value) || is_object($value))
                                        <details>
                                            <summary class="text-primary cursor-pointer">Lihat Data</summary>
                                            <pre class="mt-2 p-2 bg-light rounded"><code>{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</code></pre>
                                        </details>
                                    @else
                                        <span class="text-dark">{{ $value }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Subject Information -->
            @if($activityLog->subject)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Objek Terkait</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold text-muted">Tipe Model</label>
                        <div class="mt-1">
                            <code>{{ $activityLog->subject_type }}</code>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted">ID</label>
                        <div class="mt-1">
                            <span class="badge bg-info">{{ $activityLog->subject_id }}</span>
                        </div>
                    </div>

                    @if($activityLog->subject)
                    <div class="mb-3">
                        <label class="fw-bold text-muted">Informasi</label>
                        <div class="mt-1 p-2 bg-light rounded">
                            @if(isset($activityLog->subject->name))
                                <strong>Nama:</strong> {{ $activityLog->subject->name }}<br>
                            @endif
                            @if(isset($activityLog->subject->title))
                                <strong>Judul:</strong> {{ $activityLog->subject->title }}<br>
                            @endif
                            @if(isset($activityLog->subject->judul))
                                <strong>Judul:</strong> {{ $activityLog->subject->judul }}<br>
                            @endif
                            @if(isset($activityLog->subject->email))
                                <strong>Email:</strong> {{ $activityLog->subject->email }}<br>
                            @endif
                            @if(isset($activityLog->subject->created_at))
                                <strong>Dibuat:</strong> {{ $activityLog->subject->created_at->format('d/m/Y H:i') }}<br>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Related Activities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terkait</h6>
                </div>
                <div class="card-body">
                    @php
                        $relatedLogs = \App\Models\ActivityLog::where('id', '!=', $activityLog->id)
                            ->where(function($query) use ($activityLog) {
                                if ($activityLog->subject_id) {
                                    $query->where('subject_id', $activityLog->subject_id)
                                          ->where('subject_type', $activityLog->subject_type);
                                }
                                if ($activityLog->causer_id) {
                                    $query->orWhere('causer_id', $activityLog->causer_id);
                                }
                                if ($activityLog->batch_uuid) {
                                    $query->orWhere('batch_uuid', $activityLog->batch_uuid);
                                }
                            })
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp

                    @forelse($relatedLogs as $relatedLog)
                    <div class="d-flex align-items-start mb-3">
                        <div class="avatar avatar-sm me-2">
                            <div class="avatar-initial rounded-circle bg-label-secondary">
                                <i class="{{ $relatedLog->icon }} text-xs"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="text-sm">{{ Str::limit($relatedLog->description, 50) }}</div>
                            <div class="text-xs text-muted">{{ $relatedLog->time_ago }}</div>
                        </div>
                        <a href="{{ route('admin.activity-logs.show', $relatedLog) }}" 
                           class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    @empty
                    <div class="text-center text-muted">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p class="small">Tidak ada aktivitas terkait</p>
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
                        @if($activityLog->user)
                        <a href="{{ route('admin.activity-logs.index', ['user_id' => $activityLog->causer_id]) }}" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-user"></i> Lihat Aktivitas Pengguna Ini
                        </a>
                        @endif

                        @if($activityLog->log_name)
                        <a href="{{ route('admin.activity-logs.index', ['log_name' => $activityLog->log_name]) }}" 
                           class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-filter"></i> Lihat Kategori {{ ucfirst($activityLog->log_name) }}
                        </a>
                        @endif

                        @if($activityLog->created_at)
                        <a href="{{ route('admin.activity-logs.index', ['date_from' => $activityLog->created_at->format('Y-m-d'), 'date_to' => $activityLog->created_at->format('Y-m-d')]) }}" 
                           class="btn btn-outline-info btn-sm">
                            <i class="fas fa-calendar"></i> Lihat Aktivitas Hari Ini
                        </a>
                        @endif

                        <button type="button" class="btn btn-outline-success btn-sm" onclick="copyToClipboard()">
                            <i class="fas fa-copy"></i> Salin Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyToClipboard() {
    const details = `
Log Aktivitas Detail
==================
Waktu: {{ $activityLog->created_at->format('d F Y, H:i:s') }}
Kategori: {{ ucfirst($activityLog->log_name) }}
Status: {{ ucfirst($activityLog->status) }}
Pengguna: {{ $activityLog->user ? $activityLog->user->name : 'System' }}
IP Address: {{ $activityLog->ip_address ?: 'Tidak diketahui' }}
Deskripsi: {{ $activityLog->description }}
@if($activityLog->url)URL: {{ $activityLog->url }}@endif
@if($activityLog->method)Method: {{ $activityLog->method }}@endif
`.trim();

    navigator.clipboard.writeText(details).then(() => {
        // Show success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
        btn.classList.remove('btn-outline-success');
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-success');
        }, 2000);
    }).catch(err => {
        console.error('Error copying to clipboard:', err);
        alert('Gagal menyalin ke clipboard');
    });
}
</script>
@endpush
