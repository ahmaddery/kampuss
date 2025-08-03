@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="page-inner">
            <!-- Page Header -->
            <div class="page-header mb-4">
                <h3 class="page-title mb-0 fw-bold text-dark">
                    <i class="fas fa-cog me-2"></i> Manage PMB Section
                </h3>
            </div>

            <!-- Main Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <!-- Menampilkan pesan sukses setelah update status -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Menampilkan pesan error -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Current Status Display -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Current PMB Status</h5>
                                    <p class="card-text">
                                        PMB Section is currently: 
                                        @if($setting && $setting->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol untuk mengubah status PMB -->
                    <form action="{{ route('admin.settings.toggle.pmb.status') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-lg">
                            @if($setting && $setting->is_active)
                                <i class="fas fa-toggle-off me-2"></i> Deactivate PMB Section
                            @else
                                <i class="fas fa-toggle-on me-2"></i> Activate PMB Section
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
