@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Homepage Banners</h1>

        <a href="{{ route('admin.homepage_banners.create') }}" class="btn btn-primary">Create New Banner</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->description }}</td>
                        <td><img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" width="100"></td>
                        <td>
                            <a href="{{ route('admin.homepage_banners.edit', $banner->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.homepage_banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection