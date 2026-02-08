@extends('layouts.main')

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.hero')
@endsection


<!-- ======= Sambutan Kepala Desa Section ======= -->
<section class="sambutan-section" data-aos="fade-up">
    <div class="container">
        @foreach ($sambutan_lurah as $sambutan)
            <div class="sambutan-card">
                <div class="row align-items-center g-2">
                    <div class="col-lg-4">
                        <div class="sambutan-image-wrapper" data-aos="fade-right">
                            <div class="sambutan-image-border">
                                <img src="{{ asset('storage/' . $sambutan->gambar_lurah) }}"
                                    alt="{{ $sambutan->nama_lurah }}" class="sambutan-image">
                            </div>
                            <div class="sambutan-badge">
                                <i class="bi bi-person-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="sambutan-content" data-aos="fade-left">
                            <div class="sambutan-label">
                                <i class="bi bi-megaphone-fill"></i>
                                <span>Sambutan</span>
                            </div>
                            <h2 class="sambutan-title">{{ $sambutan->nama_lurah }}</h2>
                            <p class="sambutan-position">Kepala Desa</p>
                            <div class="sambutan-text">
                                <p>{!! Str::limit(strip_tags($sambutan->sambutan_lurah), 350) !!}</p>
                            </div>
                            <a href="{{ route('sambutanlurah', $sambutan->slug) }}" class="sambutan-btn">
                                Baca Selengkapnya
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <div class="sambutan-meta">
                                <span class="meta-date">
                                    <i class="bi bi-calendar-check"></i>
                                    Diperbarui: {{ $sambutan->updated_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- ======= Hero Categories Section ======= -->
<section class="hero-categories" data-aos="fade-up">
    <div class="container">
        <div class="hero-categories-content">
            <div class="text-center mb-5">
                <h2 class="hero-categories-title">Portal Informasi dan Pelayanan Desa<br>Dotte</h2>
                <p class="hero-categories-subtitle">Mulai jelajahi kategori website desa dotte</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Profil -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('visimisi') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-blue">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Profil</h6>
                    </a>
                </div>

                <!-- Infografis -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.data-desa') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-cyan">
                                <i class="bi bi-graph-up"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Infografis</h6>
                    </a>
                </div>

                <!-- UMKM -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.umkm') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-green">
                                <i class="bi bi-shop"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">UMKM</h6>
                    </a>
                </div>

                <!-- Agenda -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.agenda') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-orange">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Agenda</h6>
                    </a>
                </div>

                <!-- Aspirasi -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.aspirasi') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-pink">
                                <i class="bi bi-megaphone"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Aspirasi</h6>
                    </a>
                </div>

                <!-- Statistik -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('jenis_kelamin') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-purple">
                                <i class="bi bi-bar-chart"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Statistik</h6>
                    </a>
                </div>

                <!-- Pelayanan -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('pelayanan') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-yellow">
                                <i class="bi bi-person-check"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Pelayanan</h6>
                    </a>
                </div>

                <!-- Publikasi -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('berita') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-red">
                                <i class="bi bi-newspaper"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Publikasi</h6>
                    </a>
                </div>

                <!-- APBDes -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('apbdes') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-green">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">APBDes</h6>
                    </a>
                </div>

                <!-- Peta Desa / GIS -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('gis.index') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-orange">
                                <i class="bi bi-map"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Peta GIS</h6>
                    </a>
                </div>

                <!-- Bansos -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.bansos') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-teal">
                                <i class="bi bi-gift"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Bansos</h6>
                    </a>
                </div>

                <!-- Surat Online -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.surat-online') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-blue">
                                <i class="bi bi-envelope-paper"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Surat Online</h6>
                    </a>
                </div>

                <!-- Dokumen -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.dokumen.index') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-purple">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Dokumen</h6>
                    </a>
                </div>

                <!-- Perkembangan Penduduk -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('frontend.perkembangan-penduduk') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-cyan">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Perkembangan</h6>
                    </a>
                </div>

                <!-- Galeri -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('galeri') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-pink">
                                <i class="bi bi-images"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Galeri</h6>
                    </a>
                </div>

                <!-- Video -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="{{ route('video') }}" class="category-card-modern">
                        <div class="card-icon-wrapper">
                            <div class="category-icon-modern bg-gradient-red">
                                <i class="bi bi-camera-video"></i>
                            </div>
                        </div>
                        <h6 class="category-title-modern">Video</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= Statistics Section ======= -->
<section class="statistics-section" data-aos="fade-up">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="stat-card stat-card-primary">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlah_penduduk }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="stat-label">Jumlah Penduduk Tetap</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="stat-card stat-card-danger">
                    <div class="stat-icon">
                        <i class="bi bi-gender-female"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlah_perempuan }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="stat-label">Penduduk Perempuan</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="stat-card stat-card-info">
                    <div class="stat-icon">
                        <i class="bi bi-gender-male"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlah_laki_laki }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="stat-label">Penduduk Laki-Laki</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="stat-card stat-card-warning">
                    <div class="stat-icon">
                        <i class="bi bi-house-door"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlah_kk }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="stat-label">Kepala Keluarga</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="stat-card stat-card-success">
                    <div class="stat-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlah_penduduk_sementara }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="stat-label">Penduduk Sementara</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="stat-card stat-card-dark">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $total_penduduk_all }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="stat-label">Total Penduduk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= Mini GIS Map Section ======= -->
<section class="gis-preview-section" data-aos="fade-up">
    <div class="container">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                style="background-color: #0dcdbd; border-radius: 20px 20px 0 0;">
                <div>
                    <h5 class="mb-0"><i class="bi bi-map-fill me-2"></i>Peta Persebaran Wilayah Desa</h5>
                    <small class="text-white-50"> Klik marker untuk melihat detail</small>
                </div>
                <a href="{{ route('gis.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-fullscreen me-1"></i> Peta Penuh
                </a>
            </div>
            <div class="card-body p-0">
                <div id="gisPreviewMap" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</section>

