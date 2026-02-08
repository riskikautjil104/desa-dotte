@extends('layouts.main', ['title' => 'Berita Terkini'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Berita Desa',
        'subtitle' => 'Temukan berita terbaru tentang Desa Dotte',
        'breadcrumb' => 'Berita',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Berita Section ======= -->
<section class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <!-- Header Section -->
        <div class="section-title text-center mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">Berita Terkini Desa Dotte</h2>
            <p class="text-muted lead">Informasi dan perkembangan terbaru seputar desa</p>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Berita Grid -->
                @if($berita->count() > 0)
                <div class="row g-4">
                    @foreach($berita as $b)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                            <!-- Image Section -->
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $b->gambar) }}" 
                                     alt="{{ $b->judul }}" 
                                     class="card-img-top"
                                     style="height: 220px; object-fit: cover; border-radius: 0.375rem 0.375rem 0 0;">
                                
                                <!-- Badge -->
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge d-flex align-items-center px-3 py-2" 
                                          style="background-color: rgba(13, 205, 189, 0.95); color: white;">
                                        <i class="bi bi-newspaper me-1"></i>
                                        Berita
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-4">
                                <!-- Title -->
                                <h5 class="card-title fw-bold mb-3">
                                    <a href="{{ route('detail.berita', $b->slug) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($b->judul, 70) }}
                                    </a>
                                </h5>

                                <!-- Meta Info -->
                                <div class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-2 me-2" style="background-color: rgba(13, 110, 253, 0.1);">
                                                    <i class="bi bi-calendar3 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Tanggal</small>
                                                    <span class="fw-medium">{{ $b->created_at->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-2 me-2" style="background-color: rgba(13, 205, 189, 0.1);">
                                                    <i class="bi bi-eye" style="color: #0dcdbd;"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Views</small>
                                                    <span class="fw-medium">{{ $b->views }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Excerpt -->
                                @if($b->excerp)
                                <p class="text-muted mb-3">
                                    {!! Str::limit(strip_tags($b->excerp), 120) !!}
                                </p>
                                @endif

                                <!-- Footer -->
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <a href="{{ route('detail.berita', $b->slug) }}" 
                                       class="btn btn-sm px-3" 
                                       style="border-color: #0dcdbd; color: #0dcdbd;">
                                        <i class="bi bi-book me-1"></i>Baca Selengkapnya
                                    </a>
                                    <div class="text-muted small">
                                        <i class="bi bi-clock me-1"></i>{{ $b->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($berita->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-center">
                                    {{ $berita->links('pagination::bootstrap-5') }}
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
                            <i class="bi bi-newspaper text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="text-muted mb-3">Belum Ada Berita</h5>
                        <p class="text-muted mb-4">Tidak ada berita tersedia untuk ditampilkan</p>
                        <a href="{{ route('berita') }}" 
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
                                Kategori Berita
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('berita') }}" 
                                   class="badge d-flex align-items-center px-3 py-2 mb-2 text-decoration-none"
                                   style="background-color: rgba(13, 205, 189, 0.1); color: #0dcdbd;">
                                    <i class="bi bi-grid me-1"></i>
                                    Semua
                                </a>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                                    <i class="bi bi-megaphone me-1"></i>
                                    Pengumuman
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(25, 135, 84, 0.1); color: #198754;">
                                    <i class="bi bi-trophy me-1"></i>
                                    Prestasi
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Acara
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Penting
                                </span>
                                <span class="badge d-flex align-items-center px-3 py-2 mb-2" 
                                      style="background-color: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                                    <i class="bi bi-people me-1"></i>
                                    Masyarakat
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Berita Terpopuler -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-fire me-2 text-danger"></i>
                                Berita Terpopuler
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @php
                                $popularNews = $berita->sortByDesc('views')->take(3);
                            @endphp
                            
                            @if($popularNews->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($popularNews as $popular)
                                <a href="{{ route('detail.berita', $popular->slug) }}" 
                                   class="list-group-item list-group-item-action d-flex align-items-center px-0 py-3 border-0">
                                    <div class="flex-shrink-0">
                                        @if($popular->gambar)
                                        <img src="{{ asset('storage/' . $popular->gambar) }}" 
                                             alt="{{ $popular->judul }}" 
                                             class="rounded"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 60px;">
                                            <i class="bi bi-newspaper text-muted"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-dark">{{ Str::limit($popular->judul, 40) }}</h6>
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-eye me-1"></i>
                                            {{ $popular->views }} views
                                        </small>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-3">
                                <i class="bi bi-newspaper text-muted fs-4 mb-2"></i>
                                <p class="text-muted mb-0">Tidak ada berita populer</p>
                            </div>
                            @endif
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
                                <a href="{{ route('frontend.agenda') }}" 
                                   class="btn btn-sm d-flex align-items-center justify-content-between px-3 py-2"
                                   style="border-color: #0dcdbd; color: #0dcdbd;">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        Agenda Desa
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="{{ route('pengaduan') }}" 
                                   class="btn btn-sm btn-success d-flex align-items-center justify-content-between px-3 py-2">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-chat-dots me-2"></i>
                                        Pengaduan
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="{{ route('frontend.surat-online') }}" 
                                   class="btn btn-sm btn-info d-flex align-items-center justify-content-between px-3 py-2">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        Surat Online
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header text-white border-0 py-3" style="background-color: #0aaa9a;">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-graph-up me-2"></i>
                                Statistik Berita
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-newspaper me-3" style="color: #0dcdbd;"></i>
                                        <span>Total Berita</span>
                                    </div>
                                    <span class="badge" style="background-color: #0dcdbd;">{{ $berita->total() }}</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-eye me-3 text-primary"></i>
                                        <span>Total Views</span>
                                    </div>
                                    <span class="badge bg-primary">{{ $berita->sum('views') }}</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar3 me-3 text-success"></i>
                                        <span>Update Terakhir</span>
                                    </div>
                                    <small class="text-muted">{{ now()->format('d M Y') }}</small>
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
    /* Custom Styles for Berita Page */
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
        
        h5.card-title {
            font-size: 1.1rem;
        }
        
        .sticky-sidebar {
            position: static;
            max-height: none;
            margin-top: 2rem;
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
        
        /* Adjust list items for mobile */
        .list-group-item {
            padding: 0.75rem !important;
        }
        
        /* Smaller buttons on mobile */
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    }
    
    @media (max-width: 576px) {
        .section-title h2 {
            font-size: 1.5rem;
        }
        
        /* Full width cards on mobile */
        .col-md-6 {
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
        
        /* Stack list group items */
        .list-group-item {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .list-group-item .badge {
            margin-top: 0.25rem;
        }
        
        /* Full width buttons on mobile */
        .d-grid .btn {
            width: 100%;
        }
    }
    
    /* Image hover effect */
    .card-img-top {
        transition: transform 0.5s ease;
    }
    
    .hover-lift:hover .card-img-top {
        transform: scale(1.05);
    }
    
    /* Text truncation */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .text-truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
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

        // Add click tracking for news
        document.querySelectorAll('a[href*="detail.berita"]').forEach(link => {
            link.addEventListener('click', function(e) {
                const newsId = this.getAttribute('href').split('/').pop();
                // You can add analytics tracking here
                console.log('News clicked:', newsId);
            });
        });
    });
</script>
@endsection

@include('layouts.footer')
@endsection