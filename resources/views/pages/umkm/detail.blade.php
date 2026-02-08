@extends('layouts.main')

@section('body')
@section('outmain')
@include('layouts.header')
@endsection

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs py-3" data-aos="fade-in">
   <div class="container">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.umkm') }}">UMKM</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($umkm->nama_usaha, 30) }}</li>
         </ol>
      </nav>
   </div>
</div>

<!-- ======= UMKM Detail Section ======= -->
<section id="umkm-detail" class="py-4 py-lg-5">
   <div class="container" data-aos="fade-up">
      <div class="row g-4 g-lg-5">
         {{-- Main Content --}}
         <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
               {{-- Header dengan Badge --}}
               <div class="card-header bg-white border-0 pb-0">
                  <div class="row align-items-center mb-3">
                     <div class="col-md-8">
                        <div class="d-flex flex-wrap gap-2 mb-2">
                           <span class="badge" style="background-color: #0dcdbd; font-size: 0.9rem; padding: 0.5em 1em;">
                              {{ ucfirst($umkm->kategori) }}
                           </span>
                           @if($umkm->is_featured)
                           <span class="badge bg-warning" style="font-size: 0.9rem; padding: 0.5em 1em;">
                              <i class="bi bi-star-fill me-1"></i>Unggulan
                           </span>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-4 text-md-end">
                        <div class="text-muted small d-flex align-items-center justify-content-md-end">
                           <i class="bi bi-eye me-2" style="color: #0dcdbd;"></i>
                           <span>{{ number_format($umkm->views) }} dilihat</span>
                        </div>
                     </div>
                  </div>

                  <h1 class="mb-3" style="color: #333; font-size: 1.8rem;">{{ $umkm->nama_usaha }}</h1>

                  {{-- Meta Information --}}
                  <div class="row g-3 mb-4">
                     <div class="col-md-6">
                        <div class="d-flex align-items-center bg-light rounded-3 p-3">
                           <div class="flex-shrink-0">
                              <i class="bi bi-person fs-5" style="color: #0dcdbd;"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <small class="text-muted d-block mb-1">Pemilik</small>
                              <span class="fw-medium">{{ $umkm->pemilik }}</span>
                           </div>
                        </div>
                     </div>

                     @if ($umkm->alamat)
                     <div class="col-md-6">
                        <div class="d-flex align-items-center bg-light rounded-3 p-3">
                           <div class="flex-shrink-0">
                              <i class="bi bi-geo-alt fs-5" style="color: #0dcdbd;"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <small class="text-muted d-block mb-1">Alamat</small>
                              <span class="fw-medium">{{ Str::limit($umkm->alamat, 40) }}</span>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if ($umkm->no_hp)
                     <div class="col-md-6">
                        <div class="d-flex align-items-center bg-light rounded-3 p-3">
                           <div class="flex-shrink-0">
                              <i class="bi bi-telephone fs-5" style="color: #0dcdbd;"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <small class="text-muted d-block mb-1">Telepon/WhatsApp</small>
                              <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $umkm->no_hp) }}" target="_blank"
                                 class="text-decoration-none fw-medium">
                                 {{ $umkm->no_hp }}
                              </a>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if ($umkm->email)
                     <div class="col-md-6">
                        <div class="d-flex align-items-center bg-light rounded-3 p-3">
                           <div class="flex-shrink-0">
                              <i class="bi bi-envelope fs-5" style="color: #0dcdbd;"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <small class="text-muted d-block mb-1">Email</small>
                              <a href="mailto:{{ $umkm->email }}" class="text-decoration-none fw-medium">
                                 {{ $umkm->email }}
                              </a>
                           </div>
                        </div>
                     </div>
                     @endif
                  </div>
               </div>

               <div class="card-body p-4">
                  {{-- Gambar Utama --}}
                  @if ($umkm->gambar_utama)
                  <div class="mb-4">
                     <img src="{{ asset('storage/umkm/' . $umkm->gambar_utama) }}" alt="{{ $umkm->nama_usaha }}"
                        class="img-fluid rounded-3 w-100" style="max-height: 400px; object-fit: cover;">
                  </div>
                  @endif

                  {{-- Galeri --}}
                  @if($umkm->galeri && is_array($umkm->galeri) && count($umkm->galeri) > 0)
                  <div class="mb-4">
                     <h5 class="mb-3 pb-2 border-bottom">
                        <i class="bi bi-images me-2" style="color: #0dcdbd;"></i>Galeri UMKM
                     </h5>
                     <div class="row g-3">
                        @foreach($umkm->galeri as $index => $gambar)
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                           <div class="gallery-item position-relative overflow-hidden rounded-3" style="height: 180px;">
                              <img src="{{ asset('storage/umkm/galeri/' . $gambar) }}" alt="Galeri {{ $umkm->nama_usaha }}"
                                 class="img-fluid w-100 h-100" style="object-fit: cover; cursor: pointer;"
                                 onclick="openModal({{ $index }})">
                              <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                   style="background: rgba(0,0,0,0.3); opacity: 0; transition: opacity 0.3s ease;">
                                 <i class="bi bi-zoom-in text-white fs-4"></i>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
                  @endif

                  {{-- Konten Deskripsi --}}
                  <div class="mb-4">
                     <h5 class="mb-3 pb-2 border-bottom">
                        <i class="bi bi-info-circle me-2" style="color: #0dcdbd;"></i>Deskripsi Usaha
                     </h5>
                     <div class="content-text" style="line-height: 1.7; color: #555;">
                        {!! nl2br(e($umkm->deskripsi)) !!}
                     </div>
                  </div>

                  {{-- Informasi Tambahan --}}
                  <div class="row g-3 mb-4">
                     <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                           <div class="card-body">
                              <div class="d-flex align-items-center mb-3">
                                 <div class="flex-shrink-0">
                                    <div class="rounded-circle p-2" style="background-color: rgba(13, 205, 189, 0.1);">
                                       <i class="bi bi-tag fs-5" style="color: #0dcdbd;"></i>
                                    </div>
                                 </div>
                                 <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-bold">Kategori</h6>
                                    <p class="mb-0">
                                       <span class="badge" style="background-color: #0dcdbd; font-size: 0.85rem;">
                                          {{ ucfirst($umkm->kategori) }}
                                       </span>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                           <div class="card-body">
                              <div class="d-flex align-items-center mb-3">
                                 <div class="flex-shrink-0">
                                    <div class="rounded-circle p-2" style="background-color: rgba(25, 135, 84, 0.1);">
                                       <i class="bi bi-shield-check fs-5 text-success"></i>
                                    </div>
                                 </div>
                                 <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-bold">Status</h6>
                                    <p class="mb-0">
                                       @if($umkm->status == 'aktif')
                                          <span class="badge bg-success">Aktif</span>
                                       @elseif($umkm->status == 'verifikasi')
                                          <span class="badge bg-warning">Verifikasi</span>
                                       @else
                                          <span class="badge bg-secondary">Non-aktif</span>
                                       @endif
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  {{-- Social Media & Contact --}}
                  @if($umkm->instagram || $umkm->facebook || $umkm->email || $umkm->no_hp)
                  <div class="mb-4">
                     <h5 class="mb-3 pb-2 border-bottom">
                        <i class="bi bi-link-45deg me-2" style="color: #0dcdbd;"></i>Kontak & Media Sosial
                     </h5>
                     <div class="row g-3">
                        @if($umkm->no_hp)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                           <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $umkm->no_hp) }}" target="_blank"
                              class="btn btn-success w-100 d-flex align-items-center justify-content-center py-3">
                              <i class="bi bi-whatsapp fs-5 me-2"></i>
                              <span>WhatsApp</span>
                           </a>
                        </div>
                        @endif

                        @if($umkm->email)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                           <a href="mailto:{{ $umkm->email }}" 
                              class="btn w-100 d-flex align-items-center justify-content-center py-3"
                              style="border: 2px solid #0dcdbd; color: #0dcdbd;">
                              <i class="bi bi-envelope fs-5 me-2"></i>
                              <span>Email</span>
                           </a>
                        </div>
                        @endif

                        @if($umkm->instagram)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                           <a href="{{ $umkm->instagram }}" target="_blank" 
                              class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center py-3">
                              <i class="bi bi-instagram fs-5 me-2"></i>
                              <span>Instagram</span>
                           </a>
                        </div>
                        @endif

                        @if($umkm->facebook)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                           <a href="{{ $umkm->facebook }}" target="_blank" 
                              class="btn w-100 d-flex align-items-center justify-content-center py-3"
                              style="border: 2px solid #0dcdbd; color: #0dcdbd;">
                              <i class="bi bi-facebook fs-5 me-2"></i>
                              <span>Facebook</span>
                           </a>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif

                  {{-- Call to Action --}}
                  <div class="mt-4 p-4 rounded-3" style="background: linear-gradient(135deg, #0dcdbd 0%, #0abab5 100%);">
                     <div class="row align-items-center">
                        <div class="col-lg-8 mb-3 mb-lg-0">
                           <h5 class="text-white mb-2">
                              <i class="bi bi-chat-left-text me-2"></i>Tertarik dengan produk UMKM ini?
                           </h5>
                           <p class="text-white mb-0 opacity-90">
                              Hubungi langsung melalui WhatsApp atau media sosial untuk informasi lebih lanjut.
                           </p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                           <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $umkm->no_hp) }}?text=Halo%20{{ urlencode($umkm->pemilik) }}%2C%20saya%20tertarik%20dengan%20{{ urlencode($umkm->nama_usaha) }}"
                              class="btn btn-light px-4 py-2 fw-medium" target="_blank">
                              <i class="bi bi-whatsapp me-2"></i>Hubungi Sekarang
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         {{-- Sidebar --}}
         <div class="col-lg-4">
            <div class="sticky-sidebar" style="top: 20px;">

               {{-- UMKM Terkait --}}
               @if($relatedUMKM->count() > 0)
               <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-left">
                  <div class="card-header bg-white border-0 py-3">
                     <h5 class="mb-0 d-flex align-items-center">
                        <i class="bi bi-shop me-2" style="color: #0dcdbd;"></i>UMKM Lainnya
                     </h5>
                  </div>
                  <div class="card-body p-3">
                     <div class="row g-3">
                        @foreach($relatedUMKM as $related)
                        <div class="col-12">
                           <div class="d-flex align-items-center bg-light rounded-3 p-3">
                              <div class="flex-shrink-0">
                                 @if ($related->gambar_utama)
                                 <img src="{{ asset('storage/umkm/' . $related->gambar_utama) }}"
                                    alt="{{ $related->nama_usaha }}" class="rounded"
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
                                    <a href="{{ route('frontend.umkm.detail', $related->id) }}"
                                       class="text-decoration-none text-dark small fw-bold">
                                       {{ Str::limit($related->nama_usaha, 30) }}
                                    </a>
                                 </h6>
                                 <small class="text-muted d-flex align-items-center">
                                    <i class="bi bi-tag me-1"></i>
                                    <span class="text-capitalize">{{ $related->kategori }}</span>
                                 </small>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>

                     <div class="text-center mt-3">
                        <a href="{{ route('frontend.umkm') }}" class="btn btn-sm w-100" 
                           style="background-color: #0dcdbd; color: white;">
                           <i class="bi bi-grid me-2"></i>Lihat Semua UMKM
                        </a>
                     </div>
                  </div>
               </div>
               @endif

               {{-- Quick Actions --}}
               <div class="card border-0 shadow-sm rounded-3" data-aos="fade-left" data-aos-delay="100">
                  <div class="card-header bg-white border-0 py-3">
                     <h5 class="mb-0 d-flex align-items-center">
                        <i class="bi bi-lightning me-2" style="color: #0dcdbd;"></i>Aksi Cepat
                     </h5>
                  </div>
                  <div class="card-body p-3">
                     <div class="d-grid gap-3">
                        <a href="{{ route('pengaduan') }}" 
                           class="btn d-flex align-items-center justify-content-center py-2"
                           style="border: 2px solid #0dcdbd; color: #0dcdbd;">
                           <i class="bi bi-chat-dots me-3 fs-5"></i>
                           <span class="text-start">
                              <small class="d-block text-muted">Layanan</small>
                              <span class="fw-medium">Pengaduan Online</span>
                           </span>
                        </a>
                        
                        <a href="{{ route('frontend.agenda') }}" 
                           class="btn d-flex align-items-center justify-content-center py-2 btn-outline-info">
                           <i class="bi bi-calendar-event me-3 fs-5"></i>
                           <span class="text-start">
                              <small class="d-block text-muted">Informasi</small>
                              <span class="fw-medium">Agenda Desa</span>
                           </span>
                        </a>
                        
                        <a href="{{ route('pelayanan') }}" 
                           class="btn d-flex align-items-center justify-content-center py-2 btn-outline-success">
                           <i class="bi bi-file-earmark-text me-3 fs-5"></i>
                           <span class="text-start">
                              <small class="d-block text-muted">Layanan</small>
                              <span class="fw-medium">Surat Online</span>
                           </span>
                        </a>
                        
                        <a href="{{ route('galeri') }}" 
                           class="btn d-flex align-items-center justify-content-center py-2 btn-outline-warning">
                           <i class="bi bi-images me-3 fs-5"></i>
                           <span class="text-start">
                              <small class="d-block text-muted">Media</small>
                              <span class="fw-medium">Galeri Desa</span>
                           </span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Modal for Gallery -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title fw-bold">
               <i class="bi bi-images me-2" style="color: #0dcdbd;"></i>{{ $umkm->nama_usaha }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body text-center p-0">
            <img id="modalImage" src="" alt="Galeri" class="img-fluid" style="max-height: 70vh; object-fit: contain;">
         </div>
      </div>
   </div>
</div>

<style>
   /* Custom Styles for UMKM Detail Page */
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
   
   /* Gallery hover effects */
   .gallery-item:hover .gallery-overlay {
      opacity: 1;
   }
   
   .gallery-item img {
      transition: transform 0.5s ease;
   }
   
   .gallery-item:hover img {
      transform: scale(1.05);
   }
   
   /* Button hover effects */
   .btn[style*="background-color: #0dcdbd"]:hover {
      background-color: #0abab5 !important;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(13, 205, 189, 0.3);
      transition: all 0.3s ease;
   }
   
   .btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
      transition: all 0.3s ease;
   }
   
   .btn-outline-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
      transition: all 0.3s ease;
   }
   
   /* Quick action buttons */
   .btn-outline-info:hover,
   .btn-outline-success:hover,
   .btn-outline-warning:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
   }
   
   /* Responsive Design */
   @media (max-width: 768px) {
      h1 {
         font-size: 1.5rem !important;
      }
      
      .breadcrumbs {
         padding: 1rem 0 !important;
      }
      
      .card-body {
         padding: 1.5rem !important;
      }
      
      .sticky-sidebar {
         position: static;
         max-height: none;
         margin-bottom: 2rem;
      }
      
      /* Adjust gallery layout */
      .gallery-item {
         height: 150px !important;
      }
      
      /* Adjust CTA layout */
      .row.align-items-center {
         text-align: center !important;
      }
      
      .col-lg-4.text-lg-end {
         text-align: center !important;
         margin-top: 1rem;
      }
   }
   
   @media (max-width: 576px) {
      .row.g-3 .col-sm-6 {
         margin-bottom: 1rem;
      }
      
      .gallery-item {
         height: 120px !important;
      }
      
      /* Make info cards stack nicely */
      .d-flex.align-items-center.bg-light.rounded-3.p-3 {
         margin-bottom: 1rem;
      }
      
      /* Adjust button sizes */
      .btn {
         padding: 0.5rem 1rem !important;
      }
   }
   
   /* Content text styling */
   .content-text {
      font-size: 1.05rem;
      line-height: 1.8;
      color: #444;
   }
   
   .content-text p {
      margin-bottom: 1.2rem;
   }
   
   /* Badge styling */
   .badge {
      font-weight: 500;
   }
   
   /* Card hover effects */
   .card.border-0.shadow-sm {
      transition: transform 0.3s ease;
   }
   
   .card.border-0.shadow-sm:hover {
      transform: translateY(-3px);
   }
   
   /* Related UMKM items */
   .bg-light.rounded-3.p-3 {
      transition: all 0.3s ease;
      cursor: pointer;
   }
   
   .bg-light.rounded-3.p-3:hover {
      background-color: rgba(13, 205, 189, 0.05) !important;
   }
</style>

<script>
   function openModal(index) {
      const images = @json($umkm->galeri ?? []);
      if (images && images.length > 0) {
         const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
         const modalImage = document.getElementById('modalImage');
         modalImage.src = '/storage/umkm/galeri/' + images[index];
         modal.show();
      }
   }
</script>

@include('layouts.footer')
@endsection