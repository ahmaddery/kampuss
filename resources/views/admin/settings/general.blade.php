@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Informasi Kontak & Media Sosial</h1>
            <p class="text-muted">Kelola informasi kontak dan media sosial website</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Pengaturan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kontak & Media Sosial</li>
            </ol>
        </nav>
    </div>

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

    <div class="row">
        <!-- Contact Information -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-address-book"></i> Informasi Kontak
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.general.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Kontak</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $settings['email'] ?? 'info@mercubuana-yogya.ac.id') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone" 
                                           value="{{ old('phone', $settings['phone'] ?? '(0274) 123456') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="description" name="description" 
                                           value="{{ old('description', $settings['deskripsi'] ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="operational" class="form-label">Operasional</label>
                                    <input type="text" class="form-control" id="operational" name="operational" 
                                           value="{{ old('operational', $settings['operasional'] ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="2">{{ old('address', $settings['address'] ?? 'Jl. Wates Km 10, Yogyakarta 55753') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Social Media Settings -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-share-alt"></i> Media Sosial
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.social.update') }}">
                        @csrf
                        @method('PUT')
                        
                        @foreach(['facebook', 'instagram', 'twitter', 'youtube', 'tiktok'] as $platform)
                            @php
                                $socialData = $socialMediaList->where('platform', $platform)->first();
                            @endphp
                            <div class="form-group border-bottom pb-3 mb-3">
                                <h6 class="text-uppercase font-weight-bold text-muted mb-3">
                                    <i class="fab fa-{{ $platform }}"></i> {{ ucfirst($platform) }}
                                </h6>
                                
                                <!-- URL -->
                                <div class="form-group">
                                    <label for="{{ $platform }}_url" class="form-label">URL</label>
                                    <input type="url" 
                                           class="form-control" 
                                           id="{{ $platform }}_url"
                                           name="social_media[{{ $platform }}][url]" 
                                           value="{{ old('social_media.'.$platform.'.url', $socialData->url ?? '') }}"
                                           placeholder="https://{{ $platform }}.com/username">
                                </div>
                                
                                <!-- Icon Class -->
                                <div class="form-group">
                                    <label for="{{ $platform }}_icon" class="form-label">Icon Class</label>
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control" 
                                               id="{{ $platform }}_icon"
                                               name="social_media[{{ $platform }}][icon_class]" 
                                               value="{{ old('social_media.'.$platform.'.icon_class', $socialData->icon_class ?? 'fab fa-'.$platform) }}"
                                               placeholder="fab fa-{{ $platform }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text icon-preview-{{ $platform }}">
                                                <i class="{{ old('social_media.'.$platform.'.icon_class', $socialData->icon_class ?? 'fab fa-'.$platform) }}"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="text-muted">Contoh: fab fa-{{ $platform }}, fas fa-link</small>
                                </div>
                                
                                <div class="row">
                                    <!-- Sort Order -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="{{ $platform }}_sort" class="form-label">Urutan</label>
                                            <input type="number" 
                                                   class="form-control" 
                                                   id="{{ $platform }}_sort"
                                                   name="social_media[{{ $platform }}][sort_order]" 
                                                   value="{{ old('social_media.'.$platform.'.sort_order', $socialData->sort_order ?? $loop->iteration) }}"
                                                   min="0" max="100">
                                        </div>
                                    </div>
                                    
                                    <!-- Active Status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" 
                                                       class="custom-control-input" 
                                                       id="{{ $platform }}_active"
                                                       name="social_media[{{ $platform }}][is_active]" 
                                                       value="1"
                                                       {{ old('social_media.'.$platform.'.is_active', $socialData->is_active ?? false) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ $platform }}_active">
                                                    Aktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save"></i> Simpan Media Sosial
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto hide alerts after 5 seconds
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);

// Form validation
$(document).ready(function() {
    $('form').on('submit', function(e) {
        let isValid = true;
        
        // Validate required fields
        $(this).find('input[required], select[required], textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Validate URLs
        $(this).find('input[type="url"]').each(function() {
            if ($(this).val() && !isValidUrl($(this).val())) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang diperlukan dengan benar.');
        }
    });
    
    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;  
        }
    }
    
    // Social media icon preview
    $(document).on('input', 'input[name*="[icon_class]"]', function() {
        const iconClass = $(this).val();
        const inputId = $(this).attr('id');
        const platform = inputId.replace('_icon', '');
        const previewElement = $('.icon-preview-' + platform + ' i');
        
        if (iconClass) {
            previewElement.attr('class', iconClass);
        } else {
            previewElement.attr('class', 'fab fa-' + platform);
        }
    });
});
</script>

<style>
.form-group .border-bottom {
    border-bottom: 1px solid #e3e6f0 !important;
}

.icon-preview {
    display: inline-block;
    width: 20px;
    text-align: center;
}

.icon-preview i {
    font-size: 1.2em;
    color: #5a5c69;
}

.custom-control-label::before {
    border-radius: 0.25rem;
}

.text-muted {
    font-size: 0.875em;
}

.form-group h6 {
    margin-bottom: 0.75rem;
    padding-bottom: 0.25rem;
    border-bottom: 2px solid #f8f9fc;
}
</style>
@endpush

@endsection
