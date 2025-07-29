@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Visi Misi</h4>
                    <div>
                        <a href="{{ route('admin.visi-misi.edit', $visionMission->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.visi-misi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Tipe</th>
                                    <td>
                                        @if($visionMission->type == 'intro')
                                            <span class="badge bg-primary">Intro/Pembuka</span>
                                        @elseif($visionMission->type == 'vision')
                                            <span class="badge bg-success">Visi</span>
                                        @else
                                            <span class="badge bg-warning">Misi</span>
                                        @endif
                                    </td>
                                </tr>
                                
                                @if($visionMission->title)
                                <tr>
                                    <th>Judul</th>
                                    <td>{{ $visionMission->title }}</td>
                                </tr>
                                @endif
                                
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{!! nl2br(e($visionMission->description)) !!}</td>
                                </tr>
                                
                                @if($visionMission->order)
                                <tr>
                                    <th>Urutan</th>
                                    <td><span class="badge bg-primary">{{ $visionMission->order }}</span></td>
                                </tr>
                                @endif
                                
                                @if($visionMission->year_target)
                                <tr>
                                    <th>Target Tahun</th>
                                    <td><span class="badge bg-info">{{ $visionMission->year_target }}</span></td>
                                </tr>
                                @endif
                                
                                <tr>
                                    <th>Dibuat</th>
                                    <td>{{ $visionMission->created_at->format('d F Y H:i') }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Terakhir Diperbarui</th>
                                    <td>{{ $visionMission->updated_at->format('d F Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        @if($visionMission->image_path)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Gambar</h6>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ $visionMission->image_url }}" alt="Image" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <form method="POST" action="{{ route('admin.visi-misi.destroy', $visionMission->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus Data
                                </button>
                            </form>
                            
                            <div>
                                <a href="{{ route('admin.visi-misi.edit', $visionMission->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
