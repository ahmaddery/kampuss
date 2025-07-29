@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">
                    <i class="fas fa-user-shield me-2 text-primary"></i>Admin Profile
                </h1>
                <p class="text-muted mb-0">Manage your account settings and preferences</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-light px-3 py-2 rounded-pill">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>

        <div class="row g-4">
            <!-- Profile Card -->
            <div class="col-xl-4 col-lg-5">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-header bg-gradient-primary text-white text-center py-4 border-0">
                        <div class="position-relative d-inline-block">
                            <div class="avatar-xl position-relative">
                                <img src="{{ asset('storage/' . ($user->profile_picture ?? 'default-profile.jpg')) }}" 
                                     alt="Profile Picture" 
                                     class="avatar-img rounded-circle border border-4 border-white shadow-lg"
                                     style="width: 120px; height: 120px; object-fit: cover;" />
                             <!--    <div class="position-absolute bottom-0 end-0">
                                    <span class="badge bg-success border border-2 border-white rounded-circle p-2">
                                        <i class="fas fa-check"></i>
                                    </span>
                                </div> -->
                            </div>
                        </div>
                        <h4 class="mt-3 mb-1 fw-bold">{{ $user->name }}</h4>
                        <p class="mb-0 opacity-75">
                            <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                        </p>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="text-center p-3 bg-light rounded-3">
                                    <i class="fas fa-calendar-alt text-primary fs-4 mb-2"></i>
                                    <p class="mb-1 small text-muted">Pertama Kali Login</p>
                                    <p class="mb-0 fw-semibold">{{ $user->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3 bg-light rounded-3">
                                    <i class="fas fa-clock text-success fs-4 mb-2"></i>
                                    <p class="mb-1 small text-muted">Terakhir Login</p>
                                    <p class="mb-0 fw-semibold">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Tidak diketahui' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-lg rounded-pill">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </a>
                            <button type="button" class="btn btn-outline-warning btn-lg rounded-pill" 
                                    data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="fas fa-key me-2"></i>Ubah Kata Sandi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="col-xl-8 col-lg-7">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-header bg-white border-0 py-4">
                        <h5 class="mb-0 fw-bold text-gray-800">
                            <i class="fas fa-info-circle me-2 text-info"></i>Informasi Account
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-item p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon-circle bg-primary text-white me-3">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <label class="form-label text-muted mb-0 small">Nama Lengkap</label>
                                            <p class="mb-0 fw-semibold">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="info-item p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon-circle bg-success text-white me-3">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <label class="form-label text-muted mb-0 small">Alamat Email</label>
                                            <p class="mb-0 fw-semibold">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon-circle bg-warning text-white me-3">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div>
                                            <label class="form-label text-muted mb-0 small">Role</label>
                                            <p class="mb-0 fw-semibold">
                                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                                    <i class="fas fa-crown me-1"></i>{{ $user->role }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon-circle bg-info text-white me-3">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                        <div>
                                            <label class="form-label text-muted mb-0 small">Account Dibuat</label>
                                            <p class="mb-0 fw-semibold">{{ $user->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon-circle bg-secondary text-white me-3">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div>
                                            <label class="form-label text-muted mb-0 small">Login Terakhir</label>
                                            <p class="mb-0 fw-semibold">{{ $user->getLastLoginFormatted() }}</p>
                                            <small class="text-muted">{{ $user->getLastLoginRelative() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon-circle bg-purple text-white me-3">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <div>
                                            <label class="form-label text-muted mb-0 small">Akun Terakhir Diupdate</label>
                                            <p class="mb-0 fw-semibold">{{ $user->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                                            <small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="mt-5">
                            <h6 class="fw-bold text-gray-800 mb-3">
                                <i class="fas fa-lock me-2 text-warning"></i>Pengaturan Keamanan
                            </h6>
                            <div class="alert alert-light border-start border-4 border-warning">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-shield-alt text-warning fs-4 me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Keamanan Kata Sandi</h6>
                                        <p class="mb-0 text-muted small">Terakhir Kata Sandi Diubah: {{ $user->password_changed_at ? $user->password_changed_at->diffForHumans() : 'Tidak diketahui' }}</p>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill" 
                                            data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        <i class="fas fa-key me-1"></i>Change
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Change Password -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-gradient-warning text-white border-0">
                        <h5 class="modal-title fw-bold" id="changePasswordModalLabel">
                            <i class="fas fa-key me-2"></i>Change Password
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="alert alert-info border-0 bg-light-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Pilih kata sandi yang kuat dengan setidaknya 8 karakter, termasuk huruf besar, huruf kecil, angka, dan simbol.</small>
                        </div>
                        
                        <form action="{{ route('admin.profile.updatePassword') }}" method="POST" id="passwordForm">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-muted"></i>Kata Sandi Saat Ini

                                </label>
                                <div class="input-group">
                                    <input type="password" name="current_password" id="current_password" 
                                           class="form-control form-control-lg border-2" 
                                           placeholder="Masukkan kata sandi saat ini" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                        <i class="fas fa-eye" id="current_password_icon"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="text-danger mt-1 small">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label fw-semibold">
                                    <i class="fas fa-key me-2 text-muted"></i>Kata Sandi Baru
                                </label>
                                <div class="input-group">
                                    <input type="password" name="new_password" id="new_password" 
                                           class="form-control form-control-lg border-2" 
                                           placeholder="Masukkan kata sandi baru Anda" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                        <i class="fas fa-eye" id="new_password_icon"></i>
                                    </button>
                                </div>
                                <div class="password-strength mt-2">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar" role="progressbar" id="passwordStrength"></div>
                                    </div>
                                    <small class="text-muted" id="passwordStrengthText">Kekuatan kata sandi akan muncul di sini</small>
                                </div>
                                @error('new_password')
                                    <div class="text-danger mt-1 small">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label fw-semibold">
                                    <i class="fas fa-check-double me-2 text-muted"></i>Konfirmasi Kata Sandi Baru
                                </label>
                                <div class="input-group">
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                           class="form-control form-control-lg border-2" 
                                           placeholder="Konfirmasi kata sandi baru Anda" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password_confirmation')">
                                        <i class="fas fa-eye" id="new_password_confirmation_icon"></i>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted" id="passwordMatchText"></small>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light btn-lg rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <button type="submit" form="passwordForm" class="btn btn-warning btn-lg rounded-pill px-4">
                            <i class="fas fa-key me-2"></i>Ubah Kata Sandi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .bg-purple {
        background-color: #6f42c1 !important;
    }
    
    .info-item {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .info-item:hover {
        transform: translateY(-2px);
        border-color: #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .avatar-img {
        transition: all 0.3s ease;
    }
    
    .avatar-img:hover {
        transform: scale(1.05);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }
    
    .progress-bar {
        transition: all 0.3s ease;
    }
    
    .bg-light-info {
        background-color: #e3f2fd !important;
        color: #0d47a1;
    }
    
    .modal-content {
        border-radius: 20px;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        font-weight: bold;
    }
</style>
@endpush

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Konfigurasi toast untuk posisi kanan atas
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        customClass: {
            popup: 'colored-toast'
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Toast untuk pesan sukses
    @if(session('toast_success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('toast_success') }}'
        });
    @endif

    // Toast untuk pesan error
    @if(session('toast_error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('toast_error') }}'
        });
    @endif

    // Konfirmasi sebelum mengubah password
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change your password?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#667eea',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-check me-2"></i>Yes, change it!',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
            reverseButtons: true,
            customClass: {
                popup: 'swal-wide'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Changing Password...',
                    text: 'Please wait while we update your password.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.submit();
            }
        });
    });

    // Password strength checker
    const newPasswordInput = document.getElementById('new_password');
    const passwordConfirmInput = document.getElementById('new_password_confirmation');
    const strengthBar = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('passwordStrengthText');
    const matchText = document.getElementById('passwordMatchText');

    newPasswordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        updatePasswordStrength(strengthBar, strengthText, strength);
        checkPasswordMatch();
    });

    passwordConfirmInput.addEventListener('input', checkPasswordMatch);

    function checkPasswordStrength(password) {
        let score = 0;
        let feedback = [];

        if (password.length >= 8) score += 20;
        else feedback.push('at least 8 characters');

        if (/[a-z]/.test(password)) score += 20;
        else feedback.push('lowercase letters');

        if (/[A-Z]/.test(password)) score += 20;
        else feedback.push('uppercase letters');

        if (/[0-9]/.test(password)) score += 20;
        else feedback.push('numbers');

        if (/[^A-Za-z0-9]/.test(password)) score += 20;
        else feedback.push('special characters');

        return { score, feedback };
    }

    function updatePasswordStrength(bar, text, strength) {
        const { score, feedback } = strength;
        
        bar.style.width = score + '%';
        
        if (score < 40) {
            bar.className = 'progress-bar bg-danger';
            text.textContent = 'Weak password - Add ' + feedback.slice(0, 2).join(', ');
        } else if (score < 80) {
            bar.className = 'progress-bar bg-warning';
            text.textContent = 'Good password - Consider adding ' + feedback.join(', ');
        } else {
            bar.className = 'progress-bar bg-success';
            text.textContent = 'Strong password!';
        }
    }

    function checkPasswordMatch() {
        const password = newPasswordInput.value;
        const confirm = passwordConfirmInput.value;
        
        if (confirm === '') {
            matchText.textContent = '';
            return;
        }
        
        if (password === confirm) {
            matchText.innerHTML = '<i class="fas fa-check text-success me-1"></i><span class="text-success">Passwords match</span>';
        } else {
            matchText.innerHTML = '<i class="fas fa-times text-danger me-1"></i><span class="text-danger">Passwords do not match</span>';
        }
    }
});

// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'fas fa-eye';
    }
}
</script>

<style>
.colored-toast.swal2-icon-success {
    background-color: #a5dc86 !important;
}

.colored-toast.swal2-icon-error {
    background-color: #f27474 !important;
}

.swal-wide {
    width: 32em !important;
}
</style>
@endpush