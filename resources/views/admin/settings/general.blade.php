@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Pengaturan Umum</h1>
            <p class="text-muted">Konfigurasi pengaturan umum aplikasi</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Pengaturan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Umum</li>
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
        <!-- Website Information -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-globe"></i> Informasi Website
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.general.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_name" class="form-label">Nama Website</label>
                                    <input type="text" class="form-control" id="site_name" name="site_name" 
                                           value="{{ old('site_name', $settings['site_name'] ?? 'Universitas Mercu Buana Yogyakarta') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_tagline" class="form-label">Tagline</label>
                                    <input type="text" class="form-control" id="site_tagline" name="site_tagline" 
                                           value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Excellence in Education') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="site_description" class="form-label">Deskripsi Website</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description'] ?? 'Universitas terkemuka di Yogyakarta yang berkomitmen untuk menghasilkan lulusan berkualitas tinggi.') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_email" class="form-label">Email Kontak</label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" 
                                           value="{{ old('contact_email', $settings['contact_email'] ?? 'info@mercubuana-yogya.ac.id') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                                           value="{{ old('contact_phone', $settings['contact_phone'] ?? '(0274) 123456') }}">
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
                        
                        <div class="form-group">
                            <label for="facebook_url" class="form-label">
                                <i class="fab fa-facebook text-primary"></i> Facebook
                            </label>
                            <input type="url" class="form-control" id="facebook_url" name="facebook_url" 
                                   value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" 
                                   placeholder="https://facebook.com/username">
                        </div>

                        <div class="form-group">
                            <label for="instagram_url" class="form-label">
                                <i class="fab fa-instagram text-danger"></i> Instagram
                            </label>
                            <input type="url" class="form-control" id="instagram_url" name="instagram_url" 
                                   value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" 
                                   placeholder="https://instagram.com/username">
                        </div>

                        <div class="form-group">
                            <label for="twitter_url" class="form-label">
                                <i class="fab fa-twitter text-info"></i> Twitter
                            </label>
                            <input type="url" class="form-control" id="twitter_url" name="twitter_url" 
                                   value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}" 
                                   placeholder="https://twitter.com/username">
                        </div>

                        <div class="form-group">
                            <label for="youtube_url" class="form-label">
                                <i class="fab fa-youtube text-danger"></i> YouTube
                            </label>
                            <input type="url" class="form-control" id="youtube_url" name="youtube_url" 
                                   value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" 
                                   placeholder="https://youtube.com/channel/username">
                        </div>

                        <div class="form-group">
                            <label for="tiktok_url" class="form-label">
                                <i class="fab fa-tiktok text-dark"></i> TikTok
                            </label>
                            <input type="url" class="form-control" id="tiktok_url" name="tiktok_url" 
                                   value="{{ old('tiktok_url', $settings['tiktok_url'] ?? '') }}" 
                                   placeholder="https://tiktok.com/@username">
                        </div>

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

    <!-- System Settings -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cogs"></i> Pengaturan Sistem
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.system.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="timezone" class="form-label">Zona Waktu</label>
                                    <select class="form-control" id="timezone" name="timezone">
                                        <option value="Asia/Jakarta" {{ (old('timezone', $settings['timezone'] ?? 'Asia/Jakarta') == 'Asia/Jakarta') ? 'selected' : '' }}>WIB (Asia/Jakarta)</option>
                                        <option value="Asia/Makassar" {{ (old('timezone', $settings['timezone'] ?? '') == 'Asia/Makassar') ? 'selected' : '' }}>WITA (Asia/Makassar)</option>
                                        <option value="Asia/Jayapura" {{ (old('timezone', $settings['timezone'] ?? '') == 'Asia/Jayapura') ? 'selected' : '' }}>WIT (Asia/Jayapura)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="default_language" class="form-label">Bahasa Default</label>
                                    <select class="form-control" id="default_language" name="default_language">
                                        <option value="id" {{ (old('default_language', $settings['default_language'] ?? 'id') == 'id') ? 'selected' : '' }}>Bahasa Indonesia</option>
                                        <option value="en" {{ (old('default_language', $settings['default_language'] ?? '') == 'en') ? 'selected' : '' }}>English</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="items_per_page" class="form-label">Item per Halaman</label>
                                    <select class="form-control" id="items_per_page" name="items_per_page">
                                        <option value="10" {{ (old('items_per_page', $settings['items_per_page'] ?? '10') == '10') ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ (old('items_per_page', $settings['items_per_page'] ?? '') == '25') ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ (old('items_per_page', $settings['items_per_page'] ?? '') == '50') ? 'selected' : '' }}>50</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="maintenance_mode" name="maintenance_mode" value="1" 
                                               {{ old('maintenance_mode', $settings['maintenance_mode'] ?? false) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="maintenance_mode">Mode Pemeliharaan</label>
                                    </div>
                                    <small class="form-text text-muted">Aktifkan untuk menonaktifkan seluruh website (kecuali admin)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="debug_mode" name="debug_mode" value="1" 
                                               {{ old('debug_mode', $settings['debug_mode'] ?? false) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="debug_mode">Mode Debug</label>
                                    </div>
                                    <small class="form-text text-muted">Tampilkan error untuk debugging (hanya untuk development)</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Pengaturan Sistem
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
            alert('Mohon periksa kembali form yang Anda isi.');
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
});
</script>
@endpush
@endsection