<!-- ======= News Section ======= -->
<section class="news-section" data-aos="fade-up">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Berita Terkini</h2>
            <p class="section-subtitle">Informasi terbaru dari desa kami</p>
        </div>

        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8 order-2 order-lg-1">
                <div class="row g-4">
                    @if ($berita->count())
                        @foreach ($berita as $item)
                            <div class="col-lg-6 col-md-6">
                                <article class="news-card" data-aos="fade-up" data-aos-delay="100">
                                    <div class="news-image-wrapper">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                            class="news-image">
                                        <span class="news-badge">Berita</span>
                                    </div>

                                    <div class="news-content">
                                        <h3 class="news-title">
                                            <a href="{{ route('detail.berita', $item->slug) }}">
                                                {{ $item->judul }}
                                            </a>
                                        </h3>

                                        <div class="news-meta">
                                            <span class="meta-item">
                                                <i class="bi bi-eye"></i> {{ $item->views }}
                                            </span>
                                            <span class="meta-item">
                                                <i class="bi bi-clock"></i>
                                                {{ $item->created_at->format('M d, Y') }}
                                            </span>
                                        </div>

                                        <p class="news-excerpt">
                                            {!! Str::limit(strip_tags($item->excerp), 120) !!}
                                        </p>

                                        <a href="{{ route('detail.berita', $item->slug) }}" class="read-more-btn">
                                            Selengkapnya <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <img src="{{ asset('assets/img/tidakadaberita.svg') }}" width="50%"
                                class="img-fluid mb-4" alt="">
                            <h5 class="text-muted mb-3">Berita Tidak Tersedia</h5>
                            <p class="text-muted">Silakan kunjungi kembali dalam waktu dekat</p>
                            <a class="btn rounded-pill px-4" href="/" style="background-color: #0dcdbd; color: white;">
                                <i class="bi bi-arrow-return-left me-2"></i> Kembali
                            </a>
                        </div>
                    @endif
                </div>

                @if ($berita->count() >= 6)
                    <div class="text-center mt-5">
                        <a href="{{ route('berita') }}" class="btn btn-lg rounded-pill px-5" style="background-color: #0dcdbd; color: white;">
                            Lihat Berita Lainnya <i class="bi bi-arrow-down ms-2"></i>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="sidebar-wrapper sticky-top" style="top: 100px;">

                    {{-- Search Widget --}}
                    <div class="sidebar-widget" data-aos="fade-left">
                        <div class="widget-card">
                            <div class="widget-header">
                                <i class="bi bi-search widget-icon"></i>
                                <h5 class="widget-title">Pencarian</h5>
                            </div>
                            <div class="widget-body">
                                <form action="/" method="get">
                                    <div class="search-input-group">
                                        <input type="text" name="cari-berita" class="search-input"
                                            placeholder="Cari berita..." value="{{ request('cari-berita') }}">
                                        <button type="submit" class="search-btn">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Sambutan Kepala Desa --}}
                    <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="100">
                        <div class="widget-card widget-card-primary">
                            <div class="widget-header-primary">
                                <i class="bi bi-person-circle widget-icon"></i>
                                <h5 class="widget-title">Sambutan Kepala Desa</h5>
                            </div>
                            <div class="widget-body">
                                @foreach ($sambutan_lurah as $sambutan)
                                    <div class="profile-item">
                                        <img src="{{ asset('storage/' . $sambutan->gambar_lurah) }}"
                                            alt="gambar lurah" class="profile-img">
                                        <div class="profile-info">
                                            <h6 class="profile-name">
                                                <a href="{{ route('sambutanlurah', $sambutan->slug) }}">
                                                    {{ $sambutan->nama_lurah }}
                                                </a>
                                            </h6>
                                            <span class="profile-date">
                                                <i class="bi bi-calendar3"></i>
                                                {{ $sambutan->updated_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Recent Posts --}}
                    <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="200">
                        <div class="widget-card">
                            <div class="widget-header">
                                <i class="bi bi-fire widget-icon text-danger"></i>
                                <h5 class="widget-title">Berita Populer</h5>
                            </div>
                            <div class="widget-body">
                                @foreach ($recent_post as $b)
                                    <div class="popular-item {{ $loop->last ? '' : 'border-bottom' }}">
                                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}"
                                            class="popular-img">
                                        <div class="popular-content">
                                            <h6 class="popular-title">
                                                <a href="{{ route('detail.berita', $b->slug) }}">
                                                    {{ Str::limit($b->judul, 50) }}
                                                </a>
                                            </h6>
                                            <span class="popular-date">
                                                <i class="bi bi-calendar3"></i>
                                                {{ $b->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- 
    MODERN HOMEPAGE STYLES - PREMIUM DESIGN
    Optimized for Desktop & Mobile
    Version: 2.0
--}}

<style>
/* ===================================
   CUSTOM PROPERTIES & VARIABLES
   =================================== */
:root {
    /* Brand Colors - Teal Palette */
    --primary: #0dcdbd;
    --primary-dark: #0aaa9a;
    --primary-light: #12e0d0;
    --primary-rgb: 13, 205, 189;
    
    /* Neutral Colors */
    --dark: #1a1d29;
    --dark-alt: #2c3142;
    --gray-900: #212529;
    --gray-700: #495057;
    --gray-500: #6c757d;
    --gray-300: #dee2e6;
    --gray-100: #f8f9fa;
    --white: #ffffff;
    
    /* Accent Colors */
    --blue: #4f9cf9;
    --cyan: #00d4ff;
    --green: #00c48c;
    --orange: #ff7a59;
    --pink: #ff6b9d;
    --purple: #b47aff;
    --yellow: #ffc947;
    --red: #ff5a5f;
    
    /* Shadows */
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
    --shadow-xl: 0 12px 48px rgba(0, 0, 0, 0.15);
    --shadow-primary: 0 8px 24px rgba(var(--primary-rgb), 0.25);
    
    /* Transitions */
    --transition-fast: 0.15s ease;
    --transition-base: 0.3s ease;
    --transition-slow: 0.5s ease;
    --transition-bounce: 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    
    /* Border Radius */
    --radius-sm: 12px;
    --radius-md: 16px;
    --radius-lg: 24px;
    --radius-xl: 32px;
    --radius-full: 9999px;
    
    /* Typography */
    --font-display: 'Outfit', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    --font-body: 'Inter', system-ui, -apple-system, sans-serif;
    
    /* Spacing */
    --section-padding: 100px;
    --section-padding-mobile: 60px;
}

/* ===================================
   GLOBAL STYLES & RESETS
   =================================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    overflow-x: hidden;
}

body {
    font-family: var(--font-body);
    color: var(--gray-900);
    line-height: 1.7;
    overflow-x: hidden;
    background: var(--white);
}

img {
    max-width: 100%;
    height: auto;
    display: block;
}

a {
    text-decoration: none;
    transition: var(--transition-base);
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: var(--gray-100);
}

::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: var(--radius-full);
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}

/* Selection */
::selection {
    background: var(--primary);
    color: var(--white);
}

/* ===================================
   CAROUSEL CONTROLS - ENHANCED
   =================================== */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 56px !important;
    height: 56px !important;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px);
    border-radius: 50%;
    box-shadow: var(--shadow-lg);
    transition: var(--transition-base);
}

.carousel-control-prev:hover .carousel-control-prev-icon,
.carousel-control-next:hover .carousel-control-next-icon {
    background: var(--white) !important;
    transform: scale(1.1);
    box-shadow: var(--shadow-xl);
}

.carousel-control-prev-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230dcdbd'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e") !important;
}

.carousel-control-next-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230dcdbd'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
}

/* ===================================
   SAMBUTAN KEPALA DESA - REDESIGNED
   =================================== */
.sambutan-section {
    padding: var(--section-padding) 0;
    background: linear-gradient(180deg, var(--gray-100) 0%, var(--white) 100%);
    position: relative;
    overflow: hidden;
}

.sambutan-section::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(var(--primary-rgb), 0.08) 0%, transparent 70%);
    top: -200px;
    right: -200px;
    border-radius: 50%;
    pointer-events: none;
}

.sambutan-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 3.5rem;
    box-shadow: var(--shadow-lg);
    position: relative;
    overflow: hidden;
    transition: var(--transition-base);
}

.sambutan-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, transparent 0%, rgba(var(--primary-rgb), 0.02) 100%);
    opacity: 0;
    transition: var(--transition-base);
}

.sambutan-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.sambutan-card:hover::before {
    opacity: 1;
}

.sambutan-image-wrapper {
    position: relative;
}

.sambutan-image-border {
    position: relative;
    padding: 8px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-primary);
    overflow: hidden;
}

.sambutan-image-border::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
    pointer-events: none;
}

.sambutan-image {
    width: 100%;
    max-width: 320px;
    height: 380px;
    object-fit: cover;
    border-radius: calc(var(--radius-lg) - 8px);
    display: block;
}

.sambutan-badge {
    position: absolute;
    top: -20px;
    right: 12%;
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-primary);
    border: 5px solid var(--white);
    animation: pulse-badge 2s ease-in-out infinite;
}

@keyframes pulse-badge {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.sambutan-badge i {
    font-size: 2rem;
    color: var(--white);
}

.sambutan-content {
    padding-left: 2.5rem;
}

.sambutan-label {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: var(--white);
    padding: 10px 24px;
    border-radius: var(--radius-full);
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-primary);
}

.sambutan-title {
    font-family: var(--font-display);
    font-size: 3rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 0.75rem;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.sambutan-position {
    font-size: 1.4rem;
    color: var(--primary);
    font-weight: 700;
    margin-bottom: 2rem;
    font-family: var(--font-display);
}

.sambutan-text {
    color: var(--gray-700);
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2.5rem;
}

.sambutan-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: var(--white);
    padding: 16px 36px;
    border-radius: var(--radius-full);
    font-weight: 700;
    font-size: 1.05rem;
    box-shadow: var(--shadow-primary);
    transition: var(--transition-base);
}

.sambutan-btn:hover {
    transform: translateX(8px);
    box-shadow: 0 12px 32px rgba(var(--primary-rgb), 0.35);
    color: var(--white);
}

.sambutan-meta {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid var(--gray-100);
}

.meta-date {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--gray-500);
    font-size: 1rem;
    font-weight: 600;
}

.meta-date i {
    color: var(--primary);
    font-size: 1.1rem;
}

/* ===================================
   HERO CATEGORIES - GLASS MORPHISM
   =================================== */
.hero-categories {
    padding: var(--section-padding) 0;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 50%, var(--primary-light) 100%);
    position: relative;
    overflow: hidden;
}

.hero-categories::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(59, 195, 248, 0.378) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(28, 200, 226, 0.409) 0%, transparent 50%);
}

.hero-categories::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(30deg, rgba(255, 255, 255, 0.109) 12%, transparent 12.5%, transparent 87%, rgba(255, 255, 255, 0.1) 87.5%, rgba(160, 236, 248, 0.15)),
        linear-gradient(150deg, rgba(255, 255, 255, 0.153) 12%, transparent 12.5%, transparent 87%, rgba(255, 255, 255, 0.121) 87.5%, rgba(142, 221, 255, 0.1));
    background-size: 80px 140px;
}

.hero-categories-content {
    position: relative;
    z-index: 1;
}

.hero-categories-title {
    font-family: var(--font-display);
    color: var(--white);
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    line-height: 1.2;
    letter-spacing: -0.02em;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.212);
}

.hero-categories-subtitle {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.25rem;
    font-weight: 500;
}

/* Glass Morphism Category Cards */
.category-card-modern {
    display: block;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-lg);
    padding: 1.75rem 1.25rem;
    text-align: center;
    transition: var(--transition-bounce);
    height: 100%;
    position: relative;
    overflow: hidden;
}

.category-card-modern::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(240, 33, 33, 0.1) 0%, transparent 100%);
    opacity: 0;
    transition: var(--transition-base);
}

.category-card-modern:hover {
    transform: translateY(-12px) scale(1.02);
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.4);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.category-card-modern:hover::before {
    opacity: 1;
}

.card-icon-wrapper {
    margin-bottom: 1.25rem;
}

.category-icon-modern {
    width: 90px;
    height: 90px;
    margin: 0 auto;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.75rem;
    color: var(--white);
    transition: var(--transition-bounce);
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
}

.category-icon-modern::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
}

.category-card-modern:hover .category-icon-modern {
    transform: scale(1.15) rotate(-5deg);
}

