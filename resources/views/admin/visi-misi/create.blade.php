@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Tambah Data Visi Misi</h4>
                    <a href="{{ route('admin.visi-misi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.visi-misi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="intro" {{ old('type') == 'intro' ? 'selected' : '' }}>Intro/Pembuka</option>
                                        <option value="vision" {{ old('type') == 'vision' ? 'selected' : '' }}>Visi</option>
                                        <option value="mission" {{ old('type') == 'mission' ? 'selected' : '' }}>Misi</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3" id="title-field">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3" id="order-field" style="display: none;">
                                    <label for="order" class="form-label">Urutan <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                           id="order" name="order" value="{{ old('order') }}" min="1">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3" id="year-field" style="display: none;">
                                    <label for="year_target" class="form-label">Target Tahun</label>
                                    <input type="number" class="form-control @error('year_target') is-invalid @enderror" 
                                           id="year_target" name="year_target" value="{{ old('year_target') }}" 
                                           min="2020" max="2050">
                                    @error('year_target')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3" id="image-field" style="display: none;">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const titleField = document.getElementById('title-field');
    const orderField = document.getElementById('order-field');
    const yearField = document.getElementById('year-field');
    const imageField = document.getElementById('image-field');
    const orderInput = document.getElementById('order');
    const titleInput = document.getElementById('title');

    function toggleFields() {
        const selectedType = typeSelect.value;
        
        // Reset all fields
        orderField.style.display = 'none';
        yearField.style.display = 'none';
        imageField.style.display = 'none';
        orderInput.removeAttribute('required');
        titleInput.removeAttribute('required');
        
        // Show/hide fields based on type
        switch(selectedType) {
            case 'intro':
                imageField.style.display = 'block';
                titleInput.setAttribute('required', 'required');
                break;
            case 'vision':
                yearField.style.display = 'block';
                titleInput.setAttribute('required', 'required');
                break;
            case 'mission':
                orderField.style.display = 'block';
                orderInput.setAttribute('required', 'required');
                break;
        }
    }

    typeSelect.addEventListener('change', toggleFields);
    
    // Initialize on page load
    toggleFields();
});
</script>
@endpush
