@extends('layouts.main', ['title' => 'Agenda Desa'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Agenda Desa',
        'subtitle' => 'Temukan agenda terbaru tentang Desa Dotte',
        'breadcrumb' => 'Agenda',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Agenda Section ======= -->
<section class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <!-- Header Section -->
        <div class="section-title text-center mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">Agenda Desa Dotte</h2>
            <p class="text-muted lead">Jadwal kegiatan dan acara resmi desa</p>
        </div>

        <!-- Filter & Stats -->
        <div class="row g-4 mb-4">
            <!-- Stats Cards -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                <i class="bi bi-calendar-event fs-4" style="color: #0dcdbd;"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Total Agenda</h6>
                                <h3 class="fw-bold mb-0" style="color: #0dcdbd;">{{ $agenda->total() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <h6 class="fw-bold mb-2">Filter Agenda:</h6>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('frontend.agenda') }}"
                                   class="btn btn-sm px-3 {{ !request('status') ? '' : 'btn-outline-teal' }}"
                                   style="{{ !request('status') ? 'background-color: #0dcdbd; color: white;' : 'border-color: #0dcdbd; color: #0dcdbd;' }}">
                                    Semua Agenda
                                </a>
                                <a href="{{ route('frontend.agenda') }}?status=akan_datang"
                                   class="btn btn-sm px-3 {{ request('status') == 'akan_datang' ? '' : 'btn-outline-info' }}"
                                   style="{{ request('status') == 'akan_datang' ? 'background-color: #0dcaf0; color: white;' : 'border-color: #0dcaf0; color: #0dcaf0;' }}">
                                    <i class="bi bi-calendar-plus me-1"></i>Akan Datang
                                </a>
                                <a href="{{ route('frontend.agenda') }}?status=sedang_berlangsung"
                                   class="btn btn-sm px-3 {{ request('status') == 'sedang_berlangsung' ? '' : 'btn-outline-success' }}"
                                   style="{{ request('status') == 'sedang_berlangsung' ? 'background-color: #198754; color: white;' : 'border-color: #198754; color: #198754;' }}">
                                    <i class="bi bi-play-circle me-1"></i>Berlangsung
                                </a>
                                <a href="{{ route('frontend.agenda') }}?status=selesai"
                                   class="btn btn-sm px-3 {{ request('status') == 'selesai' ? '' : 'btn-outline-secondary' }}"
                                   style="{{ request('status') == 'selesai' ? 'background-color: #6c757d; color: white;' : 'border-color: #6c757d; color: #6c757d;' }}">
                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Content - Agenda Cards -->
            <div class="col-lg-8">
                @if ($agenda->count())
                <div class="row g-4">
                    @foreach ($agenda as $item)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                            <!-- Card Image -->
                            @if ($item->gambar)
                            <div class="position-relative">
                                <img src="{{ asset('storage/agenda/' . $item->gambar) }}" 
                                     alt="{{ $item->judul }}" 
                                     class="card-img-top"
                                     style="height: 220px; object-fit: cover; border-radius: 0.375rem 0.375rem 0 0;">
                                
                                <!-- Status Badge -->
                                @php
                                    $badgeConfig = match($item->status) {
                                        'akan_datang' => ['color' => '#0dcaf0', 'bg' => 'rgba(13, 202, 240, 0.1)', 'icon' => 'bi-calendar-plus'],
                                        'sedang_berlangsung' => ['color' => '#198754', 'bg' => 'rgba(25, 135, 84, 0.1)', 'icon' => 'bi-play-circle'],
                                        'selesai' => ['color' => '#6c757d', 'bg' => 'rgba(108, 117, 125, 0.1)', 'icon' => 'bi-check-circle'],
                                        default => ['color' => '#0dcdbd', 'bg' => 'rgba(13, 205, 189, 0.1)', 'icon' => 'bi-calendar-event']
                                    };
                                @endphp
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge d-flex align-items-center px-3 py-2" 
                                          style="background-color: {{ $badgeConfig['bg'] }}; color: {{ $badgeConfig['color'] }};">
                                        <i class="bi {{ $badgeConfig['icon'] }} me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                </div>
                            </div>
                            @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                 style="height: 220px; border-radius: 0.375rem 0.375rem 0 0;">
                                <i class="bi bi-calendar-event text-muted" style="font-size: 4rem;"></i>
                            </div>
                            @endif

                            <!-- Card Body -->
                            <div class="card-body p-4">
                                <!-- Title -->
                                <h5 class="card-title fw-bold mb-3">
                                    <a href="{{ route('frontend.agenda.detail', $item->id) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($item->judul, 70) }}
                                    </a>
                                </h5>

                                <!-- Meta Info -->
                                <div class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-2 me-2" style="background-color: rgba(13, 205, 189, 0.1);">
                                                    <i class="bi bi-calendar3" style="color: #0dcdbd;"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Tanggal</small>
                                                    <span class="fw-medium">{{ $item->tanggal_mulai->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($item->jam_mulai)
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-2 me-2" style="background-color: rgba(255, 193, 7, 0.1);">
                                                    <i class="bi bi-clock text-warning"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Waktu</small>
                                                    <span class="fw-medium">{{ $item->jam_mulai->format('H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($item->lokasi)
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mt-2">
                                                <div class="rounded-circle p-2 me-2" style="background-color: rgba(13, 110, 253, 0.1);">
                                                    <i class="bi bi-geo-alt text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Lokasi</small>
                                                    <span class="fw-medium">{{ Str::limit($item->lokasi, 30) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Description -->
                                @if ($item->deskripsi)
                                <p class="text-muted mb-3">
                                    {!! Str::limit(strip_tags($item->deskripsi), 100) !!}
                                </p>
                                @endif

                                <!-- Footer -->
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <a href="{{ route('frontend.agenda.detail', $item->id) }}" 
                                       class="btn btn-sm px-3" 
                                       style="border-color: #0dcdbd; color: #0dcdbd;">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                    <div class="text-muted small d-flex align-items-center">
                                        <i class="bi bi-eye me-1"></i>{{ $item->views }}x dilihat
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($agenda->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-center">
                                    {{ $agenda->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @else
                <!-- Empty State -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="text-muted mb-3">Belum Ada Agenda</h5>
                        <p class="text-muted mb-4">Tidak ada agenda tersedia untuk ditampilkan</p>
                        <a href="{{ route('frontend.agenda') }}" 
                           class="btn px-4" 
                           style="background-color: #0dcdbd; color: white;">
                            <i class="bi bi-arrow-clockwise me-2"></i>Refresh Halaman
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-sidebar" style="top: 20px;">
                    <!-- Kategori -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header text-white border-0 py-3" style="background-color: #0dcdbd;">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-tags me-2"></i>
                                Kategori Agenda
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(13, 205, 189, 0.1); color: #0dcdbd;">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Total {{ $agenda->total() }}
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                                    <i class="bi bi-people me-1"></i>
                                    Rapat
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(25, 135, 84, 0.1); color: #198754;">
                                    <i class="bi bi-megaphone me-1"></i>
                                    Sosialisasi
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                    <i class="bi bi-award me-1"></i>
                                    Lomba
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                                    <i class="bi bi-music-note me-1"></i>
                                    Budaya
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                                    <i class="bi bi-mortarboard me-1"></i>
                                    Seminar
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Aksi Cepat -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-lightning-charge-fill me-2 text-warning"></i>
                                Aksi Cepat
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-grid gap-2">
                                <a href="{{ route('pengaduan') }}" 
                                   class="btn btn-sm d-flex align-items-center justify-content-between px-3 py-2"
                                   style="border-color: #0dcdbd; color: #0dcdbd;">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-chat-dots me-2"></i>
                                        Pengaduan Masyarakat
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Desa%20Dotte" 
                                   class="btn btn-sm btn-success d-flex align-items-center justify-content-between px-3 py-2"
                                   target="_blank">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-whatsapp me-2"></i>
                                        WhatsApp Admin
                                    </span>
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                                <a href="{{ route('pelayanan') }}" 
                                   class="btn btn-sm btn-info d-flex align-items-center justify-content-between px-3 py-2">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        Layanan Surat
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Agenda Mendatang -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-calendar2-week me-2 text-primary"></i>
                                Agenda Mendatang
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @php
                                $upcomingAgendas = $agenda->where('status', 'akan_datang')->take(3);
                            @endphp
                            
                            @if($upcomingAgendas->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($upcomingAgendas as $upcoming)
                                <a href="{{ route('frontend.agenda.detail', $upcoming->id) }}" 
                                   class="list-group-item list-group-item-action d-flex align-items-center px-0 py-3 border-0">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle p-2 me-3" 
                                             style="background-color: rgba(13, 205, 189, 0.1);">
                                            <i class="bi bi-calendar-event" style="color: #0dcdbd;"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 text-dark">{{ Str::limit($upcoming->judul, 40) }}</h6>
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-calendar me-1"></i>
                                            {{ $upcoming->tanggal_mulai->format('d M') }}
                                        </small>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-3">
                                <i class="bi bi-calendar-x text-muted fs-4 mb-2"></i>
                                <p class="text-muted mb-0">Tidak ada agenda mendatang</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom Styles for Agenda Page */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Sticky sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 20px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
    }
    
    .sticky-sidebar::-webkit-scrollbar {
        width: 4px;
    }
    
    .sticky-sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .sticky-sidebar::-webkit-scrollbar-thumb {
        background: #0dcdbd;
        border-radius: 10px;
    }
    
    /* Card styling */
    .card.border-0.shadow-sm {
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
    }
    
    /* Badge styling */
    .badge {
        border-radius: 6px;
        font-weight: 500;
    }
    
    /* List group styling */
    .list-group-item:hover {
        background-color: rgba(13, 205, 189, 0.05);
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
    
    /* Button styling */
    .btn[style*="border-color: #0dcdbd"]:hover {
        background-color: #0dcdbd;
        color: white !important;
    }
    
    /* Pagination styling */
    .pagination .page-link {
        border-color: #dee2e6;
        color: #0dcdbd;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #0dcdbd;
        border-color: #0dcdbd;
        color: white;
    }
    
    .pagination .page-link:hover {
        background-color: rgba(13, 205, 189, 0.1);
        border-color: #0dcdbd;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .section-title h2 {
            font-size: 1.75rem;
        }
        
        .section-title .lead {
            font-size: 1rem;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        h5.fw-bold {
            font-size: 1.1rem;
        }
        
        .sticky-sidebar {
            position: static;
            max-height: none;
            margin-top: 2rem;
        }
        
        /* Adjust filter buttons for mobile */
        .d-flex.flex-wrap.gap-2 {
            justify-content: center !important;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        /* Adjust card layout for mobile */
        .col-md-6 {
            margin-bottom: 1rem;
        }
        
        /* Smaller badges on mobile */
        .badge {
            font-size: 0.75rem;
            padding: 0.375em 0.75em;
        }
    }
    
    @media (max-width: 576px) {
        .section-title h2 {
            font-size: 1.5rem;
        }
        
        /* Stack stats and filter vertically */
        .col-lg-3, .col-lg-9 {
            width: 100%;
            margin-bottom: 1rem;
        }
        
        /* Full width buttons on mobile */
        .d-grid .btn {
            width: 100%;
        }
        
        /* Adjust card image height for mobile */
        .card-img-top {
            height: 180px !important;
        }
        
        /* Smaller font sizes for mobile */
        h5.card-title {
            font-size: 1rem;
        }
        
        .text-muted {
            font-size: 0.875rem;
        }
    }
</style>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add smooth scroll to anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation to cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Apply animation to all cards
        document.querySelectorAll('.hover-lift').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    });
</script>
@endsection

@include('layouts.footer')
@endsection