.category-title-modern {
    color: var(--white);
    font-weight: 700;
    font-size: 1.05rem;
    margin: 0;
    line-height: 1.4;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

/* Modern Gradient Colors */
.bg-gradient-blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.bg-gradient-cyan { background: linear-gradient(135deg, #6dd5ed 0%, #2193b0 100%); }
.bg-gradient-green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
.bg-gradient-orange { background: linear-gradient(135deg, #fc4a1a 0%, #f7b733 100%); }
.bg-gradient-pink { background: linear-gradient(135deg, #f857a6 0%, #ff5858 100%); }
.bg-gradient-purple { background: linear-gradient(135deg, #a8c0ff 0%, #3f2b96 100%); }
.bg-gradient-yellow { background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%); }
.bg-gradient-red { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); }
.bg-gradient-teal { background: linear-gradient(135deg, #0ba360 0%, #3cba92 100%); }

/* ===================================
   STATISTICS - MODERN CARDS
   =================================== */
.statistics-section {
    padding: var(--section-padding) 0;
    background: linear-gradient(180deg, var(--white) 0%, var(--gray-100) 100%);
}

.stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2.5rem;
    display: flex;
    align-items: center;
    gap: 2rem;
    box-shadow: var(--shadow-md);
    transition: var(--transition-base);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(var(--primary-rgb), 0.03) 100%);
    opacity: 0;
    transition: var(--transition-base);
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.stat-card:hover::before {
    opacity: 1;
}

.stat-icon {
    width: 90px;
    height: 90px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}

.stat-icon::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
}

.stat-card-primary .stat-icon { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: var(--white); }
.stat-card-danger .stat-icon { background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: var(--white); }
.stat-card-info .stat-icon { background: linear-gradient(135deg, #4fc3f7 0%, #29b6f6 100%); color: var(--white); }
.stat-card-warning .stat-icon { background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%); color: var(--white); }
.stat-card-success .stat-icon { background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%); color: var(--white); }
.stat-card-dark .stat-icon { background: linear-gradient(135deg, var(--dark) 0%, var(--dark-alt) 100%); color: var(--white); }

.stat-card-primary:hover { border-color: var(--primary); }
.stat-card-danger:hover { border-color: #ff6b6b; }
.stat-card-info:hover { border-color: #4fc3f7; }
.stat-card-warning:hover { border-color: #ffa726; }
.stat-card-success:hover { border-color: #66bb6a; }
.stat-card-dark:hover { border-color: var(--dark); }

.stat-content {
    flex: 1;
}

.stat-number {
    font-family: var(--font-display);
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 0.5rem 0;
    color: var(--dark);
    line-height: 1;
}

.stat-label {
    font-size: 1.05rem;
    color: var(--gray-700);
    margin: 0;
    font-weight: 600;
}

/* ===================================
   NEWS SECTION - MODERN DESIGN
   =================================== */
.news-section {
    padding: var(--section-padding) 0;
    background: var(--white);
}

.section-header {
    margin-bottom: 4rem;
}

.section-title {
    font-family: var(--font-display);
    font-size: 3rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.section-subtitle {
    font-size: 1.25rem;
    color: var(--gray-700);
    font-weight: 500;
}

/* Modern News Cards */
.news-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: var(--transition-base);
    height: 100%;
    border: 2px solid transparent;
}

.news-card:hover {
    transform: translateY(-12px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary);
}

.news-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 240px;
    background: var(--gray-100);
}

.news-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.news-card:hover .news-image {
    transform: scale(1.08);
}

.news-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: var(--white);
    padding: 10px 24px;
    border-radius: var(--radius-full);
    font-size: 0.9rem;
    font-weight: 700;
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-primary);
}

.news-content {
    padding: 2rem;
}

.news-title {
    font-family: var(--font-display);
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: 1.25rem;
    line-height: 1.4;
}

.news-title a {
    color: var(--dark);
    transition: var(--transition-base);
}

.news-title a:hover {
    color: var(--primary);
}

.news-meta {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1.25rem;
    font-size: 0.95rem;
}

.meta-item {
    color: var(--gray-500);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
}

.news-excerpt {
    color: var(--gray-700);
    margin-bottom: 1.5rem;
    line-height: 1.7;
}

.read-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--primary);
    font-weight: 700;
    font-size: 1rem;
    transition: var(--transition-base);
}

.read-more-btn:hover {
    gap: 1rem;
    color: var(--primary-dark);
}

/* ===================================
   SIDEBAR - MODERN WIDGETS
   =================================== */
.sidebar-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.widget-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: var(--transition-base);
}

.widget-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.widget-header {
    padding: 1.75rem 2rem;
    border-bottom: 2px solid var(--gray-100);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.widget-icon {
    font-size: 1.5rem;
    color: var(--primary);
}

.widget-title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    color: var(--dark);
}

.widget-body {
    padding: 2rem;
}

/* Search Widget */
.search-input-group {
    display: flex;
    border-radius: var(--radius-full);
    overflow: hidden;
    background: var(--gray-100);
    border: 2px solid transparent;
    transition: var(--transition-base);
}

.search-input-group:focus-within {
    border-color: var(--primary);
    background: var(--white);
}

.search-input {
    flex: 1;
    padding: 14px 24px;
    border: none;
    background: transparent;
    outline: none;
    font-size: 1rem;
    font-weight: 500;
}

.search-btn {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: var(--white);
    border: none;
    padding: 14px 28px;
    cursor: pointer;
    transition: var(--transition-base);
    font-size: 1.1rem;
}

.search-btn:hover {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
}

/* Widget Card Primary */
.widget-card-primary {
    border: 2px solid var(--primary);
}

.widget-header-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: var(--white);
    padding: 1.75rem 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.widget-header-primary .widget-icon,
.widget-header-primary .widget-title {
    color: var(--white);
}

/* Profile Item */
.profile-item {
    display: flex;
    gap: 1.25rem;
    align-items: center;
}

.profile-img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--gray-100);
}

.profile-info {
    flex: 1;
}

.profile-name {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    font-weight: 700;
}

.profile-name a {
    color: var(--dark);
    transition: var(--transition-base);
}

.profile-name a:hover {
    color: var(--primary);
}

.profile-date {
    font-size: 0.9rem;
    color: var(--gray-500);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
}

/* Popular Item */
.popular-item {
    display: flex;
    gap: 1.25rem;
    padding-bottom: 1.25rem;
    margin-bottom: 1.25rem;
    border-bottom: 2px solid var(--gray-100);
}

.popular-item:last-child {
    padding-bottom: 0;
    margin-bottom: 0;
    border-bottom: none;
}

.popular-img {
    width: 90px;
    height: 90px;
    border-radius: var(--radius-sm);
    object-fit: cover;
    flex-shrink: 0;
}

.popular-content {
    flex: 1;
}

.popular-title {
    margin: 0 0 0.75rem 0;
    font-size: 1.05rem;
    font-weight: 700;
    line-height: 1.4;
}

.popular-title a {
    color: var(--dark);
    transition: var(--transition-base);
}

.popular-title a:hover {
    color: var(--primary);
}

.popular-date {
    font-size: 0.9rem;
    color: var(--gray-500);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
}

/* ===================================
   GIS PREVIEW SECTION
   =================================== */
.gis-preview-section {
    padding: var(--section-padding) 0;
    background: var(--gray-100);
}

.gis-preview-section .card {
    border: none;
    box-shadow: var(--shadow-lg);
    border-radius: var(--radius-xl) !important;
}

.gis-preview-section .card-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%) !important;
    padding: 2rem;
    border-radius: var(--radius-xl) var(--radius-xl) 0 0 !important;
}

.gis-preview-section .card-header h5 {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1.5rem;
}

.gis-preview-section .btn-light {
    background: var(--white);
    border: none;
    padding: 12px 24px;
    border-radius: var(--radius-full);
    font-weight: 700;
    transition: var(--transition-base);
}

.gis-preview-section .btn-light:hover {
    background: var(--gray-100);
    transform: scale(1.05);
}

/* ===================================
   RESPONSIVE DESIGN - MOBILE FIRST
   =================================== */

/* Large Tablets & Small Desktops */
@media (max-width: 1199px) {
    :root {
        --section-padding: 80px;
    }
    
    .sambutan-title { font-size: 2.5rem; }
    .hero-categories-title,
    .section-title { font-size: 2.5rem; }
    .stat-number { font-size: 2.5rem; }
}

/* Tablets */
@media (max-width: 991px) {
    :root {
        --section-padding: 70px;
    }
    
    .sambutan-content { padding-left: 0; margin-top: 2rem; }
    .sidebar-wrapper { margin-top: 3rem; }
    .sidebar-wrapper.sticky-top { position: relative !important; top: 0 !important; }
}

/* Mobile Landscape */
@media (max-width: 768px) {
    :root {
        --section-padding: var(--section-padding-mobile);
    }
    
    /* Carousel */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 48px !important;
        height: 48px !important;
    }
    
    /* Sambutan */
    .sambutan-section { padding: 60px 0; }
    .sambutan-card { padding: 2rem; border-radius: var(--radius-lg); }
    .sambutan-image { max-width: 100%; height: 300px; }
    .sambutan-title { font-size: 2rem; }
    .sambutan-position { font-size: 1.2rem; }
    .sambutan-text { font-size: 1rem; }
    .sambutan-btn { padding: 14px 28px; font-size: 0.95rem; }
    .sambutan-badge { width: 60px; height: 60px; }
    .sambutan-badge i { font-size: 1.75rem; }
    
    /* Hero Categories */
    .hero-categories { padding: 60px 0; }
    .hero-categories-title { font-size: 2rem; }
    .hero-categories-subtitle { font-size: 1.1rem; }
    .category-card-modern { padding: 1.5rem 1rem; }
    .category-icon-modern { width: 75px; height: 75px; font-size: 2.25rem; }
    .category-title-modern { font-size: 0.95rem; }
    
    /* Statistics */
    .stat-card { padding: 1.75rem; }
    .stat-icon { width: 70px; height: 70px; font-size: 2.25rem; }
    .stat-number { font-size: 2rem; }
    .stat-label { font-size: 0.95rem; }
    
    /* News */
    .section-header { margin-bottom: 3rem; }
    .section-title { font-size: 2rem; }
    .section-subtitle { font-size: 1.1rem; }
    .news-image-wrapper { height: 220px; }
    .news-content { padding: 1.5rem; }
    .news-title { font-size: 1.2rem; }
    
    /* GIS */
    .gis-preview-section .card-header { padding: 1.5rem; }
    .gis-preview-section .card-header h5 { font-size: 1.2rem; }
    #gisPreviewMap { height: 320px !important; }
}

