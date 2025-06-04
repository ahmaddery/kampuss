@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Sambutan Rektor</h2>
        <a href="{{ route('admin.sambutan_rektor.create') }}" class="btn btn-primary mb-3">Tambah Sambutan</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sambutan as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{!! Str::limit($item->deskripsi, 100) !!}</td> <!-- Menampilkan HTML secara raw -->
                        <td>
                            @if($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.sambutan_rektor.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
