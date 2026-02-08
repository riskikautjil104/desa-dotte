@extends('layouts.main', ['title' => 'Dashboard Data Desa'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Dashboard Data Desa',
        'subtitle' => 'Temukan data statistik dan informasi terbaru tentang Desa Dotte',
        'breadcrumb' => 'Data Desa',
        'showBreadcrumb' => true,
    ])
@endsection

<!-- ======= Data Desa Dashboard ======= -->
<section id="data-desa" class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <!-- Header Section -->
        <div class="section-title text-center mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">Dashboard Data Desa Interaktif</h2>
            <p class="text-muted lead">Visualisasi data dan statistik real-time Desa Dotte</p>
        </div>

        <!-- Summary Cards -->
        <div class="row g-3 mb-4">
            <!-- Total Penduduk -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                <i class="bi bi-people-fill fs-4" style="color: #0dcdbd;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Total Penduduk</h6>
                                <h3 class="fw-bold mb-0" style="color: #0dcdbd;">
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $totalPenduduk }}"
                                        data-purecounter-duration="1.5" class="purecounter">0</span>
                                </h3>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" style="width: 100%; background-color: #0dcdbd;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laki-Laki -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 110, 253, 0.1);">
                                <i class="bi bi-gender-male fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Laki-Laki</h6>
                                <h3 class="fw-bold mb-0 text-primary">
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $totalLakiLaki }}"
                                        data-purecounter-duration="1.5" class="purecounter">0</span>
                                </h3>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" style="width: {{ $totalPenduduk > 0 ? ($totalLakiLaki / $totalPenduduk) * 100 : 0 }}%; background-color: #0d6efd;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perempuan -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(220, 53, 69, 0.1);">
                                <i class="bi bi-gender-female fs-4 text-danger"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Perempuan</h6>
                                <h3 class="fw-bold mb-0 text-danger">
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $totalPerempuan }}"
                                        data-purecounter-duration="1.5" class="purecounter">0</span>
                                </h3>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" style="width: {{ $totalPenduduk > 0 ? ($totalPerempuan / $totalPenduduk) * 100 : 0 }}%; background-color: #dc3545;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kepala Keluarga -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(255, 193, 7, 0.1);">
                                <i class="bi bi-house-door-fill fs-4 text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Kepala Keluarga</h6>
                                <h3 class="fw-bold mb-0 text-warning">
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $totalKK }}"
                                        data-purecounter-duration="1.5" class="purecounter">0</span>
                                </h3>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" style="width: 100%; background-color: #ffc107;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- UMKM Aktif -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(25, 135, 84, 0.1);">
                                <i class="bi bi-shop fs-4 text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">UMKM Aktif</h6>
                                <h3 class="fw-bold mb-0 text-success">
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $totalUMKM }}"
                                        data-purecounter-duration="1.5" class="purecounter">0</span>
                                </h3>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" style="width: 100%; background-color: #198754;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rasio Gender -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(111, 66, 193, 0.1);">
                                <i class="bi bi-graph-up fs-4" style="color: #6f42c1;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Rasio Gender</h6>
                                <h3 class="fw-bold mb-0" style="color: #6f42c1;">
                                    {{ $totalPenduduk > 0 ? round(($totalLakiLaki / $totalPenduduk) * 100, 1) : 0 }}%
                                </h3>
                                <small class="text-muted">Laki-laki : Perempuan</small>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" style="width: {{ $totalPenduduk > 0 ? ($totalLakiLaki / $totalPenduduk) * 100 : 0 }}%; background-color: #6f42c1;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row g-4">
            <!-- Left Column - Charts -->
            <div class="col-lg-8">
                <!-- Charts Row 1 -->
                <div class="row g-4 mb-4">
                    <!-- Agama Chart -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                                        <i class="bi bi-pie-chart-fill me-2" style="color: #0dcdbd;"></i>
                                        Distribusi Agama
                                    </h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="downloadChart('agamaChart')">Unduh Chart</a></li>
                                            <li><a class="dropdown-item" href="{{ route('agama') }}">Lihat Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="agamaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelompok Umur Chart -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                                        <i class="bi bi-people-fill me-2 text-info"></i>
                                        Kelompok Umur
                                    </h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="downloadChart('kelompokUmurChart')">Unduh Chart</a></li>
                                            <li><a class="dropdown-item" href="{{ route('kelompok_umur') }}">Lihat Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="kelompokUmurChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Pekerjaan Chart -->
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                                        <i class="bi bi-briefcase-fill me-2 text-success"></i>
                                        Top 10 Pekerjaan Penduduk
                                    </h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="downloadChart('pekerjaanChart')">Unduh Chart</a></li>
                                            <li><a class="dropdown-item" href="{{ route('pekerjaan') }}">Lihat Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-container" style="height: 250px;">
                                    <canvas id="pekerjaanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perkembangan Penduduk -->
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                                        <i class="bi bi-graph-up-arrow me-2 text-primary"></i>
                                        Perkembangan Penduduk
                                    </h5>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-primary btn-sm active" id="btn-bulan-ini" onclick="filterPerkembangan('bulan-ini')">
                                            Bulan Ini
                                        </button>
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="btn-bulan-lalu" onclick="filterPerkembangan('bulan-lalu')">
                                            Bulan Lalu
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <!-- Bulan Ini Stats -->
                                <div class="row g-3 mb-4" id="stats-bulan-ini">
                                    @foreach([
                                        ['count' => $kelahiranBulanIni, 'label' => 'Kelahiran', 'color' => 'success', 'icon' => 'bi-balloon-heart-fill'],
                                        ['count' => $masukBulanIni, 'label' => 'Penduduk Masuk', 'color' => 'primary', 'icon' => 'bi-person-plus-fill'],
                                        ['count' => $keluarBulanIni, 'label' => 'Penduduk Keluar', 'color' => 'warning', 'icon' => 'bi-person-dash-fill'],
                                        ['count' => $meninggalBulanIni, 'label' => 'Kematian', 'color' => 'danger', 'icon' => 'bi-emoji-dizzy-fill']
                                    ] as $stat)
                                    <div class="col-6 col-md-3">
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background-color: rgba(var(--bs-{{ $stat['color'] }}-rgb), 0.1);">
                                            <div class="flex-shrink-0">
                                                <i class="bi {{ $stat['icon'] }} fs-3 text-{{ $stat['color'] }}"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 fw-bold text-{{ $stat['color'] }}">{{ $stat['count'] }}</h6>
                                                <small class="text-muted">{{ $stat['label'] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Bulan Lalu Stats -->
                                <div class="row g-3 mb-4 d-none" id="stats-bulan-lalu">
                                    @foreach([
                                        ['count' => $kelahiranBulanLalu, 'label' => 'Kelahiran', 'color' => 'success', 'icon' => 'bi-balloon-heart-fill'],
                                        ['count' => $masukBulanLalu, 'label' => 'Penduduk Masuk', 'color' => 'primary', 'icon' => 'bi-person-plus-fill'],
                                        ['count' => $keluarBulanLalu, 'label' => 'Penduduk Keluar', 'color' => 'warning', 'icon' => 'bi-person-dash-fill'],
                                        ['count' => $meninggalBulanLalu, 'label' => 'Kematian', 'color' => 'danger', 'icon' => 'bi-emoji-dizzy-fill']
                                    ] as $stat)
                                    <div class="col-6 col-md-3">
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background-color: rgba(var(--bs-{{ $stat['color'] }}-rgb), 0.1);">
                                            <div class="flex-shrink-0">
                                                <i class="bi {{ $stat['icon'] }} fs-3 text-{{ $stat['color'] }}"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 fw-bold text-{{ $stat['color'] }}">{{ $stat['count'] }}</h6>
                                                <small class="text-muted">{{ $stat['label'] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Perkembangan Chart -->
                                <div class="chart-container" style="height: 250px;">
                                    <canvas id="perkembanganPendudukChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Charts -->
                <div class="row g-4">
                    <!-- Monthly Trend -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 fw-bold d-flex align-items-center">
                                    <i class="bi bi-line-chart me-2 text-warning"></i>
                                    Tren Penduduk (12 Bulan)
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-container" style="height: 250px;">
                                    <canvas id="monthlyTrendChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- UMKM Kategori -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 fw-bold d-flex align-items-center">
                                    <i class="bi bi-shop-window me-2 text-dark"></i>
                                    UMKM Berdasarkan Kategori
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-container" style="height: 250px;">
                                    <canvas id="umkmKategoriChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-sidebar" style="top: 20px;">
                    <!-- Quick Stats -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header text-white border-0 py-3" style="background-color: #0dcdbd;">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-lightning-charge-fill me-2"></i>
                                Statistik Cepat
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-event me-3" style="color: #0dcdbd;"></i>
                                        <span>Total Agenda</span>
                                    </div>
                                    <span class="badge" style="background-color: #0dcdbd;">{{ $totalAgenda }}</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-newspaper me-3 text-info"></i>
                                        <span>Total Berita</span>
                                    </div>
                                    <span class="badge bg-info">{{ $totalBerita }}</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock-history me-3 text-warning"></i>
                                        <span>Update Terakhir</span>
                                    </div>
                                    <small class="text-muted">{{ Carbon\Carbon::now()->format('d/m/Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Agenda -->
                    @if($recentAgenda->count() > 0)
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-warning border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-calendar-date me-2"></i>
                                Agenda Terbaru
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="list-group list-group-flush">
                                @foreach($recentAgenda as $agenda)
                                <a href="{{ route('frontend.agenda.detail', $agenda->id) }}" 
                                   class="list-group-item list-group-item-action d-flex align-items-center px-0 py-3 border-0">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle p-2 me-3" style="background-color: rgba(255, 193, 7, 0.1);">
                                            <i class="bi bi-calendar-event text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 text-dark">{{ Str::limit($agenda->judul, 35) }}</h6>
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                                        </small>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.agenda') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-eye me-1"></i>Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Recent UMKM -->
                    @if($recentUMKM->count() > 0)
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-dark text-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-shop me-2"></i>
                                UMKM Terbaru
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="list-group list-group-flush">
                                @foreach($recentUMKM as $umkm)
                                <a href="{{ route('frontend.umkm.detail', $umkm->id) }}" 
                                   class="list-group-item list-group-item-action d-flex align-items-center px-0 py-3 border-0">
                                    <div class="flex-shrink-0">
                                        @if($umkm->gambar_utama)
                                            <img src="{{ asset('storage/' . $umkm->gambar_utama) }}" 
                                                 alt="{{ $umkm->nama_usaha }}" 
                                                 class="rounded-circle"
                                                 style="width: 45px; height: 45px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 45px; height: 45px;">
                                                <i class="bi bi-shop text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-dark">{{ Str::limit($umkm->nama_usaha, 25) }}</h6>
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-person me-1"></i>
                                            {{ $umkm->pemilik }}
                                        </small>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.umkm') }}" class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-eye me-1"></i>Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Data Export -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-info text-white border-0 py-3">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-download me-2"></i>
                                Export Data
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-grid gap-2">
                                <button onclick="exportData('penduduk')" class="btn btn-outline-info btn-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people me-2"></i>Data Penduduk
                                </button>
                                <button onclick="exportData('statistik')" class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bar-chart me-2"></i>Statistik Desa
                                </button>
                                <a href="{{ route('datapenduduk.export') }}" 
                                   class="btn btn-sm d-flex align-items-center justify-content-center"
                                   style="border-color: #0dcdbd; color: #0dcdbd;">
                                    <i class="bi bi-file-earmark-excel me-2"></i>Export Excel
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
    /* Custom Styles for Data Desa Dashboard */
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
    
    /* Progress bar styling */
    .progress {
        background-color: rgba(13, 205, 189, 0.1);
        border-radius: 10px;
    }
    
    .progress-bar {
        border-radius: 10px;
    }
    
    /* Chart containers */
    .chart-container {
        position: relative;
        width: 100%;
    }
    
    /* List group styling */
    .list-group-item:hover {
        background-color: rgba(13, 205, 189, 0.05);
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
        
        h3.fw-bold {
            font-size: 1.5rem;
        }
        
        h5.fw-bold {
            font-size: 1.1rem;
        }
        
        .chart-container {
            height: 250px !important;
        }
        
        .sticky-sidebar {
            position: static;
            max-height: none;
            margin-top: 2rem;
        }
    }
    
    @media (max-width: 576px) {
        .section-title h2 {
            font-size: 1.5rem;
        }
        
        h3.fw-bold {
            font-size: 1.25rem;
        }
        
        .card-header h5 {
            font-size: 1rem;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .chart-container {
            height: 200px !important;
        }
        
        /* Adjust summary cards for small screens */
        .col-6 {
            margin-bottom: 1rem;
        }
    }
    
    /* Animation for counters */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .purecounter {
        animation: countUp 0.5s ease;
    }
</style>

@section('js')
<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize PureCounter
        new PureCounter();
        
        // Color palette for charts
        const chartColors = {
            primary: '#0dcdbd',
            secondary: '#6c757d',
            success: '#198754',
            danger: '#dc3545',
            warning: '#ffc107',
            info: '#0dcaf0',
            light: '#f8f9fa',
            dark: '#212529'
        };

        // Agama Chart
        const agamaCtx = document.getElementById('agamaChart').getContext('2d');
        new Chart(agamaCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($agamaStats->keys()) !!},
                datasets: [{
                    data: {!! json_encode($agamaStats->values()) !!},
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.success,
                        chartColors.info,
                        chartColors.warning,
                        chartColors.danger,
                        chartColors.secondary
                    ],
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Kelompok Umur Chart
        const kelompokUmurCtx = document.getElementById('kelompokUmurChart').getContext('2d');
        new Chart(kelompokUmurCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($kelompokUmur)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($kelompokUmur)) !!},
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56'
                    ],
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Pekerjaan Chart
        const pekerjaanCtx = document.getElementById('pekerjaanChart').getContext('2d');
        new Chart(pekerjaanCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($pekerjaanStats->pluck('pekerjaan')->take(10)->toArray()) !!},
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: {!! json_encode($pekerjaanStats->pluck('count')->take(10)->toArray()) !!},
                    backgroundColor: chartColors.primary,
                    borderColor: chartColors.primary,
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 0
                        }
                    }
                }
            }
        });

        // Monthly Trend Chart
        const monthlyTrendCtx = document.getElementById('monthlyTrendChart').getContext('2d');
        const monthlyLabels = {!! json_encode(collect($monthlyTrend)->pluck('month')->toArray()) !!};
        new Chart(monthlyTrendCtx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Laki-Laki',
                    data: {!! json_encode(collect($monthlyTrend)->pluck('laki')->toArray()) !!},
                    borderColor: chartColors.primary,
                    backgroundColor: 'rgba(13, 205, 189, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Perempuan',
                    data: {!! json_encode(collect($monthlyTrend)->pluck('perempuan')->toArray()) !!},
                    borderColor: '#FF6384',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // UMKM Kategori Chart
        const umkmKategoriCtx = document.getElementById('umkmKategoriChart').getContext('2d');
        const umkmCategories = {!! json_encode($umkmKategori->keys()->map(function($key) { 
            return ucwords(str_replace('_', ' ', $key)); 
        })->toArray()) !!};
        
        new Chart(umkmKategoriCtx, {
            type: 'bar',
            data: {
                labels: umkmCategories,
                datasets: [{
                    label: 'Jumlah UMKM',
                    data: {!! json_encode($umkmKategori->values()->toArray()) !!},
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.success,
                        chartColors.info,
                        chartColors.warning,
                        chartColors.danger
                    ],
                    borderColor: [
                        chartColors.primary,
                        chartColors.success,
                        chartColors.info,
                        chartColors.warning,
                        chartColors.danger
                    ],
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Perkembangan Penduduk Chart
        const perkembanganPendudukCtx = document.getElementById('perkembanganPendudukChart').getContext('2d');
        const perkembanganLabels = {!! json_encode(collect($perkembanganPenduduk)->pluck('month')->toArray()) !!};
        new Chart(perkembanganPendudukCtx, {
            type: 'bar',
            data: {
                labels: perkembanganLabels,
                datasets: [{
                    label: 'Kelahiran',
                    data: {!! json_encode(collect($perkembanganPenduduk)->pluck('kelahiran')->toArray()) !!},
                    backgroundColor: chartColors.success,
                    borderColor: chartColors.success,
                    borderWidth: 1
                }, {
                    label: 'Masuk',
                    data: {!! json_encode(collect($perkembanganPenduduk)->pluck('masuk')->toArray()) !!},
                    backgroundColor: chartColors.primary,
                    borderColor: chartColors.primary,
                    borderWidth: 1
                }, {
                    label: 'Keluar',
                    data: {!! json_encode(collect($perkembanganPenduduk)->pluck('keluar')->toArray()) !!},
                    backgroundColor: chartColors.warning,
                    borderColor: chartColors.warning,
                    borderWidth: 1
                }, {
                    label: 'Kematian',
                    data: {!! json_encode(collect($perkembanganPenduduk)->pluck('meninggal')->toArray()) !!},
                    backgroundColor: chartColors.danger,
                    borderColor: chartColors.danger,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Handle window resize for charts
        function resizeCharts() {
            Chart.instances.forEach(instance => {
                instance.resize();
            });
        }

        window.addEventListener('resize', resizeCharts);
    });

    // Filter perkembangan penduduk
    function filterPerkembangan(period) {
        const bulanIniStats = document.getElementById('stats-bulan-ini');
        const bulanLaluStats = document.getElementById('stats-bulan-lalu');
        const btnBulanIni = document.getElementById('btn-bulan-ini');
        const btnBulanLalu = document.getElementById('btn-bulan-lalu');

        if (period === 'bulan-ini') {
            bulanIniStats.classList.remove('d-none');
            bulanLaluStats.classList.add('d-none');
            btnBulanIni.classList.add('active');
            btnBulanLalu.classList.remove('active');
        } else {
            bulanIniStats.classList.add('d-none');
            bulanLaluStats.classList.remove('d-none');
            btnBulanIni.classList.remove('active');
            btnBulanLalu.classList.add('active');
        }
    }

    // Download chart as image
    function downloadChart(chartId) {
        const chart = Chart.getChart(chartId);
        if (chart) {
            const link = document.createElement('a');
            link.download = `chart-${chartId}-${new Date().toISOString().split('T')[0]}.png`;
            link.href = chart.toBase64Image();
            link.click();
            
            showToast('Chart berhasil diunduh!', 'success');
        }
    }

    // Export data function
    function exportData(type) {
        showToast(`Mempersiapkan data ${type}...`, 'info');
        
        fetch(`/data-desa/api/export?type=${type}&format=json`)
            .then(response => response.json())
            .then(data => {
                const blob = new Blob([JSON.stringify(data, null, 2)], {
                    type: 'application/json'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `${data.filename}.json`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                
                showToast('Data berhasil diexport!', 'success');
            })
            .catch(error => {
                console.error('Export error:', error);
                showToast('Error exporting data. Please try again.', 'error');
            });
    }

    // Toast notification
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
        
        toast.addEventListener('hidden.bs.toast', function() {
            container.remove();
        });
    }
</script>
@endsection

@include('layouts.footer')
@endsection