/* Mobile Portrait */
@media (max-width: 576px) {
    :root {
        --section-padding-mobile: 50px;
    }
    
    /* Carousel */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 42px !important;
        height: 42px !important;
    }
    
    /* Sambutan */
    .sambutan-section { padding: 50px 0; }
    .sambutan-card { padding: 1.5rem; }
    .sambutan-image { height: 280px; }
    .sambutan-title { font-size: 1.75rem; }
    .sambutan-position { font-size: 1.1rem; }
    .sambutan-text { font-size: 0.95rem; }
    .sambutan-btn { padding: 12px 24px; font-size: 0.9rem; }
    .sambutan-badge { width: 55px; height: 55px; top: -15px; }
    .sambutan-badge i { font-size: 1.5rem; }
    
    /* Hero Categories */
    .hero-categories { padding: 50px 0; }
    .hero-categories-title { font-size: 1.65rem; }
    .hero-categories-subtitle { font-size: 1rem; }
    .category-card-modern { padding: 1.25rem 0.75rem; }
    .category-icon-modern { width: 65px; height: 65px; font-size: 2rem; }
    .category-title-modern { font-size: 0.85rem; }
    
    /* Statistics */
    .stat-card { padding: 1.5rem; gap: 1.25rem; }
    .stat-icon { width: 60px; height: 60px; font-size: 2rem; }
    .stat-number { font-size: 1.75rem; }
    .stat-label { font-size: 0.9rem; }
    
    /* News */
    .section-title { font-size: 1.75rem; }
    .section-subtitle { font-size: 1rem; }
    .news-image-wrapper { height: 200px; }
    .news-content { padding: 1.25rem; }
    .news-title { font-size: 1.1rem; }
    .news-meta { font-size: 0.85rem; gap: 1rem; }
    .news-excerpt { font-size: 0.95rem; }
    .read-more-btn { font-size: 0.9rem; }
    
    /* Sidebar */
    .widget-header, .widget-header-primary { padding: 1.25rem 1.5rem; }
    .widget-title { font-size: 1.1rem; }
    .widget-body { padding: 1.5rem; }
    .profile-img { width: 65px; height: 65px; }
    .profile-name { font-size: 1rem; }
    .popular-img { width: 75px; height: 75px; }
    .popular-title { font-size: 0.95rem; }
    
    /* GIS */
    .gis-preview-section .card-header { padding: 1.25rem; }
    .gis-preview-section .card-header h5 { font-size: 1.05rem; }
    #gisPreviewMap { height: 280px !important; }
}

/* Extra Small Mobile */
@media (max-width: 420px) {
    .hero-categories-title { font-size: 1.5rem; }
    .sambutan-title { font-size: 1.5rem; }
    .section-title { font-size: 1.5rem; }
    .category-icon-modern { width: 60px; height: 60px; font-size: 1.75rem; }
    .category-title-modern { font-size: 0.8rem; }
}

/* ===================================
   ANIMATIONS & MICRO-INTERACTIONS
   =================================== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-40px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(40px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Staggered Animation Delays */
.news-card {
    animation: fadeInUp 0.6s ease backwards;
}

.news-card:nth-child(1) { animation-delay: 0.1s; }
.news-card:nth-child(2) { animation-delay: 0.2s; }
.news-card:nth-child(3) { animation-delay: 0.3s; }
.news-card:nth-child(4) { animation-delay: 0.4s; }

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* ===================================
   UTILITY CLASSES
   =================================== */
.container {
    max-width: 100%;
    overflow-x: hidden;
}

/* Prevent Horizontal Scroll */
html, body {
    overflow-x: hidden;
    position: relative;
}

section {
    overflow-x: hidden;
}

