@extends('layouts.main', ['title' => 'Program Bantuan Sosial'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Program Bantuan Sosial',
        'subtitle' => 'Ajukan bantuan sosial secara online untuk warga yang membutuhkan',
        'breadcrumb' => 'Bansos',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Bansos Section ======= -->
<section class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <!-- Notifications -->
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
            <div class="flex-grow-1">
                <h6 class="mb-1">Pengajuan Berhasil!</h6>
                <p class="mb-0">{{ Session::get('success') }}</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                <i class="bi bi-gift fs-4" style="color: #0dcdbd;"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Program Bantuan Tersedia</h6>
                                <h3 class="fw-bold mb-0" style="color: #0dcdbd;">{{ $totalBantuan }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(25, 135, 84, 0.1);">
                                <i class="bi bi-people-fill fs-4 text-success"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Penerima Bantuan Aktif</h6>
                                <h3 class="fw-bold mb-0 text-success">{{ $totalPenerima }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Program Bantuan Cards -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header text-white border-0 py-3" style="background-color: #0dcdbd;">
                        <h5 class="mb-0 fw-bold d-flex align-items-center">
                            <i class="bi bi-award me-2"></i>
                            Program Bantuan Sosial yang Tersedia
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if($jenisBansos->count() > 0)
                        <div class="row g-4">
                            @foreach($jenisBansos as $bantuan)
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100 hover-lift">
                                    <div class="card-body p-4">
                                        <!-- Badge Kategori -->
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <span class="badge 
                                                @if($bantuan->kategori == 'reguler') bg-primary
                                                @elseif($bantuan->kategori == 'darurat') bg-danger
                                                @elseif($bantuan->kategori == 'khusus') bg-warning
                                                @endif">
                                                {{ $bantuan->kategori_label }}
                                            </span>
                                            <small class="text-muted">{{ $bantuan->kode_bantuan }}</small>
                                        </div>

                                        <!-- Nama Bantuan -->
                                        <h5 class="fw-bold mb-3" style="color: #0dcdbd;">
                                            <i class="bi bi-gift me-2"></i>{{ $bantuan->nama_bantuan }}
                                        </h5>

                                        <!-- Deskripsi -->
                                        @if($bantuan->deskripsi)
                                        <p class="text-muted mb-3">
                                            {{ Str::limit($bantuan->deskripsi, 120) }}
                                            @if(strlen($bantuan->deskripsi) > 120)
                                            <span class="text-primary" 
                                                  data-bs-toggle="tooltip" 
                                                  title="{{ $bantuan->deskripsi }}">
                                                ...lihat selengkapnya
                                            </span>
                                            @endif
                                        </p>
                                        @endif

                                        <!-- Detail Info -->
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-wallet2 me-2 text-muted"></i>
                                                    <small class="text-muted">Sumber:</small>
                                                </div>
                                                <span class="fw-medium">{{ $bantuan->sumber_dana_label }}</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-tag me-2 text-muted"></i>
                                                    <small class="text-muted">Jenis:</small>
                                                </div>
                                                <span class="fw-medium">{{ ucfirst($bantuan->jenis_bantuan) }}</span>
                                            </div>
                                        </div>

                                        <!-- Nominal Bantuan -->
                                        @if($bantuan->nominal_bantuan)
                                        <div class="alert alert-success border-0 rounded-3 mb-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <small class="d-block text-muted">Nominal Bantuan</small>
                                                    <h5 class="mb-0 fw-bold">
                                                        Rp {{ number_format($bantuan->nominal_bantuan, 0, ',', '.') }}
                                                    </h5>
                                                </div>
                                                <i class="bi bi-cash-stack fs-4"></i>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Action Button -->
                                        <button type="button" 
                                                class="btn w-100 fw-medium"
                                                style="background-color: #0dcdbd; color: white; border: none;"
                                                onclick="openFormPengajuan({{ $bantuan->id }}, '{{ addslashes($bantuan->nama_bantuan) }}')">
                                            <i class="bi bi-send-check me-2"></i>
                                            Ajukan Bantuan
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum ada program bantuan tersedia</h5>
                            <p class="text-muted">Silakan cek kembali di waktu lain</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Syarat & Ketentuan -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-warning text-dark border-0 py-3">
                        <h5 class="mb-0 fw-bold d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            Syarat & Ketentuan Pengajuan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                        <i class="bi bi-person-check" style="color: #0dcdbd;"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Status Warga</h6>
                                        <p class="text-muted mb-0">Warga Desa yang terdaftar dengan NIK dan KK valid</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(255, 193, 7, 0.1);">
                                        <i class="bi bi-cash-coin text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Kondisi Ekonomi</h6>
                                        <p class="text-muted mb-0">Memiliki kondisi ekonomi yang memenuhi kriteria</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 110, 253, 0.1);">
                                        <i class="bi bi-file-earmark-text text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Dokumen Lengkap</h6>
                                        <p class="text-muted mb-0">KTP, KK, dan foto rumah (jika diperlukan)</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(25, 135, 84, 0.1);">
                                        <i class="bi bi-clipboard-check text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Formulir Valid</h6>
                                        <p class="text-muted mb-0">Mengisi formulir dengan data yang benar</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(108, 117, 125, 0.1);">
                                        <i class="bi bi-clock-history text-secondary"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Proses Verifikasi</h6>
                                        <p class="text-muted mb-0">Proses verifikasi maksimal 7 hari kerja</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(220, 53, 69, 0.1);">
                                        <i class="bi bi-telephone text-danger"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Konfirmasi Penerimaan</h6>
                                        <p class="text-muted mb-0">Jika disetujui, akan dihubungi via telepon</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-warning border-0 rounded-3 mt-3">
                            <div class="d-flex">
                                <i class="bi bi-exclamation-triangle-fill fs-4 text-warning me-3"></i>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Perhatian!</h6>
                                    <p class="mb-0">Pengajuan yang tidak memenuhi syarat atau data palsu akan langsung ditolak.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-sidebar" style="top: 20px;">
                    <!-- Info Penting -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header text-white border-0 py-3" style="background-color: #0aaa9a;">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-lightning-charge-fill me-2"></i>
                                Informasi Penting
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center px-0 py-3 border-0">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                        <i class="bi bi-calendar-check" style="color: #0dcdbd;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Periode Buka</h6>
                                        <small class="text-muted">Setiap awal bulan</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3 border-0">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(25, 135, 84, 0.1);">
                                        <i class="bi bi-check-circle text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Status Real-time</h6>
                                        <small class="text-muted">Pantau di dashboard Anda</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3 border-0">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 110, 253, 0.1);">
                                        <i class="bi bi-telephone text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Bantuan Admin</h6>
                                        <small class="text-muted">(021) 1234-5678</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panduan Status -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-question-circle me-2" style="color: #0dcdbd;"></i>
                                Alur Pengajuan
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="timeline">
                                <div class="timeline-item mb-3">
                                    <div class="timeline-badge" style="background-color: #0dcdbd;">
                                        <i class="bi bi-pencil-square text-white"></i>
                                    </div>
                                    <div class="timeline-content ms-4">
                                        <h6 class="mb-1">Isi Formulir</h6>
                                        <small class="text-muted">Lengkapi data dengan benar</small>
                                    </div>
                                </div>
                                <div class="timeline-item mb-3">
                                    <div class="timeline-badge bg-secondary">
                                        <i class="bi bi-clock text-white"></i>
                                    </div>
                                    <div class="timeline-content ms-4">
                                        <h6 class="mb-1">Verifikasi Admin</h6>
                                        <small class="text-muted">Proses maksimal 7 hari</small>
                                    </div>
                                </div>
                                <div class="timeline-item mb-3">
                                    <div class="timeline-badge bg-info">
                                        <i class="bi bi-check-lg text-white"></i>
                                    </div>
                                    <div class="timeline-content ms-4">
                                        <h6 class="mb-1">Status Disetujui</h6>
                                        <small class="text-muted">Akan dihubungi via telepon</small>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-badge bg-success">
                                        <i class="bi bi-gift text-white"></i>
                                    </div>
                                    <div class="timeline-content ms-4">
                                        <h6 class="mb-1">Terima Bantuan</h6>
                                        <small class="text-muted">Ambil sesuai jadwal</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Form Pengajuan -->
<div class="modal fade" id="modalPengajuan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #0dcdbd;">
                <h5 class="modal-title fw-bold">Form Pengajuan Bantuan Sosial</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('frontend.bansos.pengajuan') }}" method="POST" enctype="multipart/form-data" id="formPengajuan">
                @csrf
                <input type="hidden" name="jenis_bansos_id" id="jenis_bansos_id">
                
                <div class="modal-body p-4">
                    <!-- Info Program -->
                    <div class="alert alert-info border-0 rounded-3 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill fs-4 text-info me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Program Bantuan</h6>
                                <p class="mb-0" id="nama_bantuan_display"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Sections -->
                    <div class="accordion mb-4" id="accordionPengajuan">
                        <!-- Data Diri -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiri" style="background-color: rgba(13, 205, 189, 0.1);">
                                    <i class="bi bi-person-circle me-2" style="color: #0dcdbd;"></i>
                                    Data Diri Pemohon
                                </button>
                            </h2>
                            <div id="collapseDiri" class="accordion-collapse collapse show" data-bs-parent="#accordionPengajuan">
                                <div class="accordion-body pt-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik" class="form-label fw-medium">
                                                    NIK (16 Digit) <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('nik') is-invalid @enderror" 
                                                       id="nik" 
                                                       name="nik" 
                                                       value="{{ old('nik', auth('masyarakat')->check() ? auth('masyarakat')->user()->nik : '') }}" 
                                                       maxlength="16" 
                                                       pattern="[0-9]{16}" 
                                                       placeholder="Masukkan NIK 16 digit" 
                                                       required>
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_lengkap" class="form-label fw-medium">
                                                    Nama Lengkap <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                                       id="nama_lengkap" 
                                                       name="nama_lengkap" 
                                                       value="{{ old('nama_lengkap', auth('masyarakat')->check() ? auth('masyarakat')->user()->nama : '') }}" 
                                                       placeholder="Nama sesuai KTP" 
                                                       required>
                                                @error('nama_lengkap')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_kk" class="form-label fw-medium">
                                                    No. Kartu Keluarga <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('no_kk') is-invalid @enderror" 
                                                       id="no_kk" 
                                                       name="no_kk" 
                                                       value="{{ old('no_kk') }}" 
                                                       maxlength="16" 
                                                       placeholder="16 digit No. KK" 
                                                       required>
                                                @error('no_kk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label fw-medium">
                                                    No. HP/WhatsApp <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('no_hp') is-invalid @enderror" 
                                                       id="no_hp" 
                                                       name="no_hp" 
                                                       value="{{ old('no_hp') }}" 
                                                       placeholder="0812-3456-7890" 
                                                       required>
                                                @error('no_hp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat & Keluarga -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlamat" style="background-color: rgba(13, 205, 189, 0.1);">
                                    <i class="bi bi-house-door me-2" style="color: #0dcdbd;"></i>
                                    Alamat & Data Keluarga
                                </button>
                            </h2>
                            <div id="collapseAlamat" class="accordion-collapse collapse" data-bs-parent="#accordionPengajuan">
                                <div class="accordion-body pt-3">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alamat" class="form-label fw-medium">
                                                    Alamat Lengkap <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                          id="alamat" 
                                                          name="alamat" 
                                                          rows="2" 
                                                          placeholder="Jalan, RT/RW, Desa, Kecamatan" 
                                                          required>{{ old('alamat') }}</textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rt_rw" class="form-label fw-medium">
                                                    RT/RW <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('rt_rw') is-invalid @enderror" 
                                                       id="rt_rw" 
                                                       name="rt_rw" 
                                                       value="{{ old('rt_rw') }}" 
                                                       placeholder="Contoh: 001/002" 
                                                       required>
                                                @error('rt_rw')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_tanggungan" class="form-label fw-medium">
                                                    Jumlah Tanggungan <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" 
                                                       class="form-control @error('jumlah_tanggungan') is-invalid @enderror" 
                                                       id="jumlah_tanggungan" 
                                                       name="jumlah_tanggungan" 
                                                       value="{{ old('jumlah_tanggungan', 0) }}" 
                                                       min="0" 
                                                       max="20" 
                                                       required>
                                                @error('jumlah_tanggungan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="penghasilan_perbulan" class="form-label fw-medium">
                                                    Penghasilan Per Bulan (Opsional)
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" 
                                                           class="form-control @error('penghasilan_perbulan') is-invalid @enderror" 
                                                           id="penghasilan_perbulan" 
                                                           name="penghasilan_perbulan" 
                                                           value="{{ old('penghasilan_perbulan') }}" 
                                                           min="0" 
                                                           placeholder="0">
                                                </div>
                                                @error('penghasilan_perbulan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alasan & Dokumen -->
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDokumen" style="background-color: rgba(13, 205, 189, 0.1);">
                                    <i class="bi bi-file-earmark-text me-2" style="color: #0dcdbd;"></i>
                                    Alasan & Dokumen Pendukung
                                </button>
                            </h2>
                            <div id="collapseDokumen" class="accordion-collapse collapse" data-bs-parent="#accordionPengajuan">
                                <div class="accordion-body pt-3">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alasan_pengajuan" class="form-label fw-medium">
                                                    Alasan Pengajuan <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="form-control @error('alasan_pengajuan') is-invalid @enderror" 
                                                          id="alasan_pengajuan" 
                                                          name="alasan_pengajuan" 
                                                          rows="4" 
                                                          placeholder="Jelaskan secara detail alasan Anda membutuhkan bantuan ini..." 
                                                          required>{{ old('alasan_pengajuan') }}</textarea>
                                                @error('alasan_pengajuan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <!-- Dokumen -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="foto_ktp" class="form-label fw-medium">
                                                    Foto KTP <span class="text-danger">*</span>
                                                </label>
                                                <input type="file" 
                                                       class="form-control @error('foto_ktp') is-invalid @enderror" 
                                                       id="foto_ktp" 
                                                       name="foto_ktp" 
                                                       accept="image/*" 
                                                       required>
                                                @error('foto_ktp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Max. 2MB (JPG, PNG)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="foto_kk" class="form-label fw-medium">
                                                    Foto KK <span class="text-danger">*</span>
                                                </label>
                                                <input type="file" 
                                                       class="form-control @error('foto_kk') is-invalid @enderror" 
                                                       id="foto_kk" 
                                                       name="foto_kk" 
                                                       accept="image/*" 
                                                       required>
                                                @error('foto_kk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Max. 2MB (JPG, PNG)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="foto_rumah" class="form-label fw-medium">
                                                    Foto Rumah (Opsional)
                                                </label>
                                                <input type="file" 
                                                       class="form-control @error('foto_rumah') is-invalid @enderror" 
                                                       id="foto_rumah" 
                                                       name="foto_rumah" 
                                                       accept="image/*">
                                                @error('foto_rumah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Max. 2MB (JPG, PNG)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn fw-bold" 
                            style="background-color: #0dcdbd; color: white; border: none;">
                        <i class="bi bi-send-check me-2"></i>Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Custom Styles for Bansos Page */
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
    
    /* Timeline styling */
    .timeline {
        position: relative;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #dee2e6;
    }
    
    .timeline-item {
        position: relative;
    }
    
    .timeline-badge {
        position: absolute;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }
    
    .timeline-content {
        margin-left: 50px;
    }
    
    /* Card styling */
    .card.border-0.shadow-sm {
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
    }
    
    /* Badge styling */
    .badge {
        padding: 0.5em 0.8em;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    /* Form styling */
    .form-control:focus, .form-select:focus {
        border-color: #0dcdbd;
        box-shadow: 0 0 0 0.25rem rgba(13, 205, 189, 0.25);
    }
    
    /* Accordion styling */
    .accordion-button:not(.collapsed) {
        color: #0dcdbd;
        background-color: rgba(13, 205, 189, 0.1);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .card-header h5 {
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        h3.fw-bold {
            font-size: 1.5rem;
        }
        
        .sticky-sidebar {
            position: static;
            max-height: none;
            margin-top: 2rem;
        }
        
        /* Adjust columns for mobile */
        .col-md-6, .col-lg-4 {
            margin-bottom: 1rem;
        }
        
        /* Modal adjustments */
        .modal-dialog {
            margin: 1rem;
        }
        
        .modal-body {
            padding: 1.5rem !important;
        }
        
        .accordion-body {
            padding: 1rem 0 !important;
        }
    }
    
    @media (max-width: 576px) {
        .section-title h2 {
            font-size: 1.5rem;
        }
        
        .card-header h5 {
            font-size: 1rem;
        }
        
        .badge {
            font-size: 0.75rem;
        }
        
        /* Stack form elements */
        .col-md-4, .col-md-6 {
            margin-bottom: 1rem;
        }
        
        /* Smaller buttons */
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
        
        /* Adjust timeline for mobile */
        .timeline-content {
            margin-left: 40px;
        }
        
        .timeline-badge {
            width: 28px;
            height: 28px;
        }
    }
    
    /* Form validation styling */
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    .is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
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

        // Open modal function
        window.openFormPengajuan = function(id, nama) {
            document.getElementById('jenis_bansos_id').value = id;
            document.getElementById('nama_bantuan_display').textContent = nama;
            
            const modal = new bootstrap.Modal(document.getElementById('modalPengajuan'));
            modal.show();
            
            // Auto-fill for authenticated users
            @auth('masyarakat')
            const userData = {
                nama: "{{ auth('masyarakat')->user()->nama }}",
                nik: "{{ auth('masyarakat')->user()->nik }}"
            };
            
            if (!document.getElementById('nama_lengkap').value) {
                document.getElementById('nama_lengkap').value = userData.nama;
            }
            if (!document.getElementById('nik').value) {
                document.getElementById('nik').value = userData.nik;
            }
            @endauth
        };

        // Form validation
        const form = document.getElementById('formPengajuan');
        const nikInput = document.getElementById('nik');
        const noKKInput = document.getElementById('no_kk');
        const noHpInput = document.getElementById('no_hp');

        // NIK validation
        nikInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });

        // No KK validation
        noKKInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });

        // Phone number validation
        noHpInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });

        // File size validation
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (file && file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB');
                    this.value = '';
                }
            });
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            // NIK validation
            if (nikInput.value.length !== 16) {
                e.preventDefault();
                alert('NIK harus terdiri dari 16 digit angka');
                nikInput.focus();
                return false;
            }

            // No KK validation
            if (noKKInput.value.length !== 16) {
                e.preventDefault();
                alert('No. Kartu Keluarga harus terdiri dari 16 digit angka');
                noKKInput.focus();
                return false;
            }

            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
            submitBtn.disabled = true;

            return true;
        });
    });
</script>
@endsection

@include('layouts.footer')
@endsection