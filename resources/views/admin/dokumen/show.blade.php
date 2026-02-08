@extends('admin.layouts.main')

@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection

@section('main')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 text-gray-800 mb-0">📄 Detail Dokumen</h1>
            <small class="text-muted">Informasi lengkap dokumen desa</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('admin.dokumen.download', $dokumen->id) }}" 
               class="btn btn-info shadow-sm" target="_blank">
                <i class="fas fa-download mr-1"></i> Download
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Document Detail Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-file-earmark-text mr-2"></i>
                        {{ $dokumen->nama_dokumen }}
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Header with Icon -->
                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-box me-3" 
                             style="background-color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}20; 
                                    width: 70px; height: 70px; border-radius: 15px; 
                                    display: flex; align-items: center; justify-content: center;">
                            <i class="{{ $dokumen->jenisDokumen->icon ?? 'bi bi-file-earmark' }}" 
                               style="font-size: 32px; color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="badge mb-2" 
                                  style="background-color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}">
                                <i class="{{ $dokumen->jenisDokumen->icon ?? 'bi bi-file-earmark' }} mr-1"></i>
                                {{ $dokumen->jenisDokumen->nama_jenis ?? 'Lainnya' }}
                            </span>
                            <h3 class="card-title mb-1">{{ $dokumen->nama_dokumen }}</h3>
                            <p class="text-muted mb-0">
                                <i class="bi bi-calendar mr-1"></i>
                                Dibuat: {{ $dokumen->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                        <div>
                            @if ($dokumen->is_published)
                                <span class="badge badge-success px-3 py-2">
                                    <i class="fas fa-check-circle mr-1"></i> Publish
                                </span>
                            @else
                                <span class="badge badge-secondary px-3 py-2">
                                    <i class="fas fa-clock mr-1"></i> Draft
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    @if ($dokumen->deskripsi)
                        <div class="mb-4">
                            <h6 class="border-bottom pb-2 mb-3">
                                <i class="bi bi-text-paragraph mr-1"></i> Deskripsi
                            </h6>
                            <p class="text-dark" style="line-height: 1.8;">
                                {{ $dokumen->deskripsi }}
                            </p>
                        </div>
                    @endif

                    <!-- File Information -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="bi bi-info-circle mr-1"></i> Informasi File
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="bi bi-file-earmark mr-1"></i> Nama File Asli
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-medium">{{ $dokumen->nama_file_asli }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="bi bi-hdd mr-1"></i> Ukuran File
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-medium">{{ $dokumen->ukuran_file_formatted }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="bi bi-filetype mr-1"></i> Tipe File
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-medium">{{ $dokumen->tipe_file ?? 'Tidak diketahui' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="bi bi-folder mr-1"></i> Lokasi File
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <code class="small">{{ $dokumen->file_path }}</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="bi bi-bar-chart mr-1"></i> Statistik
                        </h6>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="border rounded py-3 px-2">
                                    <i class="bi bi-download text-primary" style="font-size: 24px;"></i>
                                    <h4 class="mb-0 mt-2 text-primary">{{ $dokumen->formatted_download_count }}</h4>
                                    <small class="text-muted">Total Download</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded py-3 px-2">
                                    <i class="bi bi-calendar-check text-success" style="font-size: 24px;"></i>
                                    <h4 class="mb-0 mt-2 text-success">{{ $dokumen->created_at->format('d M Y') }}</h4>
                                    <small class="text-muted">Tanggal Upload</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded py-3 px-2">
                                    <i class="bi bi-calendar-event text-warning" style="font-size: 24px;"></i>
                                    <h4 class="mb-0 mt-2 text-warning">{{ $dokumen->updated_at->format('d M Y') }}</h4>
                                    <small class="text-muted">Terakhir Diubah</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning mr-2 text-warning"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.dokumen.download', $dokumen->id) }}" 
                           class="btn btn-info" target="_blank">
                            <i class="fas fa-download mr-2"></i> Download File
                        </a>
                        <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit mr-2"></i> Edit Dokumen
                        </a>
                        <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash mr-2"></i> Hapus Dokumen
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Document Info -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle mr-2 text-info"></i>
                        Info Dokumen
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <span class="text-muted">ID:</span>
                            <span class="fw-medium ml-2">{{ $dokumen->id }}</span>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted">Jenis:</span>
                            <span class="badge ml-2" 
                                  style="background-color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}">
                                {{ $dokumen->jenisDokumen->nama_jenis ?? '-' }}
                            </span>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted">Status:</span>
                            @if ($dokumen->is_published)
                                <span class="badge badge-success ml-2">Publish</span>
                            @else
                                <span class="badge badge-secondary ml-2">Draft</span>
                            @endif
                        </li>
                        <li class="mb-2">
                            <span class="text-muted">Download:</span>
                            <span class="fw-medium ml-2">{{ $dokumen->download_count ?? 0 }}x</span>
                        </li>
                        <li>
                            <span class="text-muted">Terakhir Update:</span>
                            <span class="fw-medium ml-2">{{ $dokumen->updated_at->format('d M Y H:i') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Back Button -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
