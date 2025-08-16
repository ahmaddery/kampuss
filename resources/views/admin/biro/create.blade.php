@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tambah Biro</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('home') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.biro.index') }}">Biro</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tambah Biro</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Form Tambah Biro</h4>
                            <a href="{{ route('admin.biro.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.biro.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nama_biro">Nama Biro <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('nama_biro') is-invalid @enderror" 
                                               id="nama_biro" 
                                               name="nama_biro" 
                                               value="{{ old('nama_biro') }}" 
                                               placeholder="Contoh: Biro Akademik"
                                               required>
                                        @error('nama_biro')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug') }}" 
                                               placeholder="biro-akademik (kosongkan untuk auto generate)">
                                        <small class="form-text text-muted">
                                            Slug akan dibuat otomatis jika dikosongkan
                                        </small>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Singkat</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                                  id="deskripsi" 
                                                  name="deskripsi" 
                                                  rows="3" 
                                                  placeholder="Deskripsi singkat tentang biro">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi_lengkap">Deskripsi Lengkap</label>
                                        <textarea class="form-control @error('deskripsi_lengkap') is-invalid @enderror" 
                                                  id="deskripsi_lengkap" 
                                                  name="deskripsi_lengkap" 
                                                  rows="8" 
                                                  placeholder="Deskripsi detail tentang biro, tugas, dan fungsinya">{{ old('deskripsi_lengkap') }}</textarea>
                                        @error('deskripsi_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" 
                                                name="status" 
                                                required>
                                            <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="logo">Logo Biro</label>
                                        <input type="file" 
                                               class="form-control @error('logo') is-invalid @enderror" 
                                               id="logo" 
                                               name="logo" 
                                               accept="image/*">
                                        <small class="form-text text-muted">
                                            Format: JPG, PNG, GIF, SVG. Maksimal: 2MB
                                        </small>
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="logo-preview" class="mt-2"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Gambar Dokumentasi</label>
                                        <input type="file" 
                                               class="form-control @error('gambar.*') is-invalid @enderror" 
                                               id="gambar" 
                                               name="gambar[]" 
                                               accept="image/*" 
                                               multiple>
                                        <small class="form-text text-muted">
                                            Bisa pilih beberapa gambar sekaligus. Format: JPG, PNG, GIF, SVG. Maksimal: 2MB per file
                                        </small>
                                        @error('gambar.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="gambar-preview" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Section -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Pengaturan SEO</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="seo_title">SEO Title</label>
                                        <input type="text" 
                                               class="form-control @error('seo_title') is-invalid @enderror" 
                                               id="seo_title" 
                                               name="seo_title" 
                                               value="{{ old('seo_title') }}" 
                                               placeholder="Judul untuk SEO (opsional)">
                                        <small class="form-text text-muted">
                                            Jika kosong, akan menggunakan nama biro
                                        </small>
                                        @error('seo_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="seo_description">SEO Description</label>
                                        <textarea class="form-control @error('seo_description') is-invalid @enderror" 
                                                  id="seo_description" 
                                                  name="seo_description" 
                                                  rows="3" 
                                                  placeholder="Deskripsi untuk SEO (opsional)">{{ old('seo_description') }}</textarea>
                                        <small class="form-text text-muted">
                                            Jika kosong, akan menggunakan deskripsi singkat
                                        </small>
                                        @error('seo_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan Biro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto generate slug from nama_biro
    document.getElementById('nama_biro').addEventListener('input', function() {
        const nama = this.value;
        const slug = nama.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        
        if (!document.getElementById('slug').value) {
            document.getElementById('slug').value = slug;
        }
    });

    // Logo preview
    document.getElementById('logo').addEventListener('change', function() {
        const file = this.files[0];
        const preview = document.getElementById('logo-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Logo Preview" 
                         class="img-thumbnail" 
                         style="max-width: 150px; max-height: 150px;">
                `;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });

    // Multiple images preview
    document.getElementById('gambar').addEventListener('change', function() {
        const files = this.files;
        const preview = document.getElementById('gambar-preview');
        preview.innerHTML = '';
        
        if (files.length > 0) {
            for (let i = 0; i < Math.min(files.length, 5); i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'd-inline-block me-2 mb-2';
                    div.innerHTML = `
                        <img src="${e.target.result}" 
                             alt="Preview ${i+1}" 
                             class="img-thumbnail" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
            
            if (files.length > 5) {
                const div = document.createElement('div');
                div.className = 'text-muted small mt-1';
                div.textContent = `+${files.length - 5} gambar lainnya`;
                preview.appendChild(div);
            }
        }
    });
</script>
@endpush
