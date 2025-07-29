<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Universitas Mercu Buana Yogyakarta</title>
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

        .forgot-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .forgot-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1200px;
            min-height: 600px;
            display: flex;
        }

        .forgot-form-section {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .forgot-image-section {
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

        .forgot-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .forgot-title h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .forgot-subtitle {
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

        .info-box {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #2196f3;
        }

        .info-box h6 {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .info-box p {
            color: #424242;
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
        }

        .btn-forgot {
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

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
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

        .steps-container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .steps-container h6 {
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .step-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #666;
            font-size: 14px;
        }

        .step-number {
            background: #007bff;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            margin-right: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .forgot-card {
                flex-direction: column;
                min-height: auto;
            }

            .forgot-form-section {
                padding: 40px 30px;
            }

            .forgot-image-section {
                display: none;
            }

            .university-name h1 {
                font-size: 20px;
            }

            .university-name .mercubuana {
                font-size: 24px;
            }

            .forgot-title h2 {
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
            .forgot-container {
                padding: 10px;
            }

            .forgot-form-section {
                padding: 30px 20px;
            }

            .university-name h1 {
                font-size: 18px;
            }

            .university-name .mercubuana {
                font-size: 22px;
            }

            .forgot-title h2 {
                font-size: 24px;
            }
        }

        /* Animation */
        .forgot-card {
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
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <!-- Forgot Form Section -->
            <div class="forgot-form-section">
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

                <!-- Forgot Title -->
                <div class="forgot-title">
                    <h2><i class="fas fa-key me-2"></i>LUPA PASSWORD</h2>
                </div>

                <!-- Forgot Subtitle -->
                <div class="forgot-subtitle">
                    Masukkan email Anda untuk menerima link reset password.
                </div>

                <!-- Alerts -->
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Info Box -->
                <div class="info-box">
                    <h6><i class="fas fa-info-circle me-2"></i>Bagaimana cara kerjanya?</h6>
                    <p>Kami akan mengirimkan link reset password ke email Anda. Link tersebut akan berlaku selama 60 menit dan hanya bisa digunakan satu kali.</p>
                </div>

                <!-- Steps Container -->
                <div class="steps-container">
                    <h6><i class="fas fa-list-ol me-2"></i>Langkah-langkah:</h6>
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <span>Masukkan email yang terdaftar</span>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <span>Klik tombol "Kirim Link Reset"</span>
                    </div>
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <span>Cek email Anda dan klik link reset</span>
                    </div>
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <span>Buat password baru yang aman</span>
                    </div>
                </div>

                <!-- Forgot Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" placeholder="Masukkan Email Address" 
                               required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-forgot">
                            <i class="fas fa-paper-plane me-2"></i>
                            Kirim Link Reset
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
            <div class="forgot-image-section">
                <!-- Optional overlay content -->
                <div style="position: absolute; bottom: 30px; left: 30px; color: white;">
                    <h4 style="font-weight: 600; margin-bottom: 10px;">Keamanan Email</h4>
                    <p style="font-size: 14px; opacity: 0.9;">Link reset password akan dikirim ke email Anda</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Add animation to step items
            const stepItems = document.querySelectorAll('.step-item');
            stepItems.forEach((item, index) => {
                item.style.animationDelay = (index * 0.1) + 's';
                item.style.animation = 'fadeIn 0.6s ease-out forwards';
                item.style.opacity = '0';
            });
        });
    </script>
</body>
</html>
