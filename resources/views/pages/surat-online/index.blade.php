@extends('layouts.main', ['title' => 'Layanan Surat Online'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Layanan Surat Online',
        'subtitle' => 'Ajukan permohonan surat secara online dengan mudah dan cepat',
        'breadcrumb' => 'Surat Online',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Surat Online Section ======= -->
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

        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
            <div class="flex-grow-1">
                <h6 class="mb-1">Perhatian!</h6>
                <p class="mb-0">{{ Session::get('error') }}</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                <i class="bi bi-file-text fs-4" style="color: #0dcdbd;"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Total Surat</h6>
                                <h3 class="fw-bold mb-0" style="color: #0dcdbd;">{{ $totalSurat }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(255, 193, 7, 0.1);">
                                <i class="bi bi-clock-history fs-4 text-warning"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Menunggu</h6>
                                <h3 class="fw-bold mb-0 text-warning">{{ $suratMenunggu }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 110, 253, 0.1);">
                                <i class="bi bi-gear-fill fs-4 text-info"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Diproses</h6>
                                <h3 class="fw-bold mb-0 text-info">{{ $suratDiproses }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(25, 135, 84, 0.1);">
                                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Selesai</h6>
                                <h3 class="fw-bold mb-0 text-success">{{ $suratSelesai }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Form Column -->
            <div class="col-lg-8">
                <!-- Form Pengajuan Card -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header text-white border-0 py-3" style="background-color: #0dcdbd;">
                        <h5 class="mb-0 fw-bold d-flex align-items-center">
                            <i class="bi bi-file-earmark-plus me-2"></i>
                            Form Pengajuan Surat Online
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Info Box -->
                        <div class="alert alert-info border-0 rounded-3 mb-4" style="background-color: #e7f3ff;">
                            <div class="d-flex">
                                <i class="bi bi-info-circle-fill fs-4 text-info me-3"></i>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-2">Petunjuk Pengajuan:</h6>
                                    <ol class="mb-0 ps-3">
                                        <li class="mb-1">Isi formulir dengan data yang lengkap dan benar</li>
                                        <li class="mb-1">Pastikan nomor HP aktif untuk dihubungi</li>
                                        <li class="mb-1">Setelah pengajuan, Anda akan mendapat nomor surat</li>
                                        <li class="mb-0">Pantau status surat pada bagian Riwayat Pengajuan</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('frontend.surat-online.store') }}" method="POST" id="formSurat">
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Nama Lengkap -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pemohon" class="form-label fw-medium">
                                            <i class="bi bi-person me-1" style="color: #0dcdbd;"></i>
                                            Nama Lengkap
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg @error('nama_pemohon') is-invalid @enderror" 
                                               id="nama_pemohon" 
                                               name="nama_pemohon" 
                                               value="{{ old('nama_pemohon', auth('masyarakat')->check() ? auth('masyarakat')->user()->nama : '') }}" 
                                               placeholder="Masukkan nama lengkap" 
                                               required>
                                        @error('nama_pemohon')
                                            <div class="invalid-feedback d-flex align-items-center">
                                                <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- NIK -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik" class="form-label fw-medium">
                                            <i class="bi bi-credit-card me-1" style="color: #0dcdbd;"></i>
                                            Nomor Induk Kependudukan (NIK)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg @error('nik') is-invalid @enderror" 
                                               id="nik" 
                                               name="nik" 
                                               value="{{ old('nik', auth('masyarakat')->check() ? auth('masyarakat')->user()->nik : '') }}" 
                                               placeholder="16 digit NIK" 
                                               maxlength="16" 
                                               pattern="[0-9]{16}" 
                                               required>
                                        @error('nik')
                                            <div class="invalid-feedback d-flex align-items-center">
                                                <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">Masukkan 16 digit NIK tanpa spasi</small>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label fw-medium">
                                            <i class="bi bi-envelope me-1" style="color: #0dcdbd;"></i>
                                            Email
                                        </label>
                                        <input type="email" 
                                               class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', auth('masyarakat')->check() ? auth('masyarakat')->user()->email : '') }}" 
                                               placeholder="email@contoh.com">
                                        @error('email')
                                            <div class="invalid-feedback d-flex align-items-center">
                                                <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- No HP -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label fw-medium">
                                            <i class="bi bi-whatsapp me-1" style="color: #0dcdbd;"></i>
                                            Nomor HP/WhatsApp
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg @error('no_hp') is-invalid @enderror" 
                                               id="no_hp" 
                                               name="no_hp" 
                                               value="{{ old('no_hp') }}" 
                                               placeholder="0812-3456-7890" 
                                               required>
                                        @error('no_hp')
                                            <div class="invalid-feedback d-flex align-items-center">
                                                <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="alamat" class="form-label fw-medium">
                                            <i class="bi bi-house-door me-1" style="color: #0dcdbd;"></i>
                                            Alamat Lengkap
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                  id="alamat" 
                                                  name="alamat" 
                                                  rows="3" 
                                                  placeholder="Masukkan alamat lengkap (jalan, RT/RW, desa, kecamatan)" 
                                                  required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback d-flex align-items-center">
                                                <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jenis Surat -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_surat" class="form-label fw-medium">
                                            <i class="bi bi-folder me-1" style="color: #0dcdbd;"></i>
                                            Jenis Surat
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-lg @error('jenis_surat') is-invalid @enderror" 
                                                id="jenis_surat" 
                                                name="jenis_surat" 
                                                required>
                                            <option value="">-- Pilih Jenis Surat --</option>
                                            <option value="keterangan_tinggal" {{ old('jenis_surat') == 'keterangan_tinggal' ? 'selected' : '' }}>
                                                Surat Keterangan Tinggal
                                            </option>
                                            <option value="skck" {{ old('jenis_surat') == 'skck' ? 'selected' : '' }}>
                                                Pengantar SKCK
                                            </option>
                                            <option value="keterangan_usaha" {{ old('jenis_surat') == 'keterangan_usaha' ? 'selected' : '' }}>
                                                Surat Keterangan Usaha
                                            </option>
                                            <option value="keterangan_tidak_mampu" {{ old('jenis_surat') == 'keterangan_tidak_mampu' ? 'selected' : '' }}>
                                                Surat Keterangan Tidak Mampu
                                            </option>
                                            <option value="keterangan_domisili" {{ old('jenis_surat') == 'keterangan_domisili' ? 'selected' : '' }}>
                                                Surat Keterangan Domisili
                                            </option>
                                            <option value="keterangan_lain" {{ old('jenis_surat') == 'keterangan_lain' ? 'selected' : '' }}>
                                                Keterangan Lainnya
                                            </option>
                                        </select>
                                        @error('jenis_surat')
                                            <div class="invalid-feedback d-flex align-items-center">
                                                <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="keterangan" class="form-label fw-medium">
                                            <i class="bi bi-chat-left-text me-1" style="color: #0dcdbd;"></i>
                                            Keperluan / Keterangan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                                  id="keterangan" 
                                                  name="keterangan" 
                                                  rows="4" 
                                                  placeholder="Jelaskan keperluan surat yang Anda ajukan secara lengkap dan jelas..." 
                                                  required>{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback d-flex align-items-center">
                                                <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Mohon diisi dengan detail dan jelas untuk mempercepat proses verifikasi
                                        </small>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-lg fw-bold" 
                                                style="background-color: #0dcdbd; color: white; border: none;">
                                            <i class="bi bi-send-check me-2"></i>
                                            Kirim Pengajuan Surat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="sticky-sidebar" style="top: 20px;">
                    <!-- Info Box -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header text-white border-0 py-3" style="background-color: #0aaa9a;">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-info-circle me-2"></i>
                                Informasi Penting
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center px-0 py-3 border-0">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                        <i class="bi bi-clock-history" style="color: #0dcdbd;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Estimasi Waktu</h6>
                                        <small class="text-muted">Proses 2-5 hari kerja</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3 border-0">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(25, 135, 84, 0.1);">
                                        <i class="bi bi-check-circle text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Gratis Biaya</h6>
                                        <small class="text-muted">Tidak dipungut biaya</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3 border-0">
                                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 110, 253, 0.1);">
                                        <i class="bi bi-telephone text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Kontak Desa</h6>
                                        <small class="text-muted">(021) 1234-5678</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Guide -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-list-check me-2" style="color: #0dcdbd;"></i>
                                Panduan Status Surat
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning me-3">Menunggu</span>
                                <small class="text-muted">Surat telah diajukan dan menunggu verifikasi</small>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-info me-3">Diproses</span>
                                <small class="text-muted">Surat sedang diproses oleh admin</small>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-success me-3">Selesai</span>
                                <small class="text-muted">Surat siap diambil/diunduh</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger me-3">Ditolak</span>
                                <small class="text-muted">Pengajuan surat ditolak</small>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-link-45deg me-2" style="color: #0dcdbd;"></i>
                                Akses Cepat
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-grid gap-2">
                                <a href="{{ route('frontend.agenda') }}" 
                                   class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-between">
                                    <span>
                                        <i class="bi bi-calendar-event me-2"></i>Agenda Desa
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="{{ route('berita') }}" 
                                   class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-between">
                                    <span>
                                        <i class="bi bi-newspaper me-2"></i>Berita Terbaru
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                @auth('masyarakat')
                                <a href="{{ route('profile') }}" 
                                   class="btn btn-outline-info btn-sm d-flex align-items-center justify-content-between">
                                    <span>
                                        <i class="bi bi-person-circle me-2"></i>Profil Saya
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                @else
                                <a href="{{ route('login') }}" 
                                   class="btn btn-outline-warning btn-sm d-flex align-items-center justify-content-between">
                                    <span>
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Login Masyarakat
                                    </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengajuan (Only for authenticated users) -->
        @auth('masyarakat')
        @if($mySurat->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-success text-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-clock-history me-2"></i>
                                Riwayat Pengajuan Surat Anda
                            </h5>
                            <span class="badge bg-light text-dark">{{ $mySurat->count() }} surat</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3 ps-4">No. Surat</th>
                                        <th class="py-3">Jenis Surat</th>
                                        <th class="py-3">Tanggal Pengajuan</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3 pe-4 text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mySurat as $surat)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold" style="color: #0dcdbd;">{{ $surat->nomor_surat }}</div>
                                            <small class="text-muted">{{ $surat->created_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-1 me-2" style="background-color: rgba(13, 205, 189, 0.1);">
                                                    <i class="bi bi-file-text" style="color: #0dcdbd; font-size: 0.875rem;"></i>
                                                </div>
                                                <span>{{ $surat->jenis_surat_label }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $surat->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if($surat->status == 'menunggu')
                                                <span class="badge bg-warning text-dark d-flex align-items-center">
                                                    <i class="bi bi-clock me-1"></i>Menunggu
                                                </span>
                                            @elseif($surat->status == 'diproses')
                                                <span class="badge bg-info d-flex align-items-center">
                                                    <i class="bi bi-gear me-1"></i>Diproses
                                                </span>
                                            @elseif($surat->status == 'selesai')
                                                <span class="badge bg-success d-flex align-items-center">
                                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                                </span>
                                            @else
                                                <span class="badge bg-danger d-flex align-items-center">
                                                    <i class="bi bi-x-circle me-1"></i>Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('frontend.surat-online.show', $surat->id) }}" 
                                                   class="btn btn-sm" style="border-color: #0dcdbd; color: #0dcdbd;">
                                                    <i class="bi bi-eye me-1"></i>Detail
                                                </a>
                                                @if($surat->file_hasil)
                                                <a href="{{ route('frontend.surat-online.download', $surat->id) }}" 
                                                   class="btn btn-sm btn-success">
                                                    <i class="bi bi-download me-1"></i>Unduh
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($mySurat->count() > 5)
                    <div class="card-footer bg-white border-0 py-3 text-center">
                        <a href="{{ route('frontend.surat-online.history') }}" 
                           class="btn btn-outline-success btn-sm">
                            <i class="bi bi-list-ul me-1"></i>Lihat Semua Riwayat
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @endauth
    </div>
</section>

<style>
    /* Custom Styles for Surat Online Page */
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
    
    /* Form styling */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #0dcdbd;
        box-shadow: 0 0 0 0.25rem rgba(13, 205, 189, 0.25);
    }
    
    .form-control-lg {
        padding: 0.75rem 1rem;
    }
    
    /* List group styling */
    .list-group-item:hover {
        background-color: rgba(13, 205, 189, 0.05);
    }
    
    /* Table styling */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 205, 189, 0.05) !important;
    }
    
    /* Badge styling */
    .badge {
        padding: 0.5em 0.8em;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .card-header h5 {
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .form-control-lg {
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
        }
        
        h3.fw-bold {
            font-size: 1.5rem;
        }
        
        h6.fw-bold {
            font-size: 1rem;
        }
        
        .sticky-sidebar {
            position: static;
            max-height: none;
            margin-top: 2rem;
        }
        
        /* Adjust table for mobile */
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .table td, .table th {
            padding: 0.75rem !important;
        }
        
        .btn-group {
            flex-wrap: wrap;
            gap: 0.25rem;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    }
    
    @media (max-width: 576px) {
        .col-6 {
            margin-bottom: 1rem;
        }
        
        .alert {
            font-size: 0.875rem;
        }
        
        /* Stack form elements on mobile */
        .row.g-3 > [class*="col-"] {
            margin-bottom: 1rem;
        }
        
        /* Adjust badges for mobile */
        .badge {
            font-size: 0.75rem;
            padding: 0.375em 0.75em;
        }
        
        /* Smaller buttons on mobile */
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
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
        // Form validation
        const form = document.getElementById('formSurat');
        const nikInput = document.getElementById('nik');
        const noHpInput = document.getElementById('no_hp');
        
        // NIK validation
        nikInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });
        
        // Phone number validation
        noHpInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
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
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
            submitBtn.disabled = true;
            
            return true;
        });
        
        // Auto-fill for authenticated users
        @auth('masyarakat')
        const userData = {
            nama: "{{ auth('masyarakat')->user()->nama }}",
            nik: "{{ auth('masyarakat')->user()->nik }}",
            email: "{{ auth('masyarakat')->user()->email }}"
        };
        
        if (!form.querySelector('#nama_pemohon').value) {
            form.querySelector('#nama_pemohon').value = userData.nama;
        }
        if (!form.querySelector('#nik').value) {
            form.querySelector('#nik').value = userData.nik;
        }
        if (!form.querySelector('#email').value && userData.email) {
            form.querySelector('#email').value = userData.email;
        }
        @endauth
    });
</script>
@endsection

@include('layouts.footer')
@endsection