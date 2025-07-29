@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('admin.organization-structure.index') }}">Struktur Organisasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Unit</li>
                </ol>
            </nav>
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-edit me-2"></i> Edit Unit Organisasi</h3>
        </div>

        <!-- Main Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <form action="{{ route('admin.organization-structure.update', $organizationStructure->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Unit Information -->
                            <div class="mb-4">
                                <h5 class="mb-3 fw-semibold text-dark">
                                    <i class="fas fa-building me-2"></i> Informasi Unit
                                </h5>
                                
                                <!-- Parent Unit -->
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label fw-medium">Unit Induk</label>
                                    <select class="form-select @error('parent_id') is-invalid @enderror" 
                                            id="parent_id" name="parent_id">
                                        <option value="">-- Pilih Unit Induk (Opsional) --</option>
                                        @foreach($parentOptions as $option)
                                            <option value="{{ $option['id'] }}" 
                                                    {{ (old('parent_id') ?? $organizationStructure->parent_id) == $option['id'] ? 'selected' : '' }}>
                                                {{ $option['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Kosongkan jika ini adalah unit tingkat atas</small>
                                </div>

                                <!-- Unit Name -->
                                <div class="mb-3">
                                    <label for="unit_name" class="form-label fw-medium">Nama Unit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('unit_name') is-invalid @enderror" 
                                           id="unit_name" name="unit_name" 
                                           value="{{ old('unit_name') ?? $organizationStructure->unit_name }}" 
                                           placeholder="Contoh: Fakultas Ekonomi, Prodi Manajemen">
                                    @error('unit_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Order Position -->
                                <div class="mb-3">
                                    <label for="order_position" class="form-label fw-medium">Urutan Tampil</label>
                                    <input type="number" class="form-control @error('order_position') is-invalid @enderror" 
                                           id="order_position" name="order_position" 
                                           value="{{ old('order_position') ?? $organizationStructure->order_position }}" 
                                           min="0" placeholder="0">
                                    @error('order_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Semakin kecil nomor, semakin atas posisinya</small>
                                </div>
                            </div>

                            <!-- Position Information -->
                            <div class="mb-4">
                                <h5 class="mb-3 fw-semibold text-dark">
                                    <i class="fas fa-user-tie me-2"></i> Informasi Jabatan (Opsional)
                                </h5>
                                
                                <!-- Position Title -->
                                <div class="mb-3">
                                    <label for="position_title" class="form-label fw-medium">Nama Jabatan</label>
                                    <input type="text" class="form-control @error('position_title') is-invalid @enderror" 
                                           id="position_title" name="position_title" 
                                           value="{{ old('position_title') ?? $organizationStructure->position_title }}" 
                                           placeholder="Contoh: Dekan, Ketua Prodi, Direktur">
                                    @error('position_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Person Name -->
                                <div class="mb-3">
                                    <label for="person_name" class="form-label fw-medium">Nama Pejabat</label>
                                    <input type="text" class="form-control @error('person_name') is-invalid @enderror" 
                                           id="person_name" name="person_name" 
                                           value="{{ old('person_name') ?? $organizationStructure->person_name }}" 
                                           placeholder="Contoh: Dr. Agus Slamet, S.TP., M.P., MCE">
                                    @error('person_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Image Upload -->
                            <div class="mb-4">
                                <h5 class="mb-3 fw-semibold text-dark">
                                    <i class="fas fa-image me-2"></i> Logo/Gambar
                                </h5>
                                
                                <!-- Current Image -->
                                @if($organizationStructure->image_path)
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Gambar Saat Ini</label>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $organizationStructure->image_path) }}" 
                                                 alt="Current Image" class="img-fluid rounded border" style="max-height: 150px;">
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <label for="image" class="form-label fw-medium">Upload Gambar Baru</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                                </div>

                                <!-- Image Preview -->
                                <div id="imagePreview" class="text-center" style="display: none;">
                                    <label class="form-label fw-medium">Preview Gambar Baru</label>
                                    <img id="previewImg" src="" alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                </div>
                            </div>

                            <!-- Help Info -->
                            <div class="alert alert-info">
                                <h6 class="alert-heading"><i class="fas fa-info-circle me-1"></i> Tips</h6>
                                <ul class="mb-0 small">
                                    <li>Unit induk adalah unit yang berada di atasnya dalam hierarki</li>
                                    <li>Jika tidak ada jabatan, kosongkan field jabatan dan nama pejabat</li>
                                    <li>Urutan tampil menentukan posisi dalam daftar</li>
                                    <li>Upload gambar baru hanya jika ingin mengubah yang lama</li>
                                </ul>
                            </div>

                            <!-- Children Warning -->
                            @if($organizationStructure->children->count() > 0)
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-1"></i> Perhatian</h6>
                                    <p class="mb-0 small">Unit ini memiliki {{ $organizationStructure->children->count() }} unit di bawahnya. Hati-hati saat mengubah parent unit.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <hr class="my-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>
                                <a href="{{ route('admin.organization-structure.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                                <a href="{{ route('admin.organization-structure.show', $organizationStructure->id) }}" class="btn btn-outline-info">
                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Image preview
    $('#image').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
                $('#imagePreview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#imagePreview').hide();
        }
    });

    // Form validation
    $('form').submit(function(e) {
        var unitName = $('#unit_name').val().trim();
        if (unitName === '') {
            e.preventDefault();
            $('#unit_name').focus();
            alert('Nama unit harus diisi!');
            return false;
        }
    });
});
</script>
@endpush
@endsection
