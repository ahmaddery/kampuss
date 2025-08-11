@extends('layouts.admin')

@section('title', 'Detail Pesan Kontak')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pesan Kontak</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('warning') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Message Info -->
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Message Details Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        {{ $contactMessage->subjek }}
                                        {!! $contactMessage->status_badge !!}
                                        @if(!$contactMessage->is_read)
                                            <span class="badge badge-warning ml-2">Belum Dibaca</span>
                                        @endif
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Nama:</strong></div>
                                        <div class="col-sm-9">{{ $contactMessage->nama_lengkap }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Email:</strong></div>
                                        <div class="col-sm-9">
                                            <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Telepon:</strong></div>
                                        <div class="col-sm-9">
                                            <a href="tel:{{ $contactMessage->nomor_telepon }}">{{ $contactMessage->nomor_telepon }}</a>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Tanggal:</strong></div>
                                        <div class="col-sm-9">{{ $contactMessage->created_at->format('d M Y H:i') }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Status Baca:</strong></div>
                                        <div class="col-sm-9">
                                            @if($contactMessage->is_read)
                                                <span class="badge badge-success">Sudah Dibaca</span>
                                                <small class="text-muted">({{ $contactMessage->read_at->format('d M Y H:i') }})</small>
                                            @else
                                                <span class="badge badge-warning">Belum Dibaca</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="mb-3">
                                        <strong>Pesan:</strong>
                                        <div class="mt-2 p-3 bg-light rounded">
                                            {!! nl2br(e($contactMessage->pesan)) !!}
                                        </div>
                                    </div>

                                    @if($contactMessage->admin_reply)
                                        <hr>
                                        <div class="mb-3">
                                            <strong>Balasan Admin:</strong>
                                            <div class="mt-2 p-3 bg-info text-white rounded">
                                                {!! nl2br(e($contactMessage->admin_reply)) !!}
                                            </div>
                                            <small class="text-muted">
                                                Dibalas oleh {{ $contactMessage->repliedBy->name ?? 'Admin' }} 
                                                pada {{ $contactMessage->replied_at->format('d M Y H:i') }}
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Reply Form -->
                            @if($contactMessage->status !== 'closed')
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4 class="card-title">Balas Pesan</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.contact-messages.reply', $contactMessage) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="admin_reply">Balasan:</label>
                                                <textarea name="admin_reply" id="admin_reply" class="form-control" rows="5" 
                                                         placeholder="Tulis balasan Anda di sini..." required>{{ old('admin_reply') }}</textarea>
                                                @error('admin_reply')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-reply"></i> Kirim Balasan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <!-- Actions Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Aksi</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Read Status Toggle -->
                                    <form action="{{ route('admin.contact-messages.toggle-read', $contactMessage) }}" method="POST" class="mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-block btn-{{ $contactMessage->is_read ? 'warning' : 'success' }}">
                                            <i class="fas fa-envelope{{ $contactMessage->is_read ? '-open' : '' }}"></i>
                                            {{ $contactMessage->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
                                        </button>
                                    </form>

                                    <!-- Status Update -->
                                    <form action="{{ route('admin.contact-messages.update-status', $contactMessage) }}" method="POST" class="mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label>Ubah Status:</label>
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="pending" {{ $contactMessage->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="replied" {{ $contactMessage->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                                <option value="closed" {{ $contactMessage->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                    </form>

                                    <hr>

                                    <!-- Contact Actions -->
                                    <div class="mb-2">
                                        <a href="mailto:{{ $contactMessage->email }}" class="btn btn-block btn-info">
                                            <i class="fas fa-envelope"></i> Kirim Email
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <a href="tel:{{ $contactMessage->nomor_telepon }}" class="btn btn-block btn-primary">
                                            <i class="fas fa-phone"></i> Telepon
                                        </a>
                                    </div>

                                    <hr>

                                    <!-- Delete -->
                                    <button type="button" class="btn btn-block btn-danger" onclick="deleteMessage()">
                                        <i class="fas fa-trash"></i> Hapus Pesan
                                    </button>
                                </div>
                            </div>

                            <!-- Message Info Card -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="card-title">Informasi Pesan</h4>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong>ID:</strong> #{{ $contactMessage->id }}<br>
                                        <strong>Dibuat:</strong> {{ $contactMessage->created_at->format('d M Y H:i') }}<br>
                                        <strong>Diperbarui:</strong> {{ $contactMessage->updated_at->format('d M Y H:i') }}<br>
                                        @if($contactMessage->read_at)
                                            <strong>Dibaca:</strong> {{ $contactMessage->read_at->format('d M Y H:i') }}<br>
                                        @endif
                                        @if($contactMessage->replied_at)
                                            <strong>Dibalas:</strong> {{ $contactMessage->replied_at->format('d M Y H:i') }}<br>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
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
                Apakah Anda yakin ingin menghapus pesan ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" style="display: inline;">
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
function deleteMessage() {
    $('#deleteModal').modal('show');
}
</script>
@endpush
