{{-- resources/views/admin/agenda/show.blade.php --}}
@extends('admin.layouts.main',['title' => 'Detail Agenda'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h2 class="page-title">Detail Agenda</h2>
                        <p class="card-text">Informasi lengkap agenda</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">
                            <i class="fe fe-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-primary">
                            <i class="fe fe-edit"></i> Edit
                        </a>
                    </div>
                </div>

                <div class="row my-4">
                    <!-- Main Content -->
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <!-- Gambar -->
                                @if($agenda->gambar)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/agenda/' . $agenda->gambar) }}" 
                                         alt="{{ $agenda->judul }}" 
                                         class="img-fluid rounded"
                                         style="width: 100%; max-height: 400px; object-fit: cover;">
                                </div>
                                @endif

                                <!-- Judul & Status -->
                                <div class="mb-4">
                                    <h3 class="mb-2">{{ $agenda->judul }}</h3>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge badge-primary mr-1">
                                            {{ ucfirst(str_replace('_', ' ', $agenda->kategori)) }}
                                        </span>
                                        @if($agenda->status == 'akan_datang')
                                        <span class="badge badge-info mr-1">Akan Datang</span>
                                        @elseif($agenda->status == 'sedang_berlangsung')
                                        <span class="badge badge-success mr-1">Sedang Berlangsung</span>
                                        @else
                                        <span class="badge badge-secondary mr-1">Selesai</span>
                                        @endif
                                        
                                        @if(!$agenda->is_published)
                                        <span class="badge badge-warning mr-1">Draft</span>
                                        @else
                                        <span class="badge badge-success mr-1">Published</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                @if($agenda->deskripsi)
                                <div class="mb-4">
                                    <h5 class="mb-3">Deskripsi</h5>
                                    <p class="text-muted" style="white-space: pre-wrap;">{{ $agenda->deskripsi }}</p>
                                </div>
                                @endif

                                <!-- Info Tambahan -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Informasi Agenda</h5>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <!-- Tanggal -->
                                            <tr>
                                                <td width="30%" class="text-muted">
                                                    <i class="fe fe-calendar"></i> Tanggal
                                                </td>
                                                <td>
                                                    <strong>{{ $agenda->tanggal_mulai->format('d F Y') }}</strong>
                                                    @if($agenda->tanggal_selesai && $agenda->tanggal_mulai != $agenda->tanggal_selesai)
                                                    <br>
                                                    <small class="text-muted">s/d {{ $agenda->tanggal_selesai->format('d F Y') }}</small>
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Waktu -->
                                            @if($agenda->jam_mulai)
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="fe fe-clock"></i> Waktu
                                                </td>
                                                <td>
                                                    <strong>{{ date('H:i', strtotime($agenda->jam_mulai)) }}</strong>
                                                    @if($agenda->jam_selesai)
                                                    - {{ date('H:i', strtotime($agenda->jam_selesai)) }} WIB
                                                    @else
                                                    WIB
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif

                                            <!-- Lokasi -->
                                            @if($agenda->lokasi)
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="fe fe-map-pin"></i> Lokasi
                                                </td>
                                                <td><strong>{{ $agenda->lokasi }}</strong></td>
                                            </tr>
                                            @endif

                                            <!-- Pembicara -->
                                            @if($agenda->pembicara)
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="fe fe-user"></i> Pembicara/Narasumber
                                                </td>
                                                <td><strong>{{ $agenda->pembicara }}</strong></td>
                                            </tr>
                                            @endif

                                            <!-- Views -->
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="fe fe-eye"></i> Total Views
                                                </td>
                                                <td><strong>{{ $agenda->views }}</strong> kali dilihat</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <!-- Quick Actions -->
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong>Quick Actions</strong>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}" 
                                       class="list-group-item list-group-item-action">
                                        <i class="fe fe-edit text-primary"></i>
                                        <span class="ml-2">Edit Agenda</span>
                                    </a>
                                    
                                    <a href="{{ route('frontend.agenda.detail', $agenda->id) }}" 
                                       class="list-group-item list-group-item-action"
                                       target="_blank">
                                        <i class="fe fe-external-link text-success"></i>
                                        <span class="ml-2">Lihat di Frontend</span>
                                    </a>
                                    
                                    <form method="POST" 
                                          action="{{ route('admin.agenda.destroy', $agenda->id) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="list-group-item list-group-item-action text-danger border-0 bg-transparent">
                                            <i class="fe fe-trash-2"></i>
                                            <span class="ml-2">Hapus Agenda</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Metadata -->
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong>Metadata</strong>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">Dibuat pada</small>
                                    <span>{{ $agenda->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">Terakhir diupdate</small>
                                    <span>{{ $agenda->updated_at->format('d M Y, H:i') }}</span>
                                </div>

                                <div>
                                    <small class="text-muted d-block mb-1">Status Publikasi</small>
                                    @if($agenda->is_published)
                                    <span class="badge badge-success">
                                        <i class="fe fe-check-circle"></i> Published
                                    </span>
                                    @else
                                    <span class="badge badge-warning">
                                        <i class="fe fe-clock"></i> Draft
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="card shadow">
                            <div class="card-header">
                                <strong>Statistik</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="text-center p-3 bg-light rounded">
                                            <i class="fe fe-eye fe-24 text-primary mb-2"></i>
                                            <h4 class="mb-0">{{ $agenda->views }}</h4>
                                            <small class="text-muted">Total Views</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection