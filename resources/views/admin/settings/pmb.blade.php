@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage PMB Section</h1>

        <!-- Menampilkan pesan sukses setelah update status -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Menampilkan pesan error -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tombol untuk mengubah status PMB -->
        <form action="{{ route('admin.settings.toggle.pmb.status') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">
                @if($setting->is_active)
                    Deactivate PMB Section
                @else
                    Activate PMB Section
                @endif
            </button>
        </form>
    </div>
@endsection
