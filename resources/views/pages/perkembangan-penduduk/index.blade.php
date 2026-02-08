@extends('layouts.main')

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Perkembangan Penduduk',
        'subtitle' => 'Statistik dan perkembangan penduduk Desa Dotte',
        'breadcrumb' => 'Perkembangan Penduduk',
        'showBreadcrumb' => true,
    ])
@endsection

<!-- ======= Perkembangan Penduduk Section ======= -->
<section id="perkembangan-penduduk" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="section-title mb-5 text-center text-lg-start">
            <h2 class="fw-bold mb-3">Dashboard Perkembangan Penduduk</h2>
            <p class="text-muted lead">Informasi lengkap tentang perkembangan dan statistik penduduk Desa Dotte</p>
        </div>

        {{-- Summary Cards --}}
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4 text-center">
                        <div class="icon-box mb-3">
                            <i class="bi bi-people-fill" style="font-size: 2.5rem; color: #0dcdbd;"></i>
                        </div>
                        <h3 class="fw-bold mb-2" style="color: #0dcdbd;">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalPenduduk }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="text-muted mb-0">Penduduk Tetap</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4 text-center">
                        <div class="icon-box mb-3">
                            <i class="bi bi-person-badge text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-success mb-2">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalPendudukSementara }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="text-muted mb-0">Penduduk Sementara</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4 text-center">
                        <div class="icon-box mb-3">
                            <i class="bi bi-gender-male text-info" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-info mb-2">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalLakiLaki + $sementaraLakiLaki }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="text-muted mb-0">Total Laki-Laki</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4 text-center">
                        <div class="icon-box mb-3">
                            <i class="bi bi-gender-female text-danger" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-danger mb-2">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalPerempuan + $sementaraPerempuan }}"
                                data-purecounter-duration="1" class="purecounter">0</span>
                        </h3>
                        <p class="text-muted mb-0">Total Perempuan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Perkembangan Penduduk Section --}}
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <h5 class="mb-2 mb-md-0 fw-bold">
                                <i class="bi bi-people me-2 text-success"></i>Perkembangan Penduduk
                            </h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-success btn-sm active"
                                    onclick="filterPerkembanganPenduduk('bulan_ini')" id="perkembangan-btn-bulan-ini">
                                    <span class="d-none d-md-inline">Bulan Ini</span>
                                    <span class="d-inline d-md-none">Sekarang</span>
                                </button>
                                <button type="button" class="btn btn-outline-success btn-sm"
                                    onclick="filterPerkembanganPenduduk('bulan_lalu')" id="perkembangan-btn-bulan-lalu">
                                    <span class="d-none d-md-inline">Bulan Lalu</span>
                                    <span class="d-inline d-md-none">Lalu</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 p-md-4">
                        {{-- Bulan Ini Stats --}}
                        <div class="row g-2 g-md-3" id="perkembangan-stats-bulan-ini">
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 bg-success bg-opacity-10 rounded-3 h-100">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-balloon-heart-fill text-success fs-4 fs-md-3"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 text-success fw-bold">{{ $rekap['bulan_ini']['kelahiran'] }}</h6>
                                        <small class="text-muted">Kelahiran</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 rounded-3 h-100" style="background-color: rgba(13, 205, 189, 0.1);">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-person-plus-fill fs-4 fs-md-3" style="color: #0dcdbd;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 fw-bold" style="color: #0dcdbd;">{{ $rekap['bulan_ini']['masuk'] }}</h6>
                                        <small class="text-muted">Penduduk Masuk</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 bg-warning bg-opacity-10 rounded-3 h-100">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-person-dash-fill text-warning fs-4 fs-md-3"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 text-warning fw-bold">{{ $rekap['bulan_ini']['keluar'] }}</h6>
                                        <small class="text-muted">Penduduk Keluar</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 bg-danger bg-opacity-10 rounded-3 h-100">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-emoji-dizzy-fill text-danger fs-4 fs-md-3"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 text-danger fw-bold">{{ $rekap['bulan_ini']['meninggal'] }}</h6>
                                        <small class="text-muted">Kematian</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bulan Lalu Stats (Hidden by default) --}}
                        <div class="row g-2 g-md-3 d-none" id="perkembangan-stats-bulan-lalu">
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 bg-success bg-opacity-10 rounded-3 h-100">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-balloon-heart-fill text-success fs-4 fs-md-3"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 text-success fw-bold">{{ $rekap['bulan_lalu']['kelahiran'] }}</h6>
                                        <small class="text-muted">Kelahiran</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 rounded-3 h-100" style="background-color: rgba(13, 205, 189, 0.1);">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-person-plus-fill fs-4 fs-md-3" style="color: #0dcdbd;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 fw-bold" style="color: #0dcdbd;">{{ $rekap['bulan_lalu']['masuk'] }}</h6>
                                        <small class="text-muted">Penduduk Masuk</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 bg-warning bg-opacity-10 rounded-3 h-100">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-person-dash-fill text-warning fs-4 fs-md-3"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 text-warning fw-bold">{{ $rekap['bulan_lalu']['keluar'] }}</h6>
                                        <small class="text-muted">Penduduk Keluar</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center p-2 p-md-3 bg-danger bg-opacity-10 rounded-3 h-100">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-emoji-dizzy-fill text-danger fs-4 fs-md-3"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-md-3">
                                        <h6 class="mb-0 text-danger fw-bold">{{ $rekap['bulan_lalu']['meninggal'] }}</h6>
                                        <small class="text-muted">Kematian</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Charts Grid --}}
                <div class="row g-4 mb-4">
                    {{-- Jenis Kelamin Chart --}}
                    <div class="col-lg-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-pie-chart me-2" style="color: #0dcdbd;"></i>
                                    <span class="d-none d-md-inline">Jenis Kelamin</span>
                                    <span class="d-inline d-md-none">Gender</span>
                                    <small class="text-muted d-block d-md-inline d-lg-block">(Penduduk Sementara)</small>
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart-container" style="height: 250px;">
                                    <canvas id="sementaraGenderChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Agama Chart --}}
                    <div class="col-lg-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-pie-chart me-2 text-info"></i>
                                    <span class="d-none d-md-inline">Agama</span>
                                    <small class="text-muted d-block d-md-inline d-lg-block">(Penduduk Sementara)</small>
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart-container" style="height: 250px;">
                                    <canvas id="sementaraAgamaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tujuan Tinggal Chart --}}
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-geo-alt me-2 text-warning"></i>Tujuan Tinggal Penduduk Sementara
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart-container" style="height: 220px;">
                                    <canvas id="sementaraTujuanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kelompok Umur Chart --}}
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-bar-chart me-2 text-success"></i>
                                    <span class="d-none d-md-inline">Kelompok Umur</span>
                                    <span class="d-inline d-md-none">Kel. Umur</span>
                                    <small class="text-muted">(Penduduk Sementara)</small>
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart-container" style="height: 220px;">
                                    <canvas id="sementaraKelompokUmurChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Perkembangan Trend Chart --}}
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-graph-up-arrow me-2 text-info"></i>
                                    <span class="d-none d-lg-inline">Trend Perkembangan Penduduk</span>
                                    <span class="d-inline d-lg-none">Trend Penduduk</span>
                                    <small class="text-muted">(6 Bulan Terakhir)</small>
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart-container" style="height: 220px;">
                                    <canvas id="perkembanganPendudukChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabel Penduduk Sementara --}}
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-table me-2 text-dark"></i>Data Penduduk Sementara Terbaru
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Nama</th>
                                        <th width="120">Gender</th>
                                        <th>Alamat Asal</th>
                                        <th width="150">Tujuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendudukSementaraTerbaru as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ Str::limit($item->nama, 20) }}</td>
                                            <td>
                                                @if($item->jenis_kelamin == 'LAKI-LAKI')
                                                    <span class="badge py-1 px-2" style="background-color: #0dcdbd; font-size: 0.75rem;">
                                                        <i class="bi bi-gender-male me-1"></i>L
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger py-1 px-2" style="font-size: 0.75rem;">
                                                        <i class="bi bi-gender-female me-1"></i>P
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($item->alamat_asal, 25) }}</td>
                                            <td>{{ Str::limit($item->tujuan_tinggal, 15) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="bi bi-database-exclamation fs-4 mb-2 d-block"></i>
                                                    Tidak ada data penduduk sementara
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="sticky-sidebar" style="top: 20px;">

                    {{-- Quick Stats --}}
                    <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-left">
                        <div class="card-header bg-success text-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-person-badge me-2"></i>Statistik Penduduk Sementara
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Laki-Laki</span>
                                <span class="badge" style="background-color: #0dcdbd; font-size: 0.9rem;">{{ $sementaraLakiLaki }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Perempuan</span>
                                <span class="badge bg-danger" style="font-size: 0.9rem;">{{ $sementaraPerempuan }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Total KK</span>
                                <span class="badge bg-warning text-dark" style="font-size: 0.9rem;">{{ $totalKK }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Ringkasan Bulan Ini --}}
                    <div class="card border-0 shadow-sm rounded-3 mb-4" data-aos="fade-left" data-aos-delay="100">
                        <div class="card-header bg-info text-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-graph-up me-2"></i>Ringkasan Bulan Ini
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-success">
                                    <i class="bi bi-balloon-heart-fill me-1"></i>
                                    <span class="d-none d-md-inline">Kelahiran</span>
                                    <span class="d-inline d-md-none">Lahir</span>
                                </span>
                                <span class="fw-bold text-success">{{ $rekap['bulan_ini']['kelahiran'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span style="color: #0dcdbd;">
                                    <i class="bi bi-person-plus-fill me-1"></i>
                                    <span class="d-none d-md-inline">Masuk</span>
                                </span>
                                <span class="fw-bold" style="color: #0dcdbd;">{{ $rekap['bulan_ini']['masuk'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-warning">
                                    <i class="bi bi-person-dash-fill me-1"></i>
                                    <span class="d-none d-md-inline">Keluar</span>
                                </span>
                                <span class="fw-bold text-warning">{{ $rekap['bulan_ini']['keluar'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-danger">
                                    <i class="bi bi-emoji-dizzy-fill me-1"></i>
                                    <span class="d-none d-md-inline">Meninggal</span>
                                    <span class="d-inline d-md-none">Wafat</span>
                                </span>
                                <span class="fw-bold text-danger">{{ $rekap['bulan_ini']['meninggal'] }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Menu Terkait --}}
                    <div class="card border-0 shadow-sm rounded-3" data-aos="fade-left" data-aos-delay="200">
                        <div class="card-header bg-dark text-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-link-45deg me-2"></i>Menu Terkait
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('frontend.data-desa') }}" class="btn btn-outline-dark btn-sm text-start">
                                    <i class="bi bi-bar-chart me-2"></i>Data Desa Lengkap
                                </a>
                                <a href="{{ route('jenis_kelamin') }}" class="btn btn-sm text-start" style="border-color: #0dcdbd; color: #0dcdbd;">
                                    <i class="bi bi-gender-ambiguous me-2"></i>Statistik Jenis Kelamin
                                </a>
                                <a href="{{ route('kelompok_umur') }}" class="btn btn-outline-success btn-sm text-start">
                                    <i class="bi bi-people me-2"></i>Statistik Umur
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<style>
    /* Responsive Styles */
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
    }

    .icon-box {
        transition: transform 0.3s ease;
    }

    .card:hover .icon-box {
        transform: scale(1.05);
    }

    .sticky-sidebar {
        position: -webkit-sticky;
        position: sticky;
        z-index: 100;
    }

    .chart-container {
        position: relative;
        min-height: 200px;
    }

    .purecounter {
        font-size: 1.75rem !important;
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .section-title h2 {
            font-size: 1.75rem;
        }
        
        .section-title p {
            font-size: 1rem;
        }
        
        .card-body {
            padding: 1rem !important;
        }
        
        .purecounter {
            font-size: 1.5rem !important;
        }
        
        .table td, .table th {
            padding: 0.5rem !important;
            font-size: 0.875rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .card-header h5 {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .section-title h2 {
            font-size: 1.5rem;
        }
        
        .purecounter {
            font-size: 1.25rem !important;
        }
        
        .icon-box i {
            font-size: 2rem !important;
        }
        
        .card {
            margin-bottom: 1rem;
        }
        
        .sticky-sidebar {
            position: static;
        }
    }

    /* Tablet Optimizations */
    @media (max-width: 992px) and (min-width: 768px) {
        .chart-container {
            height: 200px !important;
        }
    }

    /* Scrollbar for sidebar on mobile */
    @media (max-height: 700px) and (min-width: 992px) {
        .sticky-sidebar {
            max-height: calc(100vh - 120px);
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
            background: #888;
            border-radius: 10px;
        }
    }
</style>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Initialize Charts with responsive settings
    document.addEventListener('DOMContentLoaded', function() {
        // Common chart options for responsiveness
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 15,
                        font: {
                            size: window.innerWidth < 768 ? 10 : 12
                        }
                    }
                }
            }
        };

        // Jenis Kelamin Penduduk Sementara Chart
        const sementaraGenderCtx = document.getElementById('sementaraGenderChart').getContext('2d');
        new Chart(sementaraGenderCtx, {
            type: 'pie',
            data: {
                labels: ['Laki-Laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $sementaraLakiLaki }}, {{ $sementaraPerempuan }}],
                    backgroundColor: ['#0dcdbd', '#FF6384'],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                label += value + ' (' + percentage + '%)';
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Agama Penduduk Sementara Chart
        const sementaraAgamaCtx = document.getElementById('sementaraAgamaChart').getContext('2d');
        new Chart(sementaraAgamaCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($sementaraAgama->keys()->toArray()) !!},
                datasets: [{
                    data: {!! json_encode($sementaraAgama->values()->toArray()) !!},
                    backgroundColor: ['#FF6384', '#0dcdbd', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF'],
                    borderWidth: 0
                }]
            },
            options: chartOptions
        });

        // Tujuan Tinggal Chart
        const sementaraTujuanCtx = document.getElementById('sementaraTujuanChart').getContext('2d');
        new Chart(sementaraTujuanCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(
                    $sementaraTujuan->keys()->map(function ($key) {
                        return window.innerWidth < 768 ? 
                            $key.split('_')[0] : 
                            ucfirst(str_replace('_', ' ', $key));
                    })->toArray(),
                ) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($sementaraTujuan->values()->toArray()) !!},
                    backgroundColor: '#FFCE56',
                    borderColor: '#FFCE56',
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    }
                }
            }
        });

        // Kelompok Umur Chart
        const sementaraKelompokUmurCtx = document.getElementById('sementaraKelompokUmurChart').getContext('2d');
        new Chart(sementaraKelompokUmurCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($sementaraKelompokUmur)) !!},
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: {!! json_encode(array_values($sementaraKelompokUmur)) !!},
                    backgroundColor: '#4BC0C0',
                    borderColor: '#4BC0C0',
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    }
                }
            }
        });

        // Perkembangan Penduduk Chart
        const perkembanganPendudukCtx = document.getElementById('perkembanganPendudukChart').getContext('2d');
        new Chart(perkembanganPendudukCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(collect($perkembanganPenduduk)->pluck('month')->toArray()) !!},
                datasets: [
                    {
                        label: 'Lahir',
                        data: {!! json_encode(collect($perkembanganPenduduk)->pluck('kelahiran')->toArray()) !!},
                        backgroundColor: '#28a745',
                        borderColor: '#28a745',
                        borderWidth: 1
                    },
                    {
                        label: 'Masuk',
                        data: {!! json_encode(collect($perkembanganPenduduk)->pluck('masuk')->toArray()) !!},
                        backgroundColor: '#0dcdbd',
                        borderColor: '#0dcdbd',
                        borderWidth: 1
                    },
                    {
                        label: 'Keluar',
                        data: {!! json_encode(collect($perkembanganPenduduk)->pluck('keluar')->toArray()) !!},
                        backgroundColor: '#ffc107',
                        borderColor: '#ffc107',
                        borderWidth: 1
                    },
                    {
                        label: 'Wafat',
                        data: {!! json_encode(collect($perkembanganPenduduk)->pluck('meninggal')->toArray()) !!},
                        backgroundColor: '#dc3545',
                        borderColor: '#dc3545',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    }
                }
            }
        });

        // Helper function for capitalize
        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    });

    // Filter perkembangan penduduk
    function filterPerkembanganPenduduk(period) {
        const statsBulanIni = document.getElementById('perkembangan-stats-bulan-ini');
        const statsBulanLalu = document.getElementById('perkembangan-stats-bulan-lalu');
        const btnBulanIni = document.getElementById('perkembangan-btn-bulan-ini');
        const btnBulanLalu = document.getElementById('perkembangan-btn-bulan-lalu');
        
        if (period === 'bulan_ini') {
            statsBulanIni.classList.remove('d-none');
            statsBulanLalu.classList.add('d-none');
            btnBulanIni.classList.add('active');
            btnBulanLalu.classList.remove('active');
        } else {
            statsBulanIni.classList.add('d-none');
            statsBulanLalu.classList.remove('d-none');
            btnBulanIni.classList.remove('active');
            btnBulanLalu.classList.add('active');
        }
    }
</script>

@include('layouts.footer')
@endsection