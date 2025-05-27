@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <h6>Homepage Banners</h6>
                                        <p class="card-text">Manage homepage banners and promotional content</p>
                                        <a href="{{ route('admin.homepage_banners.index') }}" class="btn btn-light">Manage Banners</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more quick action cards here as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection