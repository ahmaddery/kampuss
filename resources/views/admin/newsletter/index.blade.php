@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Manajemen Newsletter</h4>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Daftar Langganan Newsletter</h4>
                            <a href="{{ route('admin.newsletter.create') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i> Tambah Langganan
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter dan Pencarian -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <form action="{{ route('admin.newsletter.index') }}" method="GET" class="form-inline">
                                    <div class="form-group mr-2">
                                        <select name="type" class="form-control">
                                            <option value="" {{ request('type') == '' ? 'selected' : '' }}>Semua Tipe</option>
                                            <option value="berita" {{ request('type') == 'berita' ? 'selected' : '' }}>Berita</option>
                                            <option value="pengumuman" {{ request('type') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                            <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Semua Konten</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select name="status" class="form-control">
                                            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="input-group mr-2">
                                        <input type="text" name="search" class="form-control" placeholder="Cari email..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @if(request('type') || request('status') || request('search'))
                                        <a href="{{ route('admin.newsletter.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-times"></i> Reset
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                        
                        <!-- Flash Messages -->
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
                        
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Terakhir Dikirim</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subscriptions as $index => $subscription)
                                        <tr>
                                            <td>{{ $subscriptions->firstItem() + $index }}</td>
                                            <td>{{ $subscription->email }}</td>
                                            <td>
                                                @if($subscription->type == 'berita')
                                                    <span class="badge badge-info">Berita</span>
                                                @elseif($subscription->type == 'pengumuman')
                                                    <span class="badge badge-warning">Pengumuman</span>
                                                @else
                                                    <span class="badge badge-primary">Semua</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($subscription->is_active)
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $subscription->last_sent_at ? $subscription->last_sent_at->format('d M Y H:i') : 'Belum pernah' }}</td>
                                            <td>{{ $subscription->created_at->format('d M Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.newsletter.edit', $subscription->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.newsletter.toggle-active', $subscription->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm {{ $subscription->is_active ? 'btn-warning' : 'btn-success' }}" title="{{ $subscription->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                            <i class="fa {{ $subscription->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.newsletter.destroy', $subscription->id) }}" method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus langganan ini?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data langganan newsletter.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $subscriptions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto-submit form when select changes
        $('select[name="type"], select[name="status"]').change(function() {
            $(this).closest('form').submit();
        });
    });
</script>
@endsection