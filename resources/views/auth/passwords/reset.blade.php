<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Universitas Mercu Buana Yogyakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .reset-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .reset-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1200px;
            min-height: 600px;
            display: flex;
        }

        .reset-form-section {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .reset-image-section {
            flex: 1;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), 
                        url('https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
        }

        .logo i {
            font-size: 40px;
            color: white;
        }

        .university-name {
            text-align: center;
            margin-bottom: 40px;
        }

        .university-name h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .university-name .universitas {
            color: #28a745;
            font-size: 18px;
        }

        .university-name .mercubuana {
            color: #007bff;
            font-size: 28px;
            font-weight: 800;
        }

        .university-name .yogyakarta {
            color: #007bff;
            font-size: 16px;
        }

        .reset-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .reset-title h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .reset-subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 40px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            background: white;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .password-requirements {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            border-left: 4px solid #007bff;
        }

        .password-requirements h6 {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 20px;
            color: #666;
            font-size: 13px;
        }

        .password-requirements li {
            margin-bottom: 5px;
        }

        .btn-reset {
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #545b62);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #545b62, #3d4449);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(108, 117, 125, 0.3);
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            color: white;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-login a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-to-login a:hover {
            color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .reset-card {
                flex-direction: column;
                min-height: auto;
            }

            .reset-form-section {
                padding: 40px 30px;
            }

            .reset-image-section {
                display: none;
            }

            .university-name h1 {
                font-size: 20px;
            }

            .university-name .mercubuana {
                font-size: 24px;
            }

            .reset-title h2 {
                font-size: 28px;
            }

            .logo {
                width: 60px;
                height: 60px;
            }

            .logo i {
                font-size: 30px;
            }
        }

        @media (max-width: 480px) {
            .reset-container {
                padding: 10px;
            }

            .reset-form-section {
                padding: 30px 20px;
            }

            .university-name h1 {
                font-size: 18px;
            }

            .university-name .mercubuana {
                font-size: 22px;
            }

            .reset-title h2 {
                font-size: 24px;
            }
        }

        /* Animation */
        .reset-card {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
        }

        .strength-weak {
            background: #ffe6e6;
            color: #dc3545;
            border: 1px solid #ffcccc;
        }

        .strength-medium {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .strength-strong {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">
            <!-- Reset Form Section -->
            <div class="reset-form-section">
                <!-- Logo -->
                <div class="logo-container">
                    <div class="logo">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>

                <!-- University Name -->
                <div class="university-name">
                    <h1>
                        <span class="universitas">UNIVERSITAS</span><br>
                        <span class="mercubuana">MERCU BUANA</span><br>
                        <span class="yogyakarta">YOGYAKARTA</span>
                    </h1>
                </div>

                <!-- Reset Title -->
                <div class="reset-title">
                    <h2><i class="fas fa-key me-2"></i>RESET PASSWORD</h2>
                </div>

                <!-- Reset Subtitle -->
                <div class="reset-subtitle">
                    Masukkan email dan password baru Anda untuk mengatur ulang password.
                </div>

                <!-- Alerts -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Password Requirements -->
                <div class="password-requirements">
                    <h6><i class="fas fa-info-circle me-2"></i>Persyaratan Password:</h6>
                    <ul>
                        <li>Minimal 8 karakter</li>
                        <li>Mengandung huruf besar dan kecil</li>
                        <li>Mengandung angka</li>
                        <li>Mengandung karakter khusus (!@#$%^&*)</li>
                    </ul>
                </div>

                <!-- Reset Form -->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address" 
                               required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" placeholder="Password Baru" required autocomplete="new-password">
                        <div id="password-strength" class="password-strength" style="display: none;"></div>
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" 
                               name="password_confirmation" placeholder="Konfirmasi Password Baru" 
                               required autocomplete="new-password">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-reset">
                            <i class="fas fa-save me-2"></i>
                            Reset Password
                        </button>
                    </div>

                    <div class="back-to-login">
                        <a href="{{ route('login') }}">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>

            <!-- Image Section -->
            <div class="reset-image-section">
                <!-- Optional overlay content -->
                <div style="position: absolute; bottom: 30px; left: 30px; color: white;">
                    <h4 style="font-weight: 600; margin-bottom: 10px;">Keamanan Akun</h4>
                    <p style="font-size: 14px; opacity: 0.9;">Pastikan password baru Anda kuat dan aman</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password strength checker
            const passwordInput = document.getElementById('password');
            const strengthIndicator = document.getElementById('password-strength');
            
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = checkPasswordStrength(password);
                
                if (password.length > 0) {
                    strengthIndicator.style.display = 'block';
                    strengthIndicator.className = 'password-strength ' + strength.class;
                    strengthIndicator.innerHTML = '<i class="fas fa-' + strength.icon + ' me-1"></i>' + strength.text;
                } else {
                    strengthIndicator.style.display = 'none';
                }
            });

            function checkPasswordStrength(password) {
                let score = 0;
                let feedback = [];

                if (password.length >= 8) score++;
                if (/[a-z]/.test(password)) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^A-Za-z0-9]/.test(password)) score++;

                if (score <= 2) {
                    return {
                        class: 'strength-weak',
                        text: 'Password lemah',
                        icon: 'times-circle'
                    };
                } else if (score <= 3) {
                    return {
                        class: 'strength-medium',
                        text: 'Password sedang',
                        icon: 'exclamation-triangle'
                    };
                } else {
                    return {
                        class: 'strength-strong',
                        text: 'Password kuat',
                        icon: 'check-circle'
                    };
                }
            }

            // Add focus effects to form inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Add click effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });
    </script>
</body>
</html>
