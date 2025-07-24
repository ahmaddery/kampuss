@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center {{ $status === 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                    <i class="fas {{ $status === 'success' ? 'fa-check' : 'fa-times' }} text-2xl"></i>
                </div>
            </div>
            
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">
                @if($status === 'success')
                    Berhenti Berlangganan Berhasil
                @else
                    Langganan Tidak Ditemukan
                @endif
            </h1>
            
            <div class="text-center text-gray-600 mb-6">
                @if($status === 'success')
                    <p>Anda telah berhasil berhenti berlangganan newsletter kami.</p>
                    <p class="mt-2">Anda tidak akan lagi menerima email newsletter dari kami.</p>
                @else
                    <p>Kami tidak dapat menemukan langganan dengan email yang diberikan.</p>
                    <p class="mt-2">Jika Anda yakin telah berlangganan, silakan hubungi kami untuk bantuan lebih lanjut.</p>
                @endif
            </div>
            
            <div class="flex justify-center">
                <a href="{{ url('/') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection