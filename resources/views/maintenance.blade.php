<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dalam Pemeliharaan - Universitas Mercu Buana Yogyakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gradient min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto text-center px-4">
        <!-- Logo/Icon -->
        <div class="float-animation mb-8">
            <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center shadow-lg">
                <i class="fas fa-tools text-4xl text-gray-600"></i>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-lg shadow-xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Sedang Dalam Pemeliharaan
            </h1>
            
            <div class="flex items-center justify-center mb-6">
                <div class="w-16 h-1 bg-blue-500 rounded"></div>
            </div>

            <p class="text-gray-600 mb-6 leading-relaxed">
                Halaman yang Anda tuju sedang dalam proses pemeliharaan untuk meningkatkan kualitas layanan kami.
            </p>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 text-left">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            Kami mohon maaf atas ketidaknyamanan ini. Silakan kembali ke halaman utama.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <a href="{{ url('/') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
            </a>

            <!-- Contact Info -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500 mb-2">Butuh bantuan?</p>
                <p class="text-sm text-gray-600">
                    <i class="fas fa-envelope mr-1"></i>
                    info@mercubuana-yogya.ac.id
                </p>
                <p class="text-sm text-gray-600">
                    <i class="fas fa-phone mr-1"></i>
                    (0274) 123456
                </p>
            </div>
        </div>

        <!-- University Info -->
        <div class="mt-6 text-white text-center">
            <p class="text-sm opacity-80">
                © {{ date('Y') }} Universitas Mercu Buana Yogyakarta
            </p>
        </div>
    </div>

    <script>
        // Auto refresh setiap 30 detik untuk check jika halaman sudah aktif kembali
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>
