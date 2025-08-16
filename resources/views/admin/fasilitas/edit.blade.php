@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Fasilitas</h4>
                    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.fasilitas.update', $fasilitas) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="nama_fasilitas" class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nama_fasilitas') is-invalid @enderror" 
                                           id="nama_fasilitas" 
                                           name="nama_fasilitas" 
                                           value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" 
                                           required>
                                    @error('nama_fasilitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jurusan_id" class="form-label">Jurusan</label>
                                    <select class="form-select @error('jurusan_id') is-invalid @enderror" 
                                            id="jurusan_id" 
                                            name="jurusan_id">
                                        <option value="">Pilih Jurusan (Opsional - Umum)</option>
                                        @foreach($jurusan as $item)
                                            <option value="{{ $item->id }}" 
                                                {{ old('jurusan_id', $fasilitas->jurusan_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jurusan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Kosongkan jika fasilitas bersifat umum untuk semua jurusan</div>
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" 
                                           class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" 
                                           name="lokasi" 
                                           value="{{ old('lokasi', $fasilitas->lokasi) }}" 
                                           placeholder="Contoh: Gedung A, Lantai 2, Kampus Pusat">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jam_operasional" class="form-label">Jam Operasional</label>
                                            <input type="text" 
                                                   class="form-control @error('jam_operasional') is-invalid @enderror" 
                                                   id="jam_operasional" 
                                                   name="jam_operasional" 
                                                   value="{{ old('jam_operasional', $fasilitas->jam_operasional) }}" 
                                                   placeholder="Contoh: 08:00 - 17:00">
                                            @error('jam_operasional')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="kontak" class="form-label">Kontak</label>
                                            <input type="text" 
                                                   class="form-control @error('kontak') is-invalid @enderror" 
                                                   id="kontak" 
                                                   name="kontak" 
                                                   value="{{ old('kontak', $fasilitas->kontak) }}" 
                                                   placeholder="Contoh: 0812345678 atau email@domain.com">
                                            @error('kontak')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" 
                                              name="deskripsi" 
                                              rows="3" 
                                              placeholder="Deskripsi singkat untuk ditampilkan di card/list">{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi_lengkap" class="form-label">Deskripsi Lengkap</label>
                                    <textarea class="form-control @error('deskripsi_lengkap') is-invalid @enderror" 
                                              id="deskripsi_lengkap" 
                                              name="deskripsi_lengkap" 
                                              rows="8" 
                                              placeholder="Deskripsi detail untuk halaman detail fasilitas">{{ old('deskripsi_lengkap', $fasilitas->deskripsi_lengkap) }}</textarea>
                                    @error('deskripsi_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Gambar Existing -->
                                @if($fasilitas->gambar && count($fasilitas->gambar) > 0)
                                    <div class="mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="row">
                                            @foreach($fasilitas->gambar as $gambar)
                                                <div class="col-6 mb-2">
                                                    <img src="{{ asset('storage/' . $gambar) }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 100%; height: 100px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <small class="text-muted">Unggah gambar baru untuk mengganti gambar yang ada</small>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar Baru</label>
                                    <input type="file" 
                                           class="form-control @error('gambar.*') is-invalid @enderror" 
                                           id="gambar" 
                                           name="gambar[]" 
                                           multiple 
                                           accept="image/*">
                                    @error('gambar.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Pilih beberapa gambar (JPG, PNG, WEBP, max 2MB per gambar)</div>
                                    
                                    <div id="preview-container" class="mt-3"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="aktif" {{ old('status', $fasilitas->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $fasilitas->status) === 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- SEO Settings -->
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="mb-0">Pengaturan SEO</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="seo_title" class="form-label">SEO Title</label>
                                            <input type="text" 
                                                   class="form-control form-control-sm @error('seo_title') is-invalid @enderror" 
                                                   id="seo_title" 
                                                   name="seo_title" 
                                                   value="{{ old('seo_title', $fasilitas->seo_title) }}" 
                                                   placeholder="Kosongkan untuk otomatis">
                                            @error('seo_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="seo_description" class="form-label">SEO Description</label>
                                            <textarea class="form-control form-control-sm @error('seo_description') is-invalid @enderror" 
                                                      id="seo_description" 
                                                      name="seo_description" 
                                                      rows="3" 
                                                      placeholder="Kosongkan untuk otomatis">{{ old('seo_description', $fasilitas->seo_description) }}</textarea>
                                            @error('seo_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Fasilitas
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Preview gambar
    $('#gambar').change(function() {
        const files = this.files;
        const previewContainer = $('#preview-container');
        previewContainer.empty();

        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const preview = $(`
                        <div class="preview-item mb-2">
                            <img src="${e.target.result}" class="img-thumbnail" style="width: 100%; max-height: 150px; object-fit: cover;">
                            <small class="text-muted d-block">${file.name}</small>
                        </div>
                    `);
                    previewContainer.append(preview);
                };
                
                reader.readAsDataURL(file);
            }
        }
    });
});
</script>
@endpush
@endsection
