@extends('layouts.admin')

@section('title', 'Kelola Pesan Kontak')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pesan Kontak</h3>
                </div>
                
                <!-- Filter and Stats -->
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $stats['total'] }}</h3>
                                    <p>Total Pesan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $stats['unread'] }}</h3>
                                    <p>Belum Dibaca</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $stats['pending'] }}</h3>
                                    <p>Pending</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $stats['replied'] }}</h3>
                                    <p>Sudah Dibalas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-reply"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <form method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="read_status" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="unread" {{ request('read_status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                    <option value="read" {{ request('read_status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau pesan..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <!-- Bulk Actions -->
                    <form id="bulk-action-form" method="POST" action="{{ route('admin.contact-messages.bulk-action') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="selectAll()">Pilih Semua</button>
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="selectNone()">Batal Pilih</button>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-info" onclick="bulkAction('mark_read')">Tandai Dibaca</button>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="bulkAction('mark_unread')">Tandai Belum Dibaca</button>
                                    <button type="button" class="btn btn-sm btn-success" onclick="bulkAction('close')">Tutup</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="bulkAction('delete')">Hapus</button>
                                </div>
                            </div>
                        </div>

                        <!-- Messages Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>Status</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Subjek</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $message)
                                        <tr class="{{ !$message->is_read ? 'table-warning' : '' }}">
                                            <td>
                                                <input type="checkbox" name="message_ids[]" value="{{ $message->id }}" class="message-checkbox">
                                            </td>
                                            <td>
                                                {!! $message->status_badge !!}
                                                @if(!$message->is_read)
                                                    <span class="badge badge-warning ml-1">Baru</span>
                                                @endif
                                            </td>
                                            <td>{{ $message->nama_lengkap }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ Str::limit($message->subjek, 30) }}</td>
                                            <td>{{ $message->formatted_date }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-{{ $message->is_read ? 'warning' : 'success' }}" 
                                                            onclick="toggleRead({{ $message->id }})">
                                                        <i class="fas fa-envelope{{ $message->is_read ? '-open' : '' }}"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteMessage({{ $message->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada pesan ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $messages->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pesan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Select All Checkbox
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.message-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

function selectAll() {
    const checkboxes = document.querySelectorAll('.message-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = true;
    });
    document.getElementById('select-all').checked = true;
}

function selectNone() {
    const checkboxes = document.querySelectorAll('.message-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    document.getElementById('select-all').checked = false;
}

function bulkAction(action) {
    const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
    if (checkedBoxes.length === 0) {
        alert('Pilih minimal satu pesan terlebih dahulu');
        return;
    }

    let confirmMessage = '';
    switch(action) {
        case 'mark_read':
            confirmMessage = 'Tandai pesan terpilih sebagai sudah dibaca?';
            break;
        case 'mark_unread':
            confirmMessage = 'Tandai pesan terpilih sebagai belum dibaca?';
            break;
        case 'close':
            confirmMessage = 'Tutup pesan terpilih?';
            break;
        case 'delete':
            confirmMessage = 'Hapus pesan terpilih? Tindakan ini tidak dapat dibatalkan.';
            break;
    }

    if (confirm(confirmMessage)) {
        const form = document.getElementById('bulk-action-form');
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;
        form.appendChild(actionInput);
        form.submit();
    }
}

function toggleRead(messageId) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/contact-messages/${messageId}/toggle-read`;
    
    const token = document.createElement('input');
    token.type = 'hidden';
    token.name = '_token';
    token.value = '{{ csrf_token() }}';
    
    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'PATCH';
    
    form.appendChild(token);
    form.appendChild(method);
    document.body.appendChild(form);
    form.submit();
}

function deleteMessage(messageId) {
    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = `/admin/contact-messages/${messageId}`;
    $('#deleteModal').modal('show');
}
</script>
@endpush
