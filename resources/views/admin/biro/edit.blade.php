@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Biro</h3>
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
                    <a href="#">Edit: {{ $biro->nama_biro }}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Form Edit Biro</h4>
                            <a href="{{ route('admin.biro.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.biro.update', $biro) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nama_biro">Nama Biro <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('nama_biro') is-invalid @enderror" 
                                               id="nama_biro" 
                                               name="nama_biro" 
                                               value="{{ old('nama_biro', $biro->nama_biro) }}" 
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
                                               value="{{ old('slug', $biro->slug) }}" 
                                               placeholder="biro-akademik">
                                        <small class="form-text text-muted">
                                            Slug akan diperbarui otomatis jika dikosongkan
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
                                                  placeholder="Deskripsi singkat tentang biro">{{ old('deskripsi', $biro->deskripsi) }}</textarea>
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
                                                  placeholder="Deskripsi detail tentang biro, tugas, dan fungsinya">{{ old('deskripsi_lengkap', $biro->deskripsi_lengkap) }}</textarea>
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
                                            <option value="aktif" {{ old('status', $biro->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="nonaktif" {{ old('status', $biro->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="logo">Logo Biro</label>
                                        @if($biro->logo)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $biro->logo) }}" 
                                                     alt="Current Logo" 
                                                     class="img-thumbnail" 
                                                     style="max-width: 150px; max-height: 150px;">
                                                <br><small class="text-muted">Logo saat ini</small>
                                            </div>
                                        @endif
                                        <input type="file" 
                                               class="form-control @error('logo') is-invalid @enderror" 
                                               id="logo" 
                                               name="logo" 
                                               accept="image/*">
                                        <small class="form-text text-muted">
                                            Format: JPG, PNG, GIF, SVG. Maksimal: 2MB. Kosongkan jika tidak ingin mengubah logo.
                                        </small>
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="logo-preview" class="mt-2"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Gambar Dokumentasi</label>
                                        @if($biro->gambar && count($biro->gambar) > 0)
                                            <div class="mb-2">
                                                <div class="row">
                                                    @foreach($biro->gambar as $gambar)
                                                        <div class="col-4 mb-2">
                                                            <img src="{{ asset('storage/' . $gambar) }}" 
                                                                 alt="Current Image" 
                                                                 class="img-thumbnail" 
                                                                 style="width: 100%; height: 80px; object-fit: cover;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <small class="text-muted">Gambar saat ini</small>
                                            </div>
                                        @endif
                                        <input type="file" 
                                               class="form-control @error('gambar.*') is-invalid @enderror" 
                                               id="gambar" 
                                               name="gambar[]" 
                                               accept="image/*" 
                                               multiple>
                                        <small class="form-text text-muted">
                                            Bisa pilih beberapa gambar sekaligus. Format: JPG, PNG, GIF, SVG. Maksimal: 2MB per file. Kosongkan jika tidak ingin mengubah gambar.
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
                                               value="{{ old('seo_title', $biro->seo_title) }}" 
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
                                                  placeholder="Deskripsi untuk SEO (opsional)">{{ old('seo_description', $biro->seo_description) }}</textarea>
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
                                    <i class="fa fa-save"></i> Update Biro
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
        
        if (!document.getElementById('slug').value || document.getElementById('slug').value === '{{ $biro->slug }}') {
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
                    <div class="mt-2">
                        <small class="text-muted">Preview logo baru:</small><br>
                        <img src="${e.target.result}" 
                             alt="Logo Preview" 
                             class="img-thumbnail" 
                             style="max-width: 150px; max-height: 150px;">
                    </div>
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
            const div = document.createElement('div');
            div.className = 'mt-2';
            div.innerHTML = '<small class="text-muted">Preview gambar baru:</small><br>';
            preview.appendChild(div);
            
            for (let i = 0; i < Math.min(files.length, 5); i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.className = 'd-inline-block me-2 mb-2';
                    imgDiv.innerHTML = `
                        <img src="${e.target.result}" 
                             alt="Preview ${i+1}" 
                             class="img-thumbnail" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                    `;
                    preview.appendChild(imgDiv);
                };
                reader.readAsDataURL(file);
            }
            
            if (files.length > 5) {
                const moreDiv = document.createElement('div');
                moreDiv.className = 'text-muted small mt-1';
                moreDiv.textContent = `+${files.length - 5} gambar lainnya`;
                preview.appendChild(moreDiv);
            }
        }
    });
</script>
@endpush
