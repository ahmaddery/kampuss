@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manajemen Visi Misi</h4>
                    <a href="{{ route('admin.visi-misi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Introduction Section --}}
                    @if(isset($grouped['intro']) && count($grouped['intro']) > 0)
                    <div class="mb-4">
                        <h5 class="text-primary">Intro/Pembuka</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grouped['intro'] as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ Str::limit($item->description, 100) }}</td>
                                        <td>
                                            @if($item->image_path)
                                                <img src="{{ $item->image_url }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.visi-misi.show', $item->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.visi-misi.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.visi-misi.destroy', $item->id) }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    {{-- Vision Section --}}
                    @if(isset($grouped['vision']) && count($grouped['vision']) > 0)
                    <div class="mb-4">
                        <h5 class="text-success">Visi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Target Year</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grouped['vision'] as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ Str::limit($item->description, 100) }}</td>
                                        <td>{{ $item->year_target ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.visi-misi.show', $item->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.visi-misi.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.visi-misi.destroy', $item->id) }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    {{-- Mission Section --}}
                    @if(isset($grouped['mission']) && count($grouped['mission']) > 0)
                    <div class="mb-4">
                        <h5 class="text-warning">Misi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="80">Order</th>
                                        <th>Description</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="mission-table-body">
                                    @foreach($grouped['mission'] as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>
                                            <span class="badge bg-primary">{{ $item->order }}</span>
                                        </td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.visi-misi.show', $item->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.visi-misi.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.visi-misi.destroy', $item->id) }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-secondary" id="reorderMissionsBtn">
                            <i class="fas fa-sort"></i> Atur Ulang Urutan Misi
                        </button>
                    </div>
                    @endif

                    @if(!isset($grouped) || count($grouped) === 0)
                    <div class="text-center py-4">
                        <p class="text-muted">Belum ada data visi misi. <a href="{{ route('admin.visi-misi.create') }}">Tambah data pertama</a></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Reorder Missions --}}
<div class="modal fade" id="reorderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atur Ulang Urutan Misi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Drag dan drop untuk mengatur ulang urutan misi</p>
                <ul id="sortable-missions" class="list-group">
                    @if(isset($grouped['mission']))
                        @foreach($grouped['mission'] as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $item->id }}">
                            <div>
                                <i class="fas fa-grip-vertical text-muted me-2"></i>
                                <span class="badge bg-primary me-2">{{ $item->order }}</span>
                                {{ Str::limit($item->description, 80) }}
                            </div>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveReorderBtn">Simpan Urutan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reorderBtn = document.getElementById('reorderMissionsBtn');
    const reorderModal = new bootstrap.Modal(document.getElementById('reorderModal'));
    const sortableList = document.getElementById('sortable-missions');
    const saveBtn = document.getElementById('saveReorderBtn');

    // Initialize Sortable
    let sortable;
    
    if (reorderBtn) {
        reorderBtn.addEventListener('click', function() {
            reorderModal.show();
            
            // Initialize sortable after modal is shown
            setTimeout(() => {
                if (sortableList) {
                    sortable = Sortable.create(sortableList, {
                        animation: 150,
                        ghostClass: 'sortable-ghost'
                    });
                }
            }, 100);
        });
    }

    if (saveBtn) {
        saveBtn.addEventListener('click', function() {
            const items = sortableList.querySelectorAll('li[data-id]');
            const missions = Array.from(items).map((item, index) => ({
                id: item.getAttribute('data-id'),
                order: index + 1
            }));

            // Send AJAX request to save new order
            fetch('{{ route("admin.visi-misi.reorder-missions") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    missions: missions
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    reorderModal.hide();
                    location.reload(); // Reload to show updated order
                } else {
                    alert('Gagal menyimpan urutan. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        });
    }
});
</script>

<style>
.sortable-ghost {
    opacity: 0.4;
}

#sortable-missions .list-group-item {
    cursor: move;
}

#sortable-missions .list-group-item:hover {
    background-color: #f8f9fa;
}
</style>
@endpush