/* Loading States */
.loading-skeleton {
    background: linear-gradient(90deg, var(--gray-100) 25%, var(--gray-200) 50%, var(--gray-100) 75%);
    background-size: 200% 100%;
    animation: loading 1.5s ease-in-out infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Focus Visible States */
*:focus-visible {
    outline: 3px solid var(--primary);
    outline-offset: 2px;
    border-radius: 4px;
}

/* Print Styles */
@media print {
    .hero-categories,
    .sidebar-wrapper,
    .sambutan-btn,
    .read-more-btn,
    .search-input-group {
        display: none;
    }
    
    .news-card,
    .stat-card {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid var(--gray-300);
    }
}
</style>

{{-- <style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background: rgba(0, 0, 0, 0.3) !important;
        border-radius: 50%;
        width: 50px !important;
        height: 50px !important;
        background-size: 50% 50% !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        backdrop-filter: blur(4px);
    }

    .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e") !important;
    }

    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
    }

    /* Mobile responsive untuk carousel arrows */
    @media (max-width: 768px) {

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 40px !important;
            height: 40px !important;
            background: rgba(0, 0, 0, 0.4) !important;
        }
    }

    @media (max-width: 480px) {

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 36px !important;
            height: 36px !important;
            background-size: 40% 40% !important;
        }
    }

    /* ==================== SAMBUTAN KEPALA DESA SECTION ==================== */
    .sambutan-section {
        /* padding: 80px 0; */
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .sambutan-section::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, rgba(13, 205, 189, 0.05) 0%, rgba(10, 170, 154, 0.05) 100%);
        border-radius: 50%;
        z-index: 0;
    }

    .sambutan-section::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 500px;
        height: 500px;
        background: linear-gradient(135deg, rgba(13, 205, 189, 0.03) 0%, rgba(10, 170, 154, 0.03) 100%);
        border-radius: 50%;
        z-index: 0;
    }

    .sambutan-card {
        background: white;
        border-radius: 30px;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        position: relative;
        z-index: 1;
        border: 2px solid transparent;
        transition: all 0.4s ease;
    }

    .sambutan-card:hover {
        border-color: #0dcdbd;
        box-shadow: 0 15px 50px rgba(13, 205, 189, 0.15);
        transform: translateY(-5px);
    }

    .sambutan-image-wrapper {
        position: relative;
        text-align: center;
    }

    .sambutan-image-border {
        position: relative;
        display: inline-block;
        padding: 10px;
            background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);

        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(13, 205, 189, 0.3);
    }

    .sambutan-image {
        width: 100%;
        max-width: 300px;
        height: 350px;
        object-fit: cover;
        border-radius: 25px;
        display: block;
    }

    .sambutan-badge {
        position: absolute;
        top: -15px;
        right: 10%;
        width: 60px;
        height: 60px;
            background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);

        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(13, 205, 189, 0.4);
        border: 4px solid white;
    }

    .sambutan-badge i {
        font-size: 1.75rem;
        color: white;
    }

    .sambutan-content {
        padding-left: 2rem;
    }

    .sambutan-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
           background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);

        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .sambutan-label i {
        font-size: 1rem;
    }

    .sambutan-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .sambutan-position {
        font-size: 1.25rem;
        color: #0dcdbd;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .sambutan-text {
        color: #6c757d;
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 2rem;
    }

    .sambutan-text p {
        margin: 0;
    }

    .sambutan-btn {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);
        color: white;
        padding: 14px 32px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(13, 205, 189, 0.3);
    }

    .sambutan-btn:hover {
        transform: translateX(5px);
        box-shadow: 0 6px 20px rgba(13, 205, 189, 0.4);
        color: white;
    }

    .sambutan-meta {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e9ecef;
    }

    .meta-date {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #6c757d;
        font-size: 0.95rem;
    }

    .meta-date i {
        color: #0dcdbd;
        font-size: 1rem;
    }

    /* ==================== HERO CATEGORIES SECTION ==================== */
    .hero-categories {
            background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);

        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .hero-categories::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .hero-categories-content {
        position: relative;
        z-index: 1;
    }

    .hero-categories-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .hero-categories-subtitle {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.15rem;
    }

    /* Modern Category Cards */
    .category-card-modern {
        display: block;
        text-decoration: none;
        background: white;
        border-radius: 20px;
        padding: 1.5rem 1rem;
        text-align: center;
        border: 2px solid transparent;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .category-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(13, 205, 189, 0.2);
        border-color: #0dcdbd;
    }

    .card-icon-wrapper {
        margin-bottom: 1rem;
    }

    .category-icon-modern {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        transition: all 0.3s ease;
    }

    .category-card-modern:hover .category-icon-modern {
        transform: scale(1.1) rotate(5deg);
    }

    .category-title-modern {
        color: #212529;
        font-weight: 600;
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    /* Gradient Colors */
    .bg-gradient-blue {
        background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);
    }

    .bg-gradient-cyan {
        background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
    }

    .bg-gradient-green {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .bg-gradient-orange {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .bg-gradient-pink {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
    }

    .bg-gradient-purple {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }

    .bg-gradient-yellow {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }

    .bg-gradient-red {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .bg-gradient-teal {
        background: linear-gradient(135deg, #0dcaf0 0%, #20c997 100%);
    }

    /* ==================== STATISTICS SECTION ==================== */
    .statistics-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .stat-card-primary:hover {
        border-color: #0dcdbd;
    }

    .stat-card-danger:hover {
        border-color: #dc3545;
    }

    .stat-card-info:hover {
        border-color: #0dcaf0;
    }

    .stat-card-warning:hover {
        border-color: #ffc107;
    }

    .stat-card-success:hover {
        border-color: #198754;
    }

    .stat-card-dark:hover {
        border-color: #212529;
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        flex-shrink: 0;
    }

    .stat-card-primary .stat-icon {
        background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);
        color: white;
    }

    .stat-card-danger .stat-icon {
        background: linear-gradient(135deg, #dc3545 0%, #bb2d3b 100%);
        color: white;
    }

    .stat-card-info .stat-icon {
        background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
        color: white;
    }

    .stat-card-success .stat-icon {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        color: white;
    }

    .stat-card-dark .stat-icon {
        background: linear-gradient(135deg, #212529 0%, #495057 100%);
        color: white;
    }

    .stat-content {
        flex: 1;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0 0 0.25rem 0;
        color: #212529;
    }

    .stat-label {
        font-size: 1rem;
        color: #6c757d;
        margin: 0;
        font-weight: 500;
    }

    /* ==================== NEWS SECTION ==================== */
    .news-section {
        padding: 80px 0;
        background: white;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
    }

    /* News Cards */
    .news-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }

    .news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        border-color: #0dcdbd;
    }

    .news-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .news-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .news-card:hover .news-image {
        transform: scale(1.1);
    }

    .news-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(13, 205, 189, 0.95);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .news-content {
        padding: 1.5rem;
    }

    .news-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .news-title a {
        color: #212529;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .news-title a:hover {
        color: #0dcdbd;
    }

    .news-meta {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .meta-item {
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .news-excerpt {
        color: #6c757d;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #0dcdbd;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .read-more-btn:hover {
        gap: 0.75rem;
        color: #0aaa9a;
    }

    /* ==================== SIDEBAR ==================== */
    .sidebar-wrapper {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-widget .widget-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .sidebar-widget .widget-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .widget-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .widget-icon {
        font-size: 1.25rem;
        color: #0dcdbd;
    }

    .widget-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
        color: #212529;
    }

    .widget-body {
        padding: 1.5rem;
    }

    /* Search Widget */
    .search-input-group {
        display: flex;
        border-radius: 50px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .search-input {
        flex: 1;
        padding: 12px 20px;
        border: none;
        background: transparent;
        outline: none;
        font-size: 0.95rem;
    }

    .search-btn {
        background: #0dcdbd;
        color: white;
        border: none;
        padding: 12px 24px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .search-btn:hover {
        background: #0aaa9a;
    }

    /* Widget Card Primary */
    .widget-card-primary {
        border: 2px solid #0dcdbd;
    }

    .widget-header-primary {
            background: linear-gradient(135deg, #0dcdbd 0%, #0aaa9a 100%);

        color: white;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .widget-header-primary .widget-icon {
        color: white;
    }

    .widget-header-primary .widget-title {
        color: white;
    }

    /* Profile Item */
    .profile-item {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .profile-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-info {
        flex: 1;
    }

    .profile-name {
        margin: 0 0 0.25rem 0;
        font-size: 1rem;
        font-weight: 700;
    }

    .profile-name a {
        color: #212529;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .profile-name a:hover {
        color: #0dcdbd;
    }

    .profile-date {
        font-size: 0.85rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* Popular Item */
    .popular-item {
        display: flex;
        gap: 1rem;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .popular-item:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .popular-img {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
    }

    .popular-content {
        flex: 1;
    }

    .popular-title {
        margin: 0 0 0.5rem 0;
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.4;
    }

    .popular-title a {
        color: #212529;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .popular-title a:hover {
        color: #0dcdbd;
    }

    .popular-date {
        font-size: 0.85rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 992px) {
        .sidebar-wrapper {
            margin-top: 2rem;
        }
    }

    @media (max-width: 768px) {
        .hero-categories-title {
            font-size: 1.75rem;
        }

        .hero-categories-subtitle {
            font-size: 1rem;
        }

        .hero-categories {
            padding: 60px 0;
        }

        .category-icon-modern {
            width: 70px;
            height: 70px;
            font-size: 2rem;
            border-radius: 16px;
        }

        .category-card-modern {
            padding: 1.25rem 0.75rem;
            border-radius: 16px;
        }

        .category-title-modern {
            font-size: 0.85rem;
        }

        .section-title {
            font-size: 1.75rem;
        }

        .section-subtitle {
            font-size: 1rem;
        }

        .statistics-section {
            padding: 60px 0;
        }

        .news-section {
            padding: 60px 0;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }

        .stat-number {
            font-size: 1.75rem;
        }

        .stat-label {
            font-size: 0.9rem;
        }

        .news-image-wrapper {
            height: 180px;
        }
    }

    /* ==================== ANIMATIONS ==================== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .news-card {
        animation: fadeInUp 0.6s ease;
    }

    /* ==================== PERBAIKAN TAMPILAN MOBILE ==================== */

    /* SAMBUTAN KEPALA DESA - Mobile Optimization */
    @media (max-width: 768px) {
        .sambutan-section {
            padding: 40px 0;
        }

        .sambutan-card {
            padding: 1.5rem;
            border-radius: 20px;
        }

        .sambutan-content {
            padding-left: 0;
            margin-top: 1.5rem;
        }

        .sambutan-image {
            max-width: 100%;
            height: 280px;
        }

        .sambutan-title {
            font-size: 1.75rem;
            margin-bottom: 0.75rem;
        }

        .sambutan-position {
            font-size: 1.1rem;
        }

        .sambutan-text {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .sambutan-btn {
            padding: 12px 24px;
            font-size: 0.9rem;
        }

        .sambutan-badge {
            width: 50px;
            height: 50px;
            top: -10px;
        }

        .sambutan-badge i {
            font-size: 1.5rem;
        }
    }

    /* Extra small screens */
    @media (max-width: 576px) {
        .sambutan-section {
            padding: 30px 0;
        }

        .sambutan-card {
            padding: 1rem;
        }

        .sambutan-image {
            height: 250px;
        }

        .sambutan-title {
            font-size: 1.5rem;
        }

        .sambutan-position {
            font-size: 1rem;
        }

        .sambutan-text {
            font-size: 0.9rem;
        }
    }

    /* HERO CATEGORIES - Mobile Optimization */
    @media (max-width: 768px) {
        .hero-categories {
            padding: 50px 0;
        }

        .hero-categories-title {
            font-size: 1.5rem;
            line-height: 1.4;
        }

        .hero-categories-subtitle {
            font-size: 0.95rem;
        }

        .category-card-modern {
            padding: 1rem 0.5rem;
            border-radius: 15px;
        }

        .category-icon-modern {
            width: 60px;
            height: 60px;
            font-size: 1.75rem;
            border-radius: 14px;
        }

        .category-title-modern {
            font-size: 0.8rem;
            line-height: 1.3;
        }

        /* Perbaiki spacing grid categories */
        .hero-categories .row.g-4 {
            gap: 0.75rem !important;
        }

        .hero-categories .row.g-4>* {
            padding: 0 0.375rem;
        }
    }

    @media (max-width: 576px) {
        .hero-categories {
            padding: 40px 0;
        }

        .hero-categories-title {
            font-size: 1.35rem;
        }

        .category-icon-modern {
            width: 55px;
            height: 55px;
            font-size: 1.5rem;
        }

        .category-title-modern {
            font-size: 0.75rem;
        }
    }

    /* STATISTICS SECTION - Mobile Optimization */
    @media (max-width: 768px) {
        .statistics-section {
            padding: 50px 0;
        }

        .stat-card {
            padding: 1.25rem;
            flex-direction: row;
            gap: 1rem;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            font-size: 1.75rem;
            border-radius: 14px;
        }

        .stat-number {
            font-size: 1.5rem;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.85rem;
            line-height: 1.3;
        }
    }

    @media (max-width: 576px) {
        .statistics-section {
            padding: 40px 0;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 1.35rem;
        }

        .stat-label {
            font-size: 0.8rem;
        }
    }

    /* GIS PREVIEW - Mobile Optimization */
    @media (max-width: 768px) {
        .gis-preview-section {
            padding: 50px 0;
        }

        .gis-preview-section .card-header {
            padding: 1rem;
        }

        .gis-preview-section .card-header h5 {
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .gis-preview-section .card-header small {
            font-size: 0.75rem;
        }

        .gis-preview-section .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.8rem;
        }

        #gisPreviewMap {
            height: 300px !important;
        }
    }

    @media (max-width: 576px) {
        .gis-preview-section {
            padding: 40px 0;
        }

        .gis-preview-section .card-header h5 {
            font-size: 0.85rem;
        }

        #gisPreviewMap {
            height: 250px !important;
        }
    }

    /* NEWS SECTION - Mobile Optimization */
    @media (max-width: 768px) {
        .news-section {
            padding: 50px 0;
        }

        .section-header {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .section-subtitle {
            font-size: 0.95rem;
        }

        .news-image-wrapper {
            height: 200px;
        }

        .news-content {
            padding: 1.25rem;
        }

        .news-title {
            font-size: 1.05rem;
        }

        .news-meta {
            gap: 1rem;
            font-size: 0.85rem;
        }

        .news-excerpt {
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .read-more-btn {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .news-section {
            padding: 40px 0;
        }

        .section-title {
            font-size: 1.35rem;
        }

        .news-image-wrapper {
            height: 180px;
        }

        .news-content {
            padding: 1rem;
        }

        .news-title {
            font-size: 1rem;
        }
    }

    /* SIDEBAR - Mobile Optimization */
    @media (max-width: 992px) {
        .sidebar-wrapper {
            margin-top: 3rem;
        }

        .sidebar-wrapper.sticky-top {
            position: relative !important;
            top: 0 !important;
        }
    }

    @media (max-width: 768px) {

        .widget-header,
        .widget-header-primary {
            padding: 1rem 1.25rem;
        }

        .widget-title {
            font-size: 1rem;
        }

        .widget-body {
            padding: 1.25rem;
        }

        .profile-img {
            width: 60px;
            height: 60px;
        }

        .profile-name {
            font-size: 0.95rem;
        }

        .profile-date {
            font-size: 0.8rem;
        }

        .popular-img {
            width: 70px;
            height: 70px;
        }

        .popular-title {
            font-size: 0.9rem;
        }

        .popular-date {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .sidebar-wrapper {
            margin-top: 2rem;
        }

        .widget-header,
        .widget-header-primary {
            padding: 0.875rem 1rem;
        }

        .widget-title {
            font-size: 0.95rem;
        }

        .widget-body {
            padding: 1rem;
        }

        .profile-img {
            width: 55px;
            height: 55px;
        }

        .popular-img {
            width: 65px;
            height: 65px;
        }
    }

    /* GENERAL CONTAINER PADDING - Mobile */
    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    }

    /* FIX OVERFLOW ISSUES */
    /* Prevent horizontal scroll while allowing vertical scroll */
    html {
        overflow-x: hidden;
        overflow-y: auto;
    }

    body {
        overflow-x: hidden;
        overflow-y: auto;
        margin: 0;
        padding: 0;
    }

    #main {
        overflow-x: hidden;
        overflow-y: visible;
    }

    .container {
        max-width: 100%;
        overflow-x: hidden;
    }

    /* Fix navbar and footer to not create scrollbar */
    #header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        overflow: hidden;
    }

    /* Fix footer to not cause overflow */
    #footer {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    /* AGGRESSIVE FIX FOR DOUBLE SCROLLBAR */
    /* Remove scrollbar from navbar and ensure only one scrollbar exists */
    .navbar {
        overflow: visible !important;
    }

    .navbar ul {
        overflow: visible !important;
    }

    .carousel {
        overflow: hidden;
    }

    .carousel-inner {
        overflow: hidden;
    }

    /* Force single scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* ULTIMATE FIX: Ensure only one scrollbar exists */
    :root {
        --scrollbar-width: 8px;
    }

    html,
    body {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }

    /* Reset any nested overflow - Only html/body should be scrollable */
    * {
        box-sizing: border-box;
    }

    html>body,
    body>#main,
    #main>section {
        overflow: visible !important;
        overflow-y: visible !important;
    }

    /* CRITICAL: Remove scrollbar from navbar */
    .navbar {
        overflow: visible !important;
        max-height: none !important;
    }

    .navbar ul {
        overflow: visible !important;
        max-height: none !important;
    }

    /* CRITICAL: Footer should not be scrollable */
    #footer,
    #footer .footer-top,
    #footer .footer-newsletter {


        /* HERO SECTION FIX - Prevent overflow */
        #hero {
            overflow: hidden;
            position: relative;
            width: 100%;
            max-width: 100vw;
        }

        /* Ensure hero carousel doesn't overflow */
        #heroCarousel {
            overflow: hidden;
            width: 100%;
        }

        /* Make sure all direct children don't overflow */
        #hero .carousel-container {
            max-width: 100%;
            overflow: hidden;
        }


        /* FIX BOOTSTRAP GRID GAPS PADA MOBILE */
        @media (max-width: 768px) {

            .g-4,
            .gx-4 {
                --bs-gutter-x: 1rem;
            }

            .g-4,
            .gy-4 {
                --bs-gutter-y: 1rem;
            }
        }

        @media (max-width: 576px) {

            .g-4,
            .gx-4 {
                --bs-gutter-x: 0.75rem;
            }

            .g-4,
            .gy-4 {
                --bs-gutter-y: 0.75rem;
            }
        }

        /* SMOOTH ANIMATIONS */
        * {
            -webkit-tap-highlight-color: transparent;
        }

        @media (max-width: 768px) {

            .news-card:hover,
            .stat-card:hover,
            .category-card-modern:hover,
            .widget-card:hover {
                transform: translateY(-4px);
            }
        }

        /* CAROUSEL CONTROLS OVERFLOW FIX */
        .carousel-control-prev,
        .carousel-control-next {
            z-index: 10;
        }

        #heroCarousel {
            overflow: hidden;
            position: relative;
        }

        /* Ensure all sections don't overflow */
        section {
            overflow-x: hidden;
        }
    }
</style> --}}

@include('layouts.footer')
@endsection

@section('styles')
<!-- Leaflet CSS for GIS Preview -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@section('scripts')
<!-- Leaflet JS for GIS Preview -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // GIS Preview Map
    let gisPreviewMap = null;
    let gisPreviewBoundary = null;

    // Batas wilayah Desa Dotte - koordinat polygon (lat, lng)
    // Format: [latitude, longitude]
    const desaDotteBoundary = [
        [0.3985834, 128.2958151],
        [0.3999566, 128.2966305],
        [0.4001497, 128.297639],
        [0.4001497, 128.2986476],
        [0.400021, 128.2995488],
        [0.3998279, 128.2992913],
        [0.3990125, 128.3009435],
        [0.3984117, 128.3021452],
        [0.3983902, 128.3038832],
        [0.3983902, 128.3071448],
        [0.3980469, 128.3091833],
        [0.398283, 128.3103634],
        [0.3989696, 128.3116938],
        [0.3998708, 128.3111145],
        [0.4024886, 128.3075739],
        [0.4030464, 128.303218],
        [0.4040335, 128.299184],
        [0.4035185, 128.2963516],
        [0.402274, 128.294871],
        [0.4014586, 128.2943775],
        [0.4006432, 128.2947852],
        [0.3995704, 128.2950427],
        [0.3984117, 128.2950427],
        [0.3985834, 128.2958151]
    ];

    document.addEventListener('DOMContentLoaded', function() {
        // Check if element exists
        if (document.getElementById('gisPreviewMap')) {
            initGisPreviewMap();
        }
    });

    function initGisPreviewMap() {
        const defaultCenter = [0.40075158553336077, 128.29806820804015];

        gisPreviewMap = L.map('gisPreviewMap').setView(defaultCenter, 15);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(gisPreviewMap);

        // Add boundary polygon
        gisPreviewBoundary = L.polygon(desaDotteBoundary, {
            color: '#dc3545',
            fillColor: '#dc3545',
            fillOpacity: 0.15,
            weight: 3
        }).addTo(gisPreviewMap);

        // Load markers from API
        fetch('{{ route('gis.api.all') }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    data.rts.forEach(rt => {
                        if (rt.latitude && rt.longitude) {
                            const marker = createPreviewMarker(rt, 'rt');
                            marker.addTo(gisPreviewMap);
                        }
                    });

                    data.rws.forEach(rw => {
                        if (rw.latitude && rw.longitude) {
                            const marker = createPreviewMarker(rw, 'rw');
                            marker.addTo(gisPreviewMap);
                        }
                    });
                }
            })
            .catch(error => console.error('Error loading GIS preview:', error));
    }

    function createPreviewMarker(data, type) {
        const color = type === 'rt' ? '#0dcdbd' : '#198754';
        const size = type === 'rt' ? 24 : 28;
        const fontSize = type === 'rt' ? 10 : 11;

        const icon = L.divIcon({
            className: 'gis-preview-marker',
            html: `<div style="
                    background: ${color};
                    width: ${size}px;
                    height: ${size}px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border: 2px solid white;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
                ">
                    <span style="color: white; font-size: ${fontSize}px; font-weight: bold;">
                        ${data.nama.replace(/(RT|RW) /, '')}
                    </span>
                </div>`,
            iconSize: [size, size],
            iconAnchor: [size / 2, size / 2],
            popupAnchor: [0, -size / 2]
        });

        return L.marker([data.latitude, data.longitude], {
                icon: icon
            })
            .bindPopup(`
                    <div style="min-width: 150px;">
                        <strong>${data.nama}</strong>
                        <hr class="my-1">
                        <p class="mb-1">Total: ${data.total_penduduk}</p>
                        <p class="mb-1">Laki: ${data.laki_laki} | Perempuan: ${data.perempuan}</p>
                    </div>
                `);
    }
</script>
