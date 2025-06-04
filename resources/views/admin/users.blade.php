@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage Users</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form untuk menambah pengguna baru -->
        <form action="{{ route('admin.users.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control">
                @error('profile_picture')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>

        <hr>

        <h3>All Users</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="profile" class="avatar-img rounded-circle" style="width: 40px; height: 40px;">
                            @else
                                <img src="{{ asset('storage/default-profile.jpg') }}" alt="profile" class="avatar-img rounded-circle" style="width: 40px; height: 40px;">
                            @endif
                        </td>
                        <td>
                            <!-- Tombol Deactivate dan Reactivate -->
                            @if($user->trashed()) 
                                <!-- Pengguna yang sudah di-soft delete -->
                                <form action="{{ route('admin.users.reactivate', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Reactivate</button>
                                </form>
                            @else
                                <!-- Pengguna yang aktif -->
                                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
