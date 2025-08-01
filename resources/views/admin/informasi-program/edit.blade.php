@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="page-inner">
        <!-- Page Header -->
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0 fw-bold text-dark"><i class="fas fa-edit me-2"></i> Edit Informasi Program</h3>
            <a href="{{ route('admin.informasi-program.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <!-- Main Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <form action="{{ route('admin.informasi-program.update', $informasiProgram->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Program Studi -->
                            <div class="mb-3">
                                <label for="jurusan_id" class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                                <select name="jurusan_id" id="jurusan_id" class="form-select @error('jurusan_id') is-invalid @enderror" required>
                                    <option value="">Pilih Program Studi</option>
                                    @foreach($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $informasiProgram->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                            {{ $jurusan->jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenjang -->
                            <div class="mb-3">
                                <label for="jenjang" class="form-label fw-semibold">Jenjang <span class="text-danger">*</span></label>
                                <select name="jenjang" id="jenjang" class="form-select @error('jenjang') is-invalid @enderror" required>
                                    <option value="">Pilih Jenjang</option>
                                    <option value="D3" {{ old('jenjang', $informasiProgram->jenjang) == 'D3' ? 'selected' : '' }}>D3 (Diploma)</option>
                                    <option value="S1" {{ old('jenjang', $informasiProgram->jenjang) == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                                    <option value="S2" {{ old('jenjang', $informasiProgram->jenjang) == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                                    <option value="S3" {{ old('jenjang', $informasiProgram->jenjang) == 'S3' ? 'selected' : '' }}>S3 (Doktor)</option>
                                </select>
                                @error('jenjang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Durasi -->
                            <div class="mb-3">
                                <label for="durasi" class="form-label fw-semibold">Durasi <span class="text-danger">*</span></label>
                                <input type="text" name="durasi" id="durasi" 
                                       class="form-control @error('durasi') is-invalid @enderror" 
                                       value="{{ old('durasi', $informasiProgram->durasi) }}" 
                                       placeholder="Contoh: 8 Semester" required>
                                @error('durasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- SKS -->
                            <div class="mb-3">
                                <label for="sks" class="form-label fw-semibold">SKS <span class="text-danger">*</span></label>
                                <input type="text" name="sks" id="sks" 
                                       class="form-control @error('sks') is-invalid @enderror" 
                                       value="{{ old('sks', $informasiProgram->sks) }}" 
                                       placeholder="Contoh: 144 SKS" required>
                                @error('sks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Akreditasi -->
                            <div class="mb-3">
                                <label for="akreditasi" class="form-label fw-semibold">Akreditasi</label>
                                <select name="akreditasi" id="akreditasi" class="form-select @error('akreditasi') is-invalid @enderror">
                                    <option value="">Pilih Akreditasi</option>
                                    <option value="A" {{ old('akreditasi', $informasiProgram->akreditasi) == 'A' ? 'selected' : '' }}>A (Unggul)</option>
                                    <option value="B" {{ old('akreditasi', $informasiProgram->akreditasi) == 'B' ? 'selected' : '' }}>B (Baik Sekali)</option>
                                    <option value="C" {{ old('akreditasi', $informasiProgram->akreditasi) == 'C' ? 'selected' : '' }}>C (Baik)</option>
                                    <option value="Baik Sekali" {{ old('akreditasi', $informasiProgram->akreditasi) == 'Baik Sekali' ? 'selected' : '' }}>Baik Sekali</option>
                                    <option value="Baik" {{ old('akreditasi', $informasiProgram->akreditasi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                </select>
                                @error('akreditasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gelar -->
                            <div class="mb-3">
                                <label for="gelar" class="form-label fw-semibold">Gelar <span class="text-danger">*</span></label>
                                <input type="text" name="gelar" id="gelar" 
                                       class="form-control @error('gelar') is-invalid @enderror" 
                                       value="{{ old('gelar', $informasiProgram->gelar) }}" 
                                       placeholder="Contoh: S.Kom, S.E., S.Ak." required>
                                @error('gelar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.informasi-program.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
