<!-- resources/views/admin/berita/index.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">Create New Berita</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Publish Date</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($berita as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->publish_date }}</td>
                        <td>{{ $item->author }}</td>
                        <td>
                            <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" style="display:inline;">
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
