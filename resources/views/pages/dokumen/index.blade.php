@extends('layouts.main')

@section('title')
    Dokumen Desa - {{ config('app.name') }}
@endsection

@section('meta-description')
    Kumpulan dokumen resmi Desa Dotte termasuk peraturan desa, laporan pembangunan, dan dokumen publik lainnya.
@endsection

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Dokumen Desa',
        'subtitle' => 'Kumpulan dokumen resmi Desa Dotte',
        'breadcrumb' => 'Dokumen',
        'showBreadcrumb' => true,
    ])
@endsection

<!-- ======= Dokumen Section ======= -->
<section id="dokumen" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="section-title mb-5">
            <h2 class="fw-bold">Dokumen Desa</h2>
            <p class="text-muted">Kumpulan dokumen resmi Desa Dotte</p>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-file-earmark-text" style="font-size: 2.5rem; color: #0dcdbd;"></i>
                        </div>
                        <h3 class="fw-bold mb-2" style="color: #0dcdbd;">{{ $dokumens->total() }}</h3>
                        <p class="text-muted mb-0">Total Dokumen</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-download text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-success mb-2">{{ number_format(\App\Models\Dokumen::published()->sum('download_count') ?? 0) }}</h3>
                        <p class="text-muted mb-0">Total Download</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-folder text-warning" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-warning mb-2">{{ $jenisDokumens->count() }}</h3>
                        <p class="text-muted mb-0">Jenis Dokumen</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-calendar text-danger" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-danger mb-2">{{ \App\Models\Dokumen::published()->whereDate('created_at', '>=', now()->subDays(30))->count() }}</h3>
                        <p class="text-muted mb-0">Dokumen Baru (30 Hari)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Filter by Jenis Dokumen --}}
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-funnel me-2" style="color: #0dcdbd;"></i>Filter Berdasarkan Jenis
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('frontend.dokumen.index') }}" 
                               class="btn {{ !$jenisDokumenId ? 'active' : '' }}"
                               style="{{ !$jenisDokumenId ? 'background-color: #0dcdbd; color: white; border-color: #0dcdbd;' : 'border-color: #0dcdbd; color: #0dcdbd; background-color: transparent;' }}">
                                <i class="bi bi-collection me-1"></i> Semua
                            </a>
                            @foreach ($jenisDokumens as $jenis)
                                <a href="{{ route('frontend.dokumen.index', ['jenis' => $jenis->id]) }}" 
                                   class="btn {{ $jenisDokumenId == $jenis->id ? 'active' : '' }}"
                                   style="border-color: {{ $jenis->warna }}; color: {{ $jenisDokumenId == $jenis->id ? '#fff' : $jenis->warna }}; background-color: {{ $jenisDokumenId == $jenis->id ? $jenis->warna : 'transparent' }}">
                                    <i class="{{ $jenis->icon }} me-1"></i> {{ $jenis->nama_jenis }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Documents List --}}
                <div class="row g-4">
                    @forelse ($dokumens as $dokumen)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 h-100 document-card">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="icon-box me-3" 
                                             style="background-color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}20; 
                                                    width: 50px; height: 50px; border-radius: 12px; 
                                                    display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="{{ $dokumen->jenisDokumen->icon ?? 'bi bi-file-earmark' }}" 
                                               style="font-size: 24px; color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <span class="badge mb-1" 
                                                  style="background-color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}">
                                                {{ $dokumen->jenisDokumen->nama_jenis ?? 'Lainnya' }}
                                            </span>
                                            <h5 class="card-title mb-0 text-truncate" title="{{ $dokumen->nama_dokumen }}">
                                                {{ $dokumen->nama_dokumen }}
                                            </h5>
                                        </div>
                                    </div>
                                    
                                    @if ($dokumen->deskripsi)
                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($dokumen->deskripsi, 80) }}
                                        </p>
                                    @endif
                                    
                                    {{-- File Info with Download Count --}}
                                    <div class="d-flex flex-wrap gap-3 mb-3">
                                        <small class="text-muted" title="Ukuran File">
                                            <i class="bi bi-hdd me-1"></i>
                                            {{ $dokumen->ukuran_file_formatted }}
                                        </small>
                                        <small class="text-muted" title="Total Download">
                                            <i class="bi bi-download me-1"></i>
                                            {{ $dokumen->formatted_download_count }}x
                                        </small>
                                        <small class="text-muted" title="Tanggal Upload">
                                            <i class="bi bi-calendar me-1"></i>
                                            {{ $dokumen->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    
                                    <div class="d-flex gap-2 mt-auto">
                                        <a href="{{ route('frontend.dokumen.show', $dokumen->id) }}" 
                                           class="btn btn-outline-teal btn-sm flex-grow-1" style="border-color: #0dcdbd; color: #0dcdbd;">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>
                                        <a href="{{ route('frontend.dokumen.download', $dokumen->id) }}" 
                                           class="btn btn-sm flex-grow-1" target="_blank" style="background-color: #0dcdbd; color: white;">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-body text-center py-5">
                                    <i class="bi bi-folder-x text-muted" style="font-size: 64px;"></i>
                                    <h4 class="mt-3 mb-2">Belum Ada Dokumen</h4>
                                    <p class="text-muted mb-3">
                                        @if ($jenisDokumenId)
                                            Tidak ada dokumen untuk jenis yang dipilih.
                                        @else
                                            Saat ini belum ada dokumen yang tersedia.
                                        @endif
                                    </p>
                                    @if ($jenisDokumenId)
                                        <a href="{{ route('frontend.dokumen.index') }}" class="btn" style="background-color: #0dcdbd; color: white;">
                                            <i class="bi bi-arrow-left me-1"></i> Lihat Semua Dokumen
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if ($dokumens->hasPages())
                    <div class="row mt-4">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-0">
                                    {{ $dokumens->links() }}
                                </ul>
                            </nav>
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
                                    <i class="bi bi-info-circle me-2"></i>Informasi
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Total Dokumen</span>
                                    <span class="badge" style="background-color: #0dcdbd;">{{ $dokumens->total() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Total Download</span>
                                    <span class="badge bg-success">{{ number_format(\App\Models\Dokumen::published()->sum('download_count') ?? 0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Jenis Dokumen</span>
                                    <span class="badge bg-warning">{{ $jenisDokumens->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Document Types --}}
                    <div class="sidebar-widget mb-4" data-aos="fade-left" data-aos-delay="100">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-warning text-dark border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-folder me-2"></i>Jenis Dokumen
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($jenisDokumens as $jenis)
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

                    {{-- Popular Documents --}}
                    <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="200">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-success text-white border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-fire me-2"></i>Dokumen Populer
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                @php
                                    $popularDocs = \App\Models\Dokumen::published()
                                        ->orderByDesc('download_count')
                                        ->take(5)
                                        ->get();
                                @endphp
                                @forelse($popularDocs as $doc)
                                    <div class="d-flex align-items-center mb-3 pb-3 {{ $loop->last ? '' : 'border-bottom' }}">
                                        <div class="icon-box me-3" 
                                             style="background-color: {{ $doc->jenisDokumen->warna ?? '#0dcdbd' }}20; 
                                                    width: 40px; height: 40px; border-radius: 10px; 
                                                    display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="{{ $doc->jenisDokumen->icon ?? 'bi bi-file-earmark' }}" 
                                               style="font-size: 18px; color: {{ $doc->jenisDokumen->warna ?? '#0dcdbd' }}"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="mb-1 text-truncate">
                                                <a href="{{ route('frontend.dokumen.show', $doc->id) }}" class="text-decoration-none text-dark">
                                                    {{ $doc->nama_dokumen }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                <i class="bi bi-download me-1"></i>
                                                {{ $doc->formatted_download_count }}x
                                            </small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">Belum ada dokumen</p>
                                @endforelse
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
    .document-card {
        transition: all 0.3s ease;
    }

    .document-card:hover {
        transform: translateY(-5px);
    }

    .icon-box {
        transition: transform 0.3s ease;
    }

    .card:hover .icon-box {
        transform: scale(1.1);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.7em;
    }

    .pagination .page-link {
        border-radius: 8px;
        margin: 0 3px;
        border: none;
        color: #495057;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #0dcdbd;
        color: white;
    }
    
    .pagination .page-link:hover {
        background-color: #e9ecef;
        color: #0dcdbd;
    }

    /* Sidebar widget styles */
    .sidebar-widget .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
</style>

@include('layouts.footer')
@endsection
