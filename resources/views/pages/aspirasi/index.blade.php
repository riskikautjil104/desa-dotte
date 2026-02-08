@extends('layouts.main')

@section('body')
@section('outmain')
    @include('layouts.header')
    
    {{-- Page Hero for Aspirasi --}}
    @include('layouts.page-hero', [
        'title' => 'Aspirasi Warga',
        'subtitle' => 'Sampaikan aspirasi Anda untuk kemajuan Desa Dotte',
        'breadcrumb' => 'Aspirasi',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Aspirasi Section ======= -->
<section id="aspirasi" class="aspirasi py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center text-lg-start mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">Aspirasi Warga Desa Dotte</h2>
            <p class="text-muted lead">Sampaikan ide dan masukan untuk kemajuan desa kita bersama</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-3 fs-4"></i>
            <div class="flex-grow-1">
                <strong class="d-block">Berhasil!</strong>
                <span class="d-block">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
            <div class="flex-grow-1">
                <strong class="d-block">Perhatian!</strong>
                <span class="d-block">{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-start">
                <i class="bi bi-exclamation-triangle-fill me-3 mt-1 fs-4"></i>
                <div class="flex-grow-1">
                    <h6 class="mb-2 fw-bold">Terdapat kesalahan pada input data:</h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="sticky-sidebar" style="top: 20px;">
                    <!-- Statistik -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-right">
                        <div class="card-header text-white border-0 py-3" style="background: linear-gradient(135deg, #0dcdbd 0%, #0abab5 100%);">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-bar-chart me-2"></i>Statistik Aspirasi
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-2 text-center">
                                <div class="col-6">
                                    <div class="p-3 rounded" style="background-color: rgba(13, 205, 189, 0.1);">
                                        <h3 class="mb-1" style="color: #0dcdbd;">{{ $totalAspirasi }}</h3>
                                        <small class="text-muted d-block">Total</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded" style="background-color: rgba(13, 205, 189, 0.1);">
                                        <h3 class="mb-1" style="color: #0dcdbd;">{{ $aspirasiBaru }}</h3>
                                        <small class="text-muted d-block">Baru</small>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="p-3 rounded" style="background-color: rgba(255, 193, 7, 0.1);">
                                        <h3 class="mb-1 text-warning">{{ $aspirasiDiproses }}</h3>
                                        <small class="text-muted d-block">Diproses</small>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="p-3 rounded" style="background-color: rgba(25, 135, 84, 0.1);">
                                        <h3 class="mb-1 text-success">{{ $aspirasiSelesai }}</h3>
                                        <small class="text-muted d-block">Selesai</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-right" data-aos-delay="100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-tags me-2" style="color: #0dcdbd;"></i>Kategori Populer
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            @if($kategoriStats->count())
                                <div class="row g-2">
                                    @foreach($kategoriStats as $kategori => $count)
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <a href="javascript:void(0)" class="text-decoration-none text-dark text-capitalize small filter-category" data-category="{{ $kategori }}">
                                                {{ ucfirst($kategori) }}
                                            </a>
                                            <span class="badge" style="background-color: #0dcdbd;">{{ $count }}</span>
                                        </div>
                                        <div class="progress mb-3" style="height: 6px;">
                                            @php
                                                $percentage = $count > 0 ? ($count / $totalAspirasi) * 100 : 0;
                                            @endphp
                                            <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #0dcdbd;"></div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0 text-center small">Belum ada data kategori</p>
                            @endif
                        </div>
                    </div>

                    <!-- Top Aspirasi -->
                    <div class="card border-0 shadow-sm rounded-3" data-aos="fade-right" data-aos-delay="200">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-star me-2" style="color: #0dcdbd;"></i>Populer Minggu Ini
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            @if($topAspirasi->count())
                                <div class="row g-3">
                                    @foreach($topAspirasi as $item)
                                    <div class="col-12">
                                        <div class="bg-light rounded-3 p-3">
                                            <h6 class="mb-2 small fw-bold">
                                                <a href="javascript:void(0)" class="text-decoration-none text-dark">
                                                    {{ Str::limit($item->judul, 50) }}
                                                </a>
                                            </h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted text-capitalize">{{ $item->kategori_label }}</small>
                                                <small class="d-flex align-items-center" style="color: #0dcdbd;">
                                                    <i class="bi bi-hand-thumbs-up me-1"></i> 
                                                    <span>{{ $item->votes }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0 text-center small">Belum ada aspirasi populer</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Form Aspirasi -->
                <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-up">
                    <div class="card-header text-white border-0 py-3" style="background: linear-gradient(135deg, #0dcdbd 0%, #0abab5 100%);">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-chat-left-text me-2"></i>Formulir Aspirasi
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('frontend.aspirasi.store') }}" method="POST" enctype="multipart/form-data" id="aspirasiForm">
                            @csrf
                            <div class="row g-3">
                                <!-- Nama -->
                                <div class="col-md-6">
                                    <label for="nama" class="form-label small fw-medium">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" 
                                           name="nama" 
                                           value="{{ old('nama') }}"
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email (Optional) -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label small fw-medium">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="nama@email.com">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Opsional</small>
                                </div>

                                <!-- No HP -->
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label small fw-medium">
                                        Nomor WhatsApp <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">+62</span>
                                        <input type="text" 
                                               class="form-control @error('no_hp') is-invalid @enderror" 
                                               id="no_hp" 
                                               name="no_hp"
                                               value="{{ old('no_hp') }}"
                                               placeholder="81234567890"
                                               required>
                                        @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kategori -->
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label small fw-medium">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('kategori') is-invalid @enderror" 
                                            id="kategori" 
                                            name="kategori" 
                                            required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="infrastruktur" {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>🏗️ Infrastruktur</option>
                                        <option value="pendidikan" {{ old('kategori') == 'pendidikan' ? 'selected' : '' }}>📚 Pendidikan</option>
                                        <option value="kesehatan" {{ old('kategori') == 'kesehatan' ? 'selected' : '' }}>🏥 Kesehatan</option>
                                        <option value="ekonomi" {{ old('kategori') == 'ekonomi' ? 'selected' : '' }}>💰 Ekonomi</option>
                                        <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>🤝 Sosial</option>
                                        <option value="lingkungan" {{ old('kategori') == 'lingkungan' ? 'selected' : '' }}>🌳 Lingkungan</option>
                                        <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>🔧 Lainnya</option>
                                    </select>
                                    @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="col-12">
                                    <label for="alamat" class="form-label small fw-medium">
                                        Alamat <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('alamat') is-invalid @enderror" 
                                           id="alamat" 
                                           name="alamat"
                                           value="{{ old('alamat') }}"
                                           placeholder="RT/RW, Nama Jalan, Desa"
                                           required>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Judul -->
                                <div class="col-12">
                                    <label for="judul" class="form-label small fw-medium">
                                        Judul Aspirasi <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" 
                                           name="judul"
                                           value="{{ old('judul') }}"
                                           placeholder="Contoh: Perbaikan Jalan Rusak di Jalan Merdeka"
                                           required>
                                    @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label small fw-medium">
                                        Isi Aspirasi <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" 
                                              name="deskripsi" 
                                              rows="6"
                                              placeholder="Jelaskan aspirasi Anda secara detail dan jelas..."
                                              required>{{ old('deskripsi') }}</textarea>
                                    <small class="text-muted">Minimal 50 karakter</small>
                                    @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Foto -->
                                <div class="col-12">
                                    <label for="foto" class="form-label small fw-medium">Foto Pendukung</label>
                                    <div class="input-group">
                                        <input type="file" 
                                               class="form-control @error('foto') is-invalid @enderror" 
                                               id="foto" 
                                               name="foto" 
                                               accept="image/*">
                                        <button class="btn btn-outline-secondary" type="button" id="clearFile">
                                            <i class="bi bi-x"></i>
                                        </button>
                                        @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text small">Opsional. Maksimal 2MB (JPG, PNG, GIF)</div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="d-grid d-md-flex gap-3">
                                        <button type="submit" class="btn py-3 fw-medium" 
                                                style="background-color: #0dcdbd; color: white;">
                                            <i class="bi bi-send-fill me-2"></i>Kirim Aspirasi
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary py-3 fw-medium">
                                            <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                        </button>
                                    </div>
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <span class="text-danger">*</span> Wajib diisi
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Daftar Aspirasi -->
                <div class="card border-0 shadow-sm rounded-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <h5 class="mb-2 mb-md-0 d-flex align-items-center">
                                <i class="bi bi-chat-square-text me-2" style="color: #0dcdbd;"></i>Daftar Aspirasi
                            </h5>
                            <div class="text-muted small">
                                Total: <span class="fw-bold" style="color: #0dcdbd;">{{ $aspirasi->total() }}</span> aspirasi
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($aspirasi->count())
                            @foreach($aspirasi as $item)
                                <div class="p-4 border-bottom">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-3">
                                        <div class="mb-2 mb-md-0">
                                            <h6 class="fw-bold mb-2" style="color: #333;">
                                                {{ $item->judul }}
                                            </h6>
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                @if($item->status == 'baru')
                                                <span class="badge" style="background-color: #0dcdbd;">
                                                    <i class="bi bi-clock me-1"></i>Baru
                                                </span>
                                                @elseif($item->status == 'diproses')
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-gear me-1"></i>Diproses
                                                </span>
                                                @elseif($item->status == 'selesai')
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                                </span>
                                                @else
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-x-circle me-1"></i>Ditolak
                                                </span>
                                                @endif
                                                <span class="badge bg-light text-dark text-capitalize">
                                                    {{ $item->kategori_label }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-md-end">
                                            <small class="text-muted d-block">{{ $item->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                    
                                    <p class="text-muted mb-3" style="line-height: 1.6;">
                                        {{ Str::limit($item->deskripsi, 200) }}
                                    </p>
                                    
                                    @if($item->tanggapan)
                                    <div class="alert alert-info mb-3 py-3 border-start border-3 border-info">
                                        <div class="d-flex">
                                            <i class="bi bi-info-circle-fill me-3 fs-5 text-info"></i>
                                            <div>
                                                <strong class="d-block mb-1">Tanggapan:</strong>
                                                <small>{{ $item->tanggapan }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                        <div class="mb-3 mb-md-0">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-person-circle me-2"></i>
                                                <span class="fw-medium">{{ $item->nama }}</span>
                                            </small>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <button class="btn btn-sm d-flex align-items-center" 
                                                    onclick="vote({{ $item->id }})" 
                                                    style="border-color: #0dcdbd; color: #0dcdbd;">
                                                <i class="bi bi-hand-thumbs-up me-1"></i>
                                                <span id="vote-count-{{ $item->id }}">{{ $item->votes }}</span>
                                            </button>
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-eye me-2"></i>{{ $item->views }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            @if($aspirasi->hasPages())
                            <div class="p-4 border-top">
                                {{ $aspirasi->links('pagination::bootstrap-5') }}
                            </div>
                            @endif
                        @else
                            <div class="text-center py-5 my-3">
                                <div class="mb-4">
                                    <i class="bi bi-chat-left-dots" style="font-size: 4rem; color: #e9ecef;"></i>
                                </div>
                                <h6 class="text-muted mb-3">Belum ada aspirasi</h6>
                                <p class="text-muted mb-4">Jadilah yang pertama menyampaikan aspirasi untuk desa kita!</p>
                                <a href="#aspirasiForm" class="btn" style="background-color: #0dcdbd; color: white;">
                                    <i class="bi bi-pencil-square me-2"></i>Tulis Aspirasi
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom Styles for Aspirasi Page */
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
    
    /* Form styling */
    .form-control:focus, .form-select:focus {
        border-color: #0dcdbd;
        box-shadow: 0 0 0 0.25rem rgba(13, 205, 189, 0.25);
    }
    
    /* Button hover effects */
    .btn[style*="background-color: #0dcdbd"]:hover {
        background-color: #0abab5 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 205, 189, 0.3);
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
    
    /* Badge styling */
    .badge {
        font-weight: 500;
        padding: 0.5em 0.8em;
    }
    
    /* Card hover effects */
    .card.border-0.shadow-sm {
        transition: transform 0.3s ease;
    }
    
    .card.border-0.shadow-sm:hover {
        transform: translateY(-3px);
    }
    
    /* List item styling */
    .border-bottom {
        border-bottom: 1px solid #eee !important;
    }
    
    /* Progress bar styling */
    .progress {
        background-color: rgba(13, 205, 189, 0.1);
    }
    
    /* Vote button styling */
    button[onclick*="vote"]:hover {
        background-color: #0dcdbd !important;
        color: white !important;
        transition: all 0.3s ease;
    }
    
    /* Category filter */
    .filter-category:hover {
        color: #0dcdbd !important;
        text-decoration: underline !important;
        cursor: pointer;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .section-title h2 {
            font-size: 1.75rem;
        }
        
        .section-title p.lead {
            font-size: 1rem;
        }
        
        .sticky-sidebar {
            position: static;
            max-height: none;
            margin-bottom: 2rem;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        /* Form adjustments */
        .form-label {
            font-size: 0.875rem !important;
        }
        
        .btn {
            padding: 0.75rem 1.5rem !important;
        }
        
        /* Alert adjustments */
        .alert {
            padding: 1rem !important;
        }
    }
    
    @media (max-width: 576px) {
        h5 {
            font-size: 1.1rem !important;
        }
        
        h6 {
            font-size: 1rem !important;
        }
        
        .col-md-6 {
            margin-bottom: 1rem;
        }
        
        .btn {
            width: 100% !important;
            margin-bottom: 0.5rem;
        }
        
        .d-grid.d-md-flex.gap-3 {
            gap: 0.5rem !important;
        }
        
        /* Adjust spacing in list items */
        .p-4 {
            padding: 1.5rem !important;
        }
    }
    
    /* Animation for alerts */
    .alert-dismissible {
        animation: slideIn 0.3s ease;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@push('scripts')
<script>
    function vote(aspirasiId) {
        fetch(`/aspirasi/${aspirasiId}/vote`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const voteCount = document.getElementById(`vote-count-${aspirasiId}`);
                if (voteCount) {
                    voteCount.textContent = data.votes;
                    
                    // Show success feedback
                    const btn = voteCount.closest('button');
                    btn.style.backgroundColor = '#0dcdbd';
                    btn.style.color = 'white';
                    btn.style.borderColor = '#0dcdbd';
                    
                    setTimeout(() => {
                        btn.style.backgroundColor = 'transparent';
                        btn.style.color = '#0dcdbd';
                        btn.style.borderColor = '#0dcdbd';
                    }, 1000);
                    
                    // Show toast notification
                    showToast('Terima kasih! Vote Anda telah direkam.', 'success');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan saat memberikan vote', 'error');
        });
    }
    
    // Clear file input
    document.getElementById('clearFile')?.addEventListener('click', function() {
        document.getElementById('foto').value = '';
    });
    
    // Filter by category
    document.querySelectorAll('.filter-category').forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            // Implement category filtering logic here
            showToast(`Filter kategori: ${category}`, 'info');
        });
    });
    
    // Form validation
    document.getElementById('aspirasiForm')?.addEventListener('submit', function(e) {
        const deskripsi = document.getElementById('deskripsi').value;
        if (deskripsi.length < 50) {
            e.preventDefault();
            showToast('Deskripsi harus minimal 50 karakter', 'warning');
        }
    });
    
    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} border-0`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi ${type === 'success' ? 'bi-check-circle' : type === 'error' ? 'bi-exclamation-circle' : 'bi-info-circle'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        const container = document.createElement('div');
        container.className = 'position-fixed bottom-0 end-0 p-3';
        container.style.zIndex = '11';
        container.appendChild(toast);
        
        document.body.appendChild(container);
        
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        toast.addEventListener('hidden.bs.toast', function () {
            container.remove();
        });
    }
</script>
@endpush

@include('layouts.footer')
@endsection