@extends('layouts.admin')

@section('content')
    <h1>Daftar Sejarah</h1>
    <a href="{{ route('admin.sejarah.create') }}" class="btn btn-primary">Tambah Sejarah</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sejarah as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{!! Str::limit($item->deskripsi, 50) !!}</td>
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" width="100">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.sejarah.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.sejarah.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
