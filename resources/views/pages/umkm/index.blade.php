@extends('layouts.main')

@section('body')
@section('outmain')
@include('layouts.header')
@include('layouts.page-hero', [
   'title' => 'UMKM Desa',
   'subtitle' => 'Temukan UMKM terbaru tentang Desa Dotte',
   'breadcrumb' => 'UMKM',
   'showBreadcrumb' => true
])
@endsection

<!-- ======= UMKM Section ======= -->
<section id="umkm" class="blog py-4 py-lg-5">
   <div class="container" data-aos="fade-up">
      <div class="section-title text-center text-lg-start mb-4 mb-lg-5">
         <h2 class="fw-bold mb-3">UMKM Desa Dotte</h2>
         <p class="text-muted lead">Usaha Mikro Kecil Menengah masyarakat desa</p>
      </div>

      <!-- Search and Filter -->
      <div class="row g-3 mb-4">
         <!-- Search Form -->
         <div class="col-12 col-md-8 col-lg-9">
            <form method="GET" class="position-relative">
               <div class="input-group">
                  <span class="input-group-text bg-white border-end-0">
                     <i class="bi bi-search text-muted"></i>
                  </span>
                  <input type="text" name="search" class="form-control border-start-0" 
                         placeholder="Cari nama UMKM, pemilik, atau produk..."
                         value="{{ request('search') }}">
                  <button type="submit" class="btn" style="background-color: #0dcdbd; color: white; min-width: 100px;">
                     <i class="bi bi-search me-2 d-none d-md-inline"></i>Cari
                  </button>
               </div>
            </form>
         </div>

         <!-- Result Counter -->
         <div class="col-12 col-md-4 col-lg-3">
            <div class="bg-light rounded-3 p-3 text-center h-100">
               <small class="text-muted d-block">Total UMKM</small>
               <span class="fw-bold" style="color: #0dcdbd; font-size: 1.25rem;">{{ $umkm->total() }}</span>
            </div>
         </div>
      </div>

      <!-- Category Filter -->
      <div class="row mb-4">
         <div class="col-12">
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
               <a href="{{ route('frontend.umkm') }}"
                  class="btn btn-sm {{ !request('kategori') ? '' : 'btn-outline-secondary' }}" 
                  style="{{ !request('kategori') ? 'background-color: #0dcdbd; color: white;' : '' }}">
                  <i class="bi bi-grid me-1"></i>Semua
               </a>
               <a href="{{ route('frontend.umkm') }}?kategori=makanan"
                  class="btn btn-sm {{ request('kategori') == 'makanan' ? '' : 'btn-outline-secondary' }}"
                  style="{{ request('kategori') == 'makanan' ? 'background-color: #0dcdbd; color: white;' : '' }}">
                  <i class="bi bi-cup-hot me-1"></i>Makanan
               </a>
               <a href="{{ route('frontend.umkm') }}?kategori=minuman"
                  class="btn btn-sm {{ request('kategori') == 'minuman' ? '' : 'btn-outline-secondary' }}"
                  style="{{ request('kategori') == 'minuman' ? 'background-color: #0dcdbd; color: white;' : '' }}">
                  <i class="bi bi-droplet me-1"></i>Minuman
               </a>
               <a href="{{ route('frontend.umkm') }}?kategori=fashion"
                  class="btn btn-sm {{ request('kategori') == 'fashion' ? '' : 'btn-outline-secondary' }}"
                  style="{{ request('kategori') == 'fashion' ? 'background-color: #0dcdbd; color: white;' : '' }}">
                  <i class="bi bi-handbag me-1"></i>Fashion
               </a>
               <a href="{{ route('frontend.umkm') }}?kategori=jasa"
                  class="btn btn-sm {{ request('kategori') == 'jasa' ? '' : 'btn-outline-secondary' }}"
                  style="{{ request('kategori') == 'jasa' ? 'background-color: #0dcdbd; color: white;' : '' }}">
                  <i class="bi bi-tools me-1"></i>Jasa
               </a>
               <a href="{{ route('frontend.umkm') }}?kategori=kerajinan"
                  class="btn btn-sm {{ request('kategori') == 'kerajinan' ? '' : 'btn-outline-secondary' }}"
                  style="{{ request('kategori') == 'kerajinan' ? 'background-color: #0dcdbd; color: white;' : '' }}">
                  <i class="bi bi-palette me-1"></i>Kerajinan
               </a>
               <a href="{{ route('frontend.umkm') }}?kategori=teknologi"
                  class="btn btn-sm {{ request('kategori') == 'teknologi' ? '' : 'btn-outline-secondary' }}"
                  style="{{ request('kategori') == 'teknologi' ? 'background-color: #0dcdbd; color: white;' : '' }}">
                  <i class="bi bi-laptop me-1"></i>Teknologi
               </a>
            </div>
         </div>
      </div>

      <div class="row">
         {{-- Sidebar --}}
         <div class="col-lg-4 order-1 order-lg-2 mb-4 mb-lg-0">
            <div class="sticky-sidebar" style="top: 20px;">

               {{-- Featured UMKM --}}
               @if($featuredUMKM->count() > 0)
               <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-left">
                  <div class="card-header bg-warning text-dark border-0 py-3">
                     <div class="d-flex align-items-center">
                        <i class="bi bi-star-fill me-2"></i>
                        <h5 class="mb-0 fw-bold">UMKM Unggulan</h5>
                     </div>
                  </div>
                  <div class="card-body p-3">
                     <div class="row g-3">
                        @foreach($featuredUMKM as $featured)
                        <div class="col-12">
                           <div class="d-flex align-items-center bg-light rounded-3 p-3">
                              <div class="flex-shrink-0">
                                 @if ($featured->gambar_utama)
                                 <img src="{{ asset('storage/umkm/' . $featured->gambar_utama) }}"
                                    alt="{{ $featured->nama_usaha }}" class="rounded"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                 @else
                                 <div class="bg-white rounded d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-shop text-muted"></i>
                                 </div>
                                 @endif
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h6 class="mb-1">
                                    <a href="{{ route('frontend.umkm.detail', $featured->id) }}"
                                       class="text-decoration-none text-dark small fw-bold">
                                       {{ Str::limit($featured->nama_usaha, 25) }}
                                    </a>
                                 </h6>
                                 <small class="text-muted d-flex align-items-center">
                                    <i class="bi bi-tag me-1"></i>
                                    <span class="text-capitalize">{{ $featured->kategori }}</span>
                                 </small>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
               @endif

               {{-- Statistik Kategori --}}
               @if($kategoriCounts->count() > 0)
               <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-left" data-aos-delay="100">
                  <div class="card-header text-white border-0 py-3" style="background-color: #0dcdbd;">
                     <div class="d-flex align-items-center">
                        <i class="bi bi-bar-chart me-2"></i>
                        <h5 class="mb-0 fw-bold">Statistik Kategori</h5>
                     </div>
                  </div>
                  <div class="card-body p-3">
                     @foreach($kategoriCounts as $kategori => $count)
                     <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                        <a href="{{ route('frontend.umkm') }}?kategori={{ $kategori }}"
                           class="text-decoration-none text-dark text-capitalize small">
                           {{ str_replace('_', ' ', $kategori) }}
                        </a>
                        <div class="d-flex align-items-center">
                           <div class="progress flex-grow-1 me-2" style="height: 6px; width: 80px;">
                              @php
                                 $percentage = $count > 0 ? ($count / $umkm->total()) * 100 : 0;
                              @endphp
                              <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #0dcdbd;"></div>
                           </div>
                           <span class="badge bg-light text-dark" style="font-size: 0.75rem;">{{ $count }}</span>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
               @endif

               {{-- Quick Actions --}}
               <div class="card border-0 shadow-sm rounded-3" data-aos="fade-left" data-aos-delay="200">
                  <div class="card-header bg-white border-0 py-3">
                     <div class="d-flex align-items-center">
                        <i class="bi bi-lightning me-2" style="color: #0dcdbd;"></i>
                        <h5 class="mb-0 fw-bold">Aksi Cepat</h5>
                     </div>
                  </div>
                  <div class="card-body p-3">
                     <div class="d-grid gap-2">
                        <a href="{{ route('pengaduan') }}" class="btn btn-sm d-flex align-items-center justify-content-center"
                           style="border-color: #0dcdbd; color: #0dcdbd;">
                           <i class="bi bi-chat-dots me-2"></i>Pengaduan
                        </a>
                        <a href="{{ route('frontend.agenda') }}" class="btn btn-sm d-flex align-items-center justify-content-center btn-outline-info">
                           <i class="bi bi-calendar-event me-2"></i>Agenda Desa
                        </a>
                        <a href="{{ route('pelayanan') }}" class="btn btn-sm d-flex align-items-center justify-content-center btn-outline-success">
                           <i class="bi bi-file-earmark-text me-2"></i>Layanan Surat
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Desa%20Dotte"
                           class="btn btn-sm d-flex align-items-center justify-content-center btn-outline-warning" target="_blank">
                           <i class="bi bi-whatsapp me-2"></i>WhatsApp Admin
                        </a>
                     </div>
                  </div>
               </div>

            </div>
         </div>

         {{-- Main Content --}}
         <div class="col-lg-8 order-2 order-lg-1">
            @if ($umkm->count())
            <div class="row g-3 g-md-4">
               @foreach ($umkm as $item)
               <div class="col-md-6">
                  <article class="umkm-card h-100" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                     <div class="card border-0 shadow-sm h-100">
                        <!-- Image -->
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                           @if ($item->gambar_utama)
                           <img src="{{ asset('storage/umkm/' . $item->gambar_utama) }}" alt="{{ $item->nama_usaha }}"
                              class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
                           @else
                           <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center">
                              <i class="bi bi-shop text-muted" style="font-size: 3rem;"></i>
                           </div>
                           @endif
                           
                           <!-- Badges -->
                           <div class="position-absolute top-0 start-0 p-3">
                              <span class="badge" style="background-color: #0dcdbd; backdrop-filter: blur(5px);">
                                 {{ ucfirst($item->kategori) }}
                              </span>
                              @if($item->is_featured)
                              <span class="badge bg-warning ms-1" style="backdrop-filter: blur(5px);">
                                 <i class="bi bi-star-fill me-1"></i>Unggulan
                              </span>
                              @endif
                           </div>
                        </div>

                        <!-- Content -->
                        <div class="card-body p-4">
                           <!-- Title -->
                           <h3 class="h5 mb-3">
                              <a href="{{ route('frontend.umkm.detail', $item->id) }}"
                                 class="text-decoration-none text-dark fw-bold">
                                 {{ $item->nama_usaha }}
                              </a>
                           </h3>

                           <!-- Meta Info -->
                           <div class="d-flex flex-wrap gap-3 mb-3">
                              <div class="d-flex align-items-center">
                                 <i class="bi bi-person me-2" style="color: #0dcdbd;"></i>
                                 <small class="text-muted">{{ $item->pemilik }}</small>
                              </div>
                              @if ($item->alamat)
                              <div class="d-flex align-items-center">
                                 <i class="bi bi-geo-alt me-2" style="color: #0dcdbd;"></i>
                                 <small class="text-muted">{{ Str::limit($item->alamat, 20) }}</small>
                              </div>
                              @endif
                           </div>

                           <!-- Description -->
                           <p class="text-muted small mb-4" style="line-height: 1.6;">
                              {!! Str::limit(strip_tags($item->deskripsi), 120) !!}
                           </p>

                           <!-- Footer -->
                           <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                              <a href="{{ route('frontend.umkm.detail', $item->id) }}"
                                 class="btn btn-sm px-3" 
                                 style="background-color: #0dcdbd; color: white; border-radius: 20px;">
                                 <span class="d-none d-md-inline">Lihat Detail</span>
                                 <span class="d-inline d-md-none">Detail</span>
                                 <i class="bi bi-arrow-right ms-1"></i>
                              </a>

                              <div class="d-flex align-items-center gap-3">
                                 <small class="text-muted">
                                    <i class="bi bi-eye me-1"></i>{{ $item->views }}
                                 </small>
                                 <div class="d-flex gap-2">
                                    @if($item->instagram)
                                    <a href="{{ $item->instagram }}" target="_blank" class="text-decoration-none">
                                       <i class="bi bi-instagram text-danger"></i>
                                    </a>
                                    @endif
                                    @if($item->facebook)
                                    <a href="{{ $item->facebook }}" target="_blank" class="text-decoration-none">
                                       <i class="bi bi-facebook" style="color: #0dcdbd;"></i>
                                    </a>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
               </div>
               @endforeach
            </div>

            <!-- Pagination -->
            @if($umkm->hasPages())
            <div class="d-flex justify-content-center mt-5">
               {{ $umkm->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
            @endif
            @else
            <div class="text-center py-5 my-5">
               <div class="mb-4">
                  <i class="bi bi-shop text-muted" style="font-size: 4rem;"></i>
               </div>
               <h5 class="text-muted mb-3">
                  @if(request('search') || request('kategori'))
                  Tidak ada UMKM yang sesuai dengan pencarian
                  @else
                  Belum Ada UMKM Terdaftar
                  @endif
               </h5>
               <p class="text-muted mb-4">
                  @if(request('search') || request('kategori'))
                  Coba kata kunci atau kategori lain
                  @else
                  Silakan kunjungi kembali dalam waktu dekat
                  @endif
               </p>
               <div class="d-flex flex-wrap gap-2 justify-content-center">
                  @if(request('search') || request('kategori'))
                  <a class="btn px-4" href="{{ route('frontend.umkm') }}" 
                     style="background-color: #0dcdbd; color: white; border-radius: 20px;">
                     <i class="bi bi-arrow-clockwise me-2"></i> Reset Filter
                  </a>
                  @endif
                  <a class="btn px-4" href="/" 
                     style="border: 2px solid #0dcdbd; color: #0dcdbd; border-radius: 20px;">
                     <i class="bi bi-arrow-return-left me-2"></i> Kembali ke Beranda
                  </a>
               </div>
            </div>
            @endif
         </div>

      </div>

   </div>
</section>

<style>
   /* Custom Styles for UMKM Page */
   .sticky-sidebar {
      position: sticky;
      top: 20px;
      max-height: calc(100vh - 40px);
      overflow-y: auto;
   }
   
   /* Scrollbar styling */
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
   
   /* UMKM Card hover effect */
   .umkm-card .card {
      transition: all 0.3s ease;
      border-radius: 12px;
      overflow: hidden;
   }
   
   .umkm-card:hover .card {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(13, 205, 189, 0.1) !important;
   }
   
   .umkm-card:hover img {
      transform: scale(1.05);
   }
   
   /* Button hover effects */
   .btn[style*="background-color: #0dcdbd"]:hover {
      background-color: #0abab5 !important;
      transform: translateY(-1px);
      transition: all 0.3s ease;
   }
   
   .btn-outline-info:hover,
   .btn-outline-success:hover,
   .btn-outline-warning:hover {
      transform: translateY(-1px);
      transition: all 0.3s ease;
   }
   
   /* Social icons hover */
   .bi-instagram:hover,
   .bi-facebook:hover {
      transform: scale(1.2);
      transition: transform 0.3s ease;
   }
   
   /* Responsive Design */
   @media (max-width: 768px) {
      .section-title h2 {
         font-size: 1.75rem;
      }
      
      .section-title p.lead {
         font-size: 1rem;
      }
      
      .umkm-card .card-body {
         padding: 1.5rem !important;
      }
      
      .sticky-sidebar {
         position: static;
         max-height: none;
         margin-bottom: 2rem;
      }
      
      /* Category buttons scroll on mobile */
      .d-flex.flex-wrap.gap-2 {
         overflow-x: auto;
         padding-bottom: 10px;
         flex-wrap: nowrap !important;
      }
      
      .d-flex.flex-wrap.gap-2 .btn-sm {
         white-space: nowrap;
      }
   }
   
   @media (max-width: 576px) {
      .col-md-6 {
         margin-bottom: 1.5rem;
      }
      
      .umkm-card .card {
         margin-bottom: 0;
      }
      
      .card-body p.small {
         font-size: 0.85rem !important;
      }
      
      /* Adjust button sizes */
      .btn-sm {
         padding: 0.375rem 0.75rem !important;
         font-size: 0.875rem !important;
      }
      
      /* Search form adjustments */
      .input-group .btn {
         min-width: 80px !important;
      }
   }
   
   /* Progress bar styling */
   .progress {
      background-color: rgba(13, 205, 189, 0.1);
   }
   
   /* Badge styling */
   .badge {
      font-weight: 500;
      padding: 0.5em 0.8em;
   }
   
   /* Featured UMKM cards */
   .bg-light.rounded-3 {
      transition: all 0.3s ease;
   }
   
   .bg-light.rounded-3:hover {
      background-color: rgba(13, 205, 189, 0.05) !important;
   }
</style>

@include('layouts.footer')
@endsection