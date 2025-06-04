@extends('layouts.admin')

@section('content')

    <div class="container mt-4">
        <h1 class="text-3xl font-bold mb-6">Daftar Jurusan</h1>

        <!-- Tombol untuk menambah jurusan baru -->
        <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary mb-4">Tambah Jurusan</a>

        <!-- Tabel Jurusan -->
        <div class="overflow-x-auto">
            <table class="table table-striped table-bordered shadow-md rounded-lg">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="px-4 py-2">Jurusan</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurusans as $jurusan)
                        <tr class="border-b">
                            <!-- <td class="text-center px-4 py-2">
                                <img src="" alt="Icon" class="w-[10px] h-[10px] object-contain rounded-full">
                            </td>   -->
                            <td class="px-4 py-2">{{ $jurusan->jurusan }}</td>
                            <td class="px-4 py-2">{{ $jurusan->deskripsi }}</td>
                            <td class="text-center px-4 py-2">
                                <!-- Tautan untuk melihat detail jurusan -->
                                <a href="{{ route('admin.jurusan.show', $jurusan->id) }}" class="btn btn-info btn-sm">Lihat</a>

                                <!-- Tautan untuk mengedit -->
                                <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Formulir untuk menghapus jurusan -->
                                <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
