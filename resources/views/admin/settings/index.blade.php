@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Application Settings</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('admin.settings.pmb') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">PMB Settings</h5>
                                <small><i class="fas fa-arrow-right"></i></small>
                            </div>
                            <p class="mb-1">Manage PMB section activation and settings.</p>
                        </a>
                        
                        <!-- Add more settings sections here as needed -->
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">General Settings</h5>
                                <small class="text-muted">Coming Soon</small>
                            </div>
                            <p class="mb-1">General application settings and configurations.</p>
                        </div>
                        
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Email Settings</h5>
                                <small class="text-muted">Coming Soon</small>
                            </div>
                            <p class="mb-1">Configure email notifications and SMTP settings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
