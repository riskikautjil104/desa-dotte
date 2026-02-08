@extends('layouts.main')

@section('title')
    {{ $dokumen->nama_dokumen }} - {{ config('app.name') }}
@endsection

@section('meta-description')
    {{ $dokumen->deskripsi ?: 'Detail dokumen ' . $dokumen->nama_dokumen }}
@endsection

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => $dokumen->nama_dokumen,
        'subtitle' => 'Detail dokumen desa',
        'breadcrumb' => 'Dokumen',
        'showBreadcrumb' => true,
    ])
@endsection

<!-- ======= Document Detail Section ======= -->
<section id="dokumen-detail" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Document Detail Card --}}
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-body p-4">
                        {{-- Header with Icon --}}
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
                                    <i class="{{ $dokumen->jenisDokumen->icon ?? 'bi bi-file-earmark' }} me-1"></i>
                                    {{ $dokumen->jenisDokumen->nama_jenis ?? 'Lainnya' }}
                                </span>
                                <h3 class="card-title mb-1">{{ $dokumen->nama_dokumen }}</h3>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar me-1"></i>
                                    Dipublikasikan: {{ $dokumen->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        {{-- Description --}}
                        @if ($dokumen->deskripsi)
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">Deskripsi</h5>
                                <p class="text-dark" style="line-height: 1.8;">
                                    {{ $dokumen->deskripsi }}
                                </p>
                            </div>
                        @endif

                        {{-- File Information --}}
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Informasi File</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted small d-block mb-1">Nama File Asli</label>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-earmark me-2" style="color: #0dcdbd;"></i>
                                            <span class="fw-medium">{{ $dokumen->nama_file_asli }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted small d-block mb-1">Ukuran File</label>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-hdd me-2" style="color: #0dcdbd;"></i>
                                            <span class="fw-medium">{{ $dokumen->ukuran_file_formatted }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted small d-block mb-1">Tipe File</label>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-filetype me-2" style="color: #0dcdbd;"></i>
                                            <span class="fw-medium">{{ $dokumen->tipe_file ?? 'Tidak diketahui' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted small d-block mb-1">Total Download</label>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-download me-2" style="color: #0dcdbd;"></i>
                                            <span class="fw-medium">
                                                {{ $dokumen->formatted_download_count }}
                                                <span class="text-muted">kali</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Download Button --}}
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('frontend.dokumen.download', $dokumen->id) }}" 
                               class="btn btn-lg px-5" target="_blank" style="background-color: #0dcdbd; color: white;">
                                <i class="bi bi-download me-2"></i>
                                Download Dokumen
                            </a>
                            <a href="{{ route('frontend.dokumen.index') }}" 
                               class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-arrow-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Related Documents --}}
                @if ($relatedDokumens->count() > 0)
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-files me-2" style="color: #0dcdbd;"></i>
                                Dokumen Terkait
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                @foreach ($relatedDokumens as $related)
                                    <div class="col-md-6">
                                        <a href="{{ route('frontend.dokumen.show', $related->id) }}" 
                                           class="card border-0 shadow-sm text-decoration-none h-100 related-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-box me-3" 
                                                         style="background-color: {{ $related->jenisDokumen->warna ?? '#0dcdbd' }}20;

                                                                width: 45px; height: 45px; border-radius: 10px; 
                                                                display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                        <i class="{{ $related->jenisDokumen->icon ?? 'bi bi-file-earmark' }}" 
                                                           style="font-size: 20px; color: {{ $related->jenisDokumen->warna ?? '#0dcdbd' }}"></i>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h6 class="mb-1 text-dark text-truncate">{{ $related->nama_dokumen }}</h6>
                                                        <small class="text-muted">
                                                            <i class="bi bi-download me-1"></i>
                                                            {{ $related->formatted_download_count }}x
                                                            <span class="mx-2">•</span>
                                                            <i class="bi bi-calendar me-1"></i>
                                                            {{ $related->created_at->format('d M Y') }}
                                                        </small>
                                                    </div>
                                                    <i class="bi bi-chevron-right text-muted ms-2"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-4">
                                <a href="{{ route('frontend.dokumen.index', ['jenis' => $dokumen->jenis_dokumen_id]) }}" 
                                   class="btn btn-sm" style="border-color: #0dcdbd; color: #0dcdbd;">
                                    Lihat Semua {{ $dokumen->jenisDokumen->nama_jenis ?? 'Dokumen' }}
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="sidebar-modern sticky-top" style="top: 100px;">
                    {{-- Quick Stats --}}
                    <div class="sidebar-widget mb-4" data-aos="fade-left">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header text-white border-0 py-3" style="background-color: #0dcdbd;">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-bar-chart me-2"></i>
                                    Statistik
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row text-center">
                                    <div class="col-6 border-end">
                                        <div class="mb-2">
                                            <i class="bi bi-download fs-4" style="color: #0dcdbd;"></i>
                                        </div>
                                        <h4 class="mb-0" style="color: #0dcdbd;">{{ $dokumen->formatted_download_count }}</h4>
                                        <small class="text-muted">Download</small>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <i class="bi bi-file-earmark text-success fs-4"></i>
                                        </div>
                                        <h4 class="mb-0 text-success">{{ $dokumen->ukuran_file_formatted }}</h4>
                                        <small class="text-muted">Ukuran</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Document Info --}}
                    <div class="sidebar-widget mb-4" data-aos="fade-left" data-aos-delay="100">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-success text-white border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Info Dokumen
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 d-flex justify-content-between">
                                        <span class="text-muted">Jenis</span>
                                        <span class="badge" style="background-color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}">
                                            {{ $dokumen->jenisDokumen->nama_jenis ?? '-' }}
                                        </span>
                                    </li>
                                    <li class="mb-2 d-flex justify-content-between">
                                        <span class="text-muted">Status</span>
                                        @if ($dokumen->is_published)
                                            <span class="badge bg-success">Publish</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </li>
                                    <li class="mb-2 d-flex justify-content-between">
                                        <span class="text-muted">Upload</span>
                                        <span>{{ $dokumen->created_at->format('d M Y') }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="text-muted">Update</span>
                                        <span>{{ $dokumen->updated_at->format('d M Y') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Document Types --}}
                    <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="200">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-warning text-dark border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-folder me-2"></i>
                                    Jenis Dokumen
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach (\App\Models\JenisDokumen::all() as $jenis)
                                        <a href="{{ route('frontend.dokumen.index', ['jenis' => $jenis->id]) }}" 
                                           class="btn btn-sm"
                                           style="border-color: {{ $jenis->warna }}; color: {{ $jenis->warna }}; background-color: transparent;">
                                            <i class="{{ $jenis->icon }} me-1"></i>
                                            {{ $jenis->nama_jenis }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Document Card Styles */
    .icon-box {
        transition: transform 0.3s ease;
    }
    
    .card:hover .icon-box {
        transform: scale(1.1);
    }

    /* Related Card */
    .related-card {
        transition: all 0.3s ease;
    }

    .related-card:hover {
        transform: translateY(-3px);
    }

    .related-card:hover .icon-box {
        transform: scale(1.1);
    }

    .sidebar-widget .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.7em;
    }
</style>

@include('layouts.footer')
@endsection
