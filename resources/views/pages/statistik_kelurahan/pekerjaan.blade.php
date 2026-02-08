@extends('layouts.main', ['title' => 'Statistik Berdasarkan Pekerjaan'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Statistik Berdasarkan Pekerjaan',
        'subtitle' => 'Temukan statistik berdasarkan pekerjaan terbaru tentang Desa Dotte',
        'breadcrumb' => 'Pekerjaan',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Statistik Section ======= -->
<section id="statistik" class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center text-lg-start mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">Statistik Pekerjaan</h2>
            <p class="text-muted lead">Data distribusi penduduk berdasarkan pekerjaan di Desa Dotte</p>
        </div>

        <div class="row g-4 g-lg-5">
            <!-- Sidebar Navigation -->
            <div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
                <div class="sticky-sidebar" style="top: 20px;">
                    <!-- Statistik Penduduk -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header text-white border-0 py-3" style="background-color: #0dcdbd;">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-pie-chart-fill me-2"></i>Statistik Penduduk
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="nav flex-column">
                                <a href="{{ route('jenis_kelamin') }}" 
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2">
                                    <i class="bi bi-gender-ambiguous me-3 fs-5 text-muted"></i>
                                    <div>
                                        <span class="fw-medium d-block">Jenis Kelamin</span>
                                        <small class="text-muted">Distribusi Laki-laki & Perempuan</small>
                                    </div>
                                </a>
                                
                                <a href="{{ route('agama') }}" 
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2">
                                    <i class="bi bi-pray me-3 fs-5 text-muted"></i>
                                    <div>
                                        <span class="fw-medium d-block">Agama</span>
                                        <small class="text-muted">Data berdasarkan agama</small>
                                    </div>
                                </a>
                                
                                <a href="{{ route('pekerjaan') }}" 
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2 active" 
                                   style="background-color: rgba(13, 205, 189, 0.1);">
                                    <i class="bi bi-briefcase me-3 fs-5" style="color: #0dcdbd;"></i>
                                    <div>
                                        <span class="fw-medium d-block">Pekerjaan</span>
                                        <small class="text-muted">Distribusi pekerjaan</small>
                                    </div>
                                </a>
                                
                                <a href="{{ route('pendidikan') }}" 
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2">
                                    <i class="bi bi-mortarboard me-3 fs-5 text-muted"></i>
                                    <div>
                                        <span class="fw-medium d-block">Pendidikan</span>
                                        <small class="text-muted">Tingkat pendidikan</small>
                                    </div>
                                </a>
                                
                                <a href="{{ route('kelompok_umur') }}" 
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2">
                                    <i class="bi bi-people me-3 fs-5 text-muted"></i>
                                    <div>
                                        <span class="fw-medium d-block">Kelompok Umur</span>
                                        <small class="text-muted">Distribusi usia penduduk</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-lightning me-2" style="color: #0dcdbd;"></i>Ringkasan
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            @php
                                $totalPenduduk = $penduduk->count();
                                // Cari pekerjaan dengan jumlah terbanyak
                                $topPekerjaan = null;
                                $maxCount = 0;
                                foreach ($pekerjaan as $pk) {
                                    $count = $penduduk->where('id_pekerjaan', $pk->id)->count();
                                    if ($count > $maxCount) {
                                        $maxCount = $count;
                                        $topPekerjaan = $pk;
                                    }
                                }
                                $percentageTop = $totalPenduduk > 0 ? round(($maxCount / $totalPenduduk) * 100, 2) : 0;
                                
                                // Hitung pekerja produktif (pekerjaan bukan 'TIDAK BEKERJA' atau 'PELAJAR/MAHASISWA')
                                $produktifCount = 0;
                                foreach ($pekerjaan as $pk) {
                                    $nama = strtolower($pk->nama_pekerjaan);
                                    if (!str_contains($nama, 'tidak') && !str_contains($nama, 'pelajar') && !str_contains($nama, 'mahasiswa')) {
                                        $produktifCount += $penduduk->where('id_pekerjaan', $pk->id)->count();
                                    }
                                }
                                $percentageProduktif = $totalPenduduk > 0 ? round(($produktifCount / $totalPenduduk) * 100, 2) : 0;
                            @endphp
                            <div class="row g-2 text-center">
                                <div class="col-12">
                                    <div class="bg-light rounded-3 p-3 mb-2">
                                        <h5 class="mb-1" style="color: #0dcdbd;">{{ $topPekerjaan ? $topPekerjaan->nama_pekerjaan : '-' }}</h5>
                                        <small class="text-muted d-block">Pekerjaan Terbanyak</small>
                                        <div class="progress mt-2" style="height: 4px;">
                                            <div class="progress-bar" style="width: {{ $percentageTop }}%; background-color: #0dcdbd;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <h5 class="mb-1 text-success">{{ $produktifCount }}</h5>
                                        <small class="text-muted d-block">Produktif</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <h5 class="mb-1 text-primary">{{ $totalPenduduk - $produktifCount }}</h5>
                                        <small class="text-muted d-block">Non-Produktif</small>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="bg-light rounded-3 p-3">
                                        <h3 class="mb-1 text-success">{{ $totalPenduduk }}</h3>
                                        <small class="text-muted d-block">Total Penduduk</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8 col-xl-9">
                <!-- Chart Section -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <h5 class="mb-2 mb-md-0 d-flex align-items-center">
                                <i class="bi bi-graph-up me-2" style="color: #0dcdbd;"></i>Visualisasi Data
                            </h5>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-secondary" id="exportChart">
                                    <i class="bi bi-download me-1"></i>Unduh Grafik
                                </button>
                                <button class="btn btn-sm" onclick="toggleChartType()" style="background-color: #0dcdbd; color: white;">
                                    <i class="bi bi-arrow-repeat me-1"></i>Ganti Tampilan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div id="chartContainer" style="min-height: 400px;"></div>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-table me-2" style="color: #0dcdbd;"></i>Tabel Data Statistik
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col">Pekerjaan</th>
                                        <th scope="col" class="text-center">Kategori</th>
                                        <th scope="col" class="text-center">Jumlah</th>
                                        <th scope="col" class="text-center">Laki-laki</th>
                                        <th scope="col" class="text-center">Perempuan</th>
                                        <th scope="col" class="text-center">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPenduduk = $penduduk->count();
                                        $colors = ['#0dcdbd', '#ff6b6b', '#4ecdc4', '#ffe66d', '#95e1d3', '#ff9a76', '#a8e6cf', '#2891bb', '#1aafbc', '#e83e8c'];
                                        $counter = 0;
                                    @endphp
                                    
                                    @foreach ($pekerjaan as $pk)
                                        @php
                                            $total = $penduduk->where('id_pekerjaan', $pk->id)->count();
                                            $laki = $penduduk->where('id_pekerjaan', $pk->id)->where('jenis_kelamin', "LAKI-LAKI")->count();
                                            $perempuan = $penduduk->where('id_pekerjaan', $pk->id)->where('jenis_kelamin', "PEREMPUAN")->count();
                                            $percentage = $totalPenduduk > 0 ? round(($total / $totalPenduduk) * 100, 2) : 0;
                                            $color = $colors[$counter % count($colors)];
                                            $counter++;
                                            
                                            // Tentukan kategori pekerjaan
                                            $namaLower = strtolower($pk->nama_pekerjaan);
                                            $kategori = 'Lainnya';
                                            $icon = 'bi-briefcase';
                                            
                                            if (str_contains($namaLower, 'tidak') || str_contains($namaLower, 'menganggur')) {
                                                $kategori = 'Non-Produktif';
                                                $icon = 'bi-person-x';
                                            } elseif (str_contains($namaLower, 'pelajar') || str_contains($namaLower, 'mahasiswa')) {
                                                $kategori = 'Pendidikan';
                                                $icon = 'bi-mortarboard';
                                            } elseif (str_contains($namaLower, 'petani') || str_contains($namaLower, 'nelayan') || str_contains($namaLower, 'perkebunan')) {
                                                $kategori = 'Pertanian';
                                                $icon = 'bi-tree';
                                            } elseif (str_contains($namaLower, 'pedagang') || str_contains($namaLower, 'wiraswasta') || str_contains($namaLower, 'usaha')) {
                                                $kategori = 'Perdagangan';
                                                $icon = 'bi-shop';
                                            } elseif (str_contains($namaLower, 'pegawai') || str_contains($namaLower, 'karyawan') || str_contains($namaLower, 'pns')) {
                                                $kategori = 'Pegawai';
                                                $icon = 'bi-building';
                                            } elseif (str_contains($namaLower, 'buruh') || str_contains($namaLower, 'tukang')) {
                                                $kategori = 'Buruh';
                                                $icon = 'bi-tools';
                                            }
                                        @endphp
                                        
                                        @if($total > 0)
                                            <tr>
                                                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-circle me-3" style="width: 12px; height: 12px; background-color: {{ $color }};"></div>
                                                        <span class="fw-medium">{{ $pk->nama_pekerjaan }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge 
                                                        @if($kategori == 'Non-Produktif') bg-danger
                                                        @elseif($kategori == 'Pendidikan') bg-info
                                                        @elseif($kategori == 'Pertanian') bg-success
                                                        @elseif($kategori == 'Perdagangan') bg-warning
                                                        @elseif($kategori == 'Pegawai') bg-primary
                                                        @elseif($kategori == 'Buruh') bg-secondary
                                                        @else bg-dark
                                                        @endif">
                                                        <i class="bi {{ $icon }} me-1"></i>{{ $kategori }}
                                                    </span>
                                                </td>
                                                <td class="text-center fw-bold" style="color: {{ $color }};">{{ $total }}</td>
                                                <td class="text-center">{{ $laki }}</td>
                                                <td class="text-center">{{ $perempuan }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="progress flex-grow-1 me-2" style="height: 6px; width: 100px;">
                                                            <div class="progress-bar" style="width: {{ $percentage }}%; background-color: {{ $color }};"></div>
                                                        </div>
                                                        <span class="fw-medium">{{ $percentage }}%</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    
                                    <tr class="table-light">
                                        <td class="text-center fw-bold"></td>
                                        <td class="fw-bold">Total</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center fw-bold text-success">{{ $totalPenduduk }}</td>
                                        <td class="text-center fw-bold">{{ $penduduk->where('jenis_kelamin', 'LAKI-LAKI')->count() }}</td>
                                        <td class="text-center fw-bold">{{ $penduduk->where('jenis_kelamin', 'PEREMPUAN')->count() }}</td>
                                        <td class="text-center fw-bold">100%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Filter and Search -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-funnel me-2" style="color: #0dcdbd;"></i>Filter Pekerjaan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="categoryFilter" class="form-label">Filter Berdasarkan Kategori</label>
                                <select class="form-select" id="categoryFilter" onchange="filterByCategory()">
                                    <option value="all">Semua Kategori</option>
                                    <option value="Pertanian">Pertanian</option>
                                    <option value="Perdagangan">Perdagangan</option>
                                    <option value="Pegawai">Pegawai</option>
                                    <option value="Buruh">Buruh</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                    <option value="Non-Produktif">Non-Produktif</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="searchJob" class="form-label">Cari Pekerjaan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchJob" placeholder="Cari nama pekerjaan..." onkeyup="searchJobs()">
                                    <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards by Category -->
                <div class="row g-3">
                    @php
                        $categories = [
                            'Pertanian' => ['color' => '#198754', 'icon' => 'bi-tree'],
                            'Perdagangan' => ['color' => '#ffc107', 'icon' => 'bi-shop'],
                            'Pegawai' => ['color' => '#0d6efd', 'icon' => 'bi-building'],
                            'Buruh' => ['color' => '#6c757d', 'icon' => 'bi-tools'],
                            'Pendidikan' => ['color' => '#0dcaf0', 'icon' => 'bi-mortarboard'],
                            'Non-Produktif' => ['color' => '#dc3545', 'icon' => 'bi-person-x'],
                            'Lainnya' => ['color' => '#212529', 'icon' => 'bi-briefcase']
                        ];
                        
                        // Hitung jumlah per kategori
                        $categoryCounts = [];
                        foreach ($categories as $categoryName => $data) {
                            $categoryCounts[$categoryName] = 0;
                        }
                        
                        foreach ($pekerjaan as $pk) {
                                            $namaLower = strtolower($pk->nama_pekerjaan);
                                            $kategori = 'Lainnya';
                                            
                                            if (str_contains($namaLower, 'tidak') || str_contains($namaLower, 'menganggur')) {
                                                $kategori = 'Non-Produktif';
                                            } elseif (str_contains($namaLower, 'pelajar') || str_contains($namaLower, 'mahasiswa')) {
                                                $kategori = 'Pendidikan';
                                            } elseif (str_contains($namaLower, 'petani') || str_contains($namaLower, 'nelayan') || str_contains($namaLower, 'perkebunan')) {
                                                $kategori = 'Pertanian';
                                            } elseif (str_contains($namaLower, 'pedagang') || str_contains($namaLower, 'wiraswasta') || str_contains($namaLower, 'usaha')) {
                                                $kategori = 'Perdagangan';
                                            } elseif (str_contains($namaLower, 'pegawai') || str_contains($namaLower, 'karyawan') || str_contains($namaLower, 'pns')) {
                                                $kategori = 'Pegawai';
                                            } elseif (str_contains($namaLower, 'buruh') || str_contains($namaLower, 'tukang')) {
                                                $kategori = 'Buruh';
                                            }
                                            
                                            $categoryCounts[$kategori] += $penduduk->where('id_pekerjaan', $pk->id)->count();
                                        }
                                    @endphp
                                    
                                    @foreach($categories as $categoryName => $data)
                                        @if($categoryCounts[$categoryName] > 0)
                                            @php
                                                $percentage = $totalPenduduk > 0 ? round(($categoryCounts[$categoryName] / $totalPenduduk) * 100, 2) : 0;
                                            @endphp
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body p-3">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="rounded-circle p-2 me-3" style="background-color: rgba({{ hexdec(substr($data['color'], 1, 2)) }}, {{ hexdec(substr($data['color'], 3, 2)) }}, {{ hexdec(substr($data['color'], 5, 2)) }}, 0.1);">
                                                                <i class="bi {{ $data['icon'] }} fs-5" style="color: {{ $data['color'] }};"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1" style="color: {{ $data['color'] }}; font-size: 0.9rem;">{{ $categoryName }}</h6>
                                                                <small class="text-muted">{{ $categoryCounts[$categoryName] }} orang</small>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h4 class="mb-0" style="color: {{ $data['color'] }}; font-size: 1.5rem;">{{ $percentage }}%</h4>
                                                                <small class="text-muted">Persentase</small>
                                                            </div>
                                                            <div class="text-end">
                                                                <div class="progress" style="height: 6px; width: 80px;">
                                                                    <div class="progress-bar" style="width: {{ $percentage }}%; background-color: {{ $data['color'] }};"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
    /* Custom Styles for Statistics Page */
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
    
    /* Navigation styles */
    .nav-link.active {
        border-left: 4px solid #0dcdbd !important;
    }
    
    .nav-link:not(.active):hover {
        background-color: rgba(13, 205, 189, 0.05) !important;
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
    
    /* Card hover effects */
    .card.border-0.shadow-sm {
        transition: transform 0.3s ease;
    }
    
    .card.border-0.shadow-sm:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(13, 205, 189, 0.1) !important;
    }
    
    /* Button styling */
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
    
    /* Progress bar styling */
    .progress {
        background-color: rgba(13, 205, 189, 0.1);
    }
    
    /* Table styling */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 205, 189, 0.05) !important;
    }
    
    /* Summary card animations */
    .card.border-0.shadow-sm.h-100 {
        animation: fadeInUp 0.5s ease;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
        
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .progress {
            width: 60px !important;
        }
        
        h3 {
            font-size: 1.5rem !important;
        }
        
        h4 {
            font-size: 1.25rem !important;
        }
        
        h5, h6 {
            font-size: 1rem !important;
        }
        
        .badge {
            font-size: 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .d-flex.flex-column.flex-md-row {
            flex-direction: column !important;
        }
        
        .mb-2.mb-md-0 {
            margin-bottom: 1rem !important;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem !important;
            font-size: 0.875rem !important;
        }
        
        /* Adjust table for mobile */
        .table td, .table th {
            padding: 0.5rem !important;
        }
        
        /* Stack summary cards */
        .col-md-6 {
            margin-bottom: 1rem;
        }
        
        /* Adjust filter section */
        .col-md-6 {
            margin-bottom: 1rem;
        }
    }
    
    /* Chart container */
    #chartContainer {
        position: relative;
    }
    
    /* Hide table rows */
    .table-row-hidden {
        display: none;
    }
</style>

@section('js')
<!-- ECharts Library -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let chartInstance = null;
        let chartType = 'pie'; // default chart type for job data
        
        // Data for charts
        const chartData = {
            categories: [
                @foreach ($pekerjaan as $pk)
                    "{{ $pk->nama_pekerjaan }}",
                @endforeach
            ],
            values: [
                @foreach ($pekerjaan as $pk)
                    {{ $penduduk->where('id_pekerjaan', $pk->id)->count() }},
                @endforeach
            ],
            colors: ['#0dcdbd', '#ff6b6b', '#4ecdc4', '#ffe66d', '#95e1d3', '#ff9a76', '#a8e6cf', '#2891bb', '#1aafbc', '#e83e8c']
        };
        
        // Initialize chart
        function initChart(type = 'pie') {
            const chartDom = document.getElementById('chartContainer');
            chartInstance = echarts.init(chartDom);
            
            const option = getChartOption(type);
            chartInstance.setOption(option);
            
            // Handle window resize
            window.addEventListener('resize', function() {
                chartInstance.resize();
            });
        }
        
        // Get chart options based on type
        function getChartOption(type) {
            const baseOption = {
                backgroundColor: 'transparent',
                tooltip: {
                    trigger: 'item',
                    formatter: function(params) {
                        const total = chartData.values.reduce((a, b) => a + b, 0);
                        const percentage = total > 0 ? ((params.value / total) * 100).toFixed(2) : 0;
                        return `
                            <strong>${params.name}</strong><br/>
                            Jumlah: ${params.value.toLocaleString()}<br/>
                            Persentase: ${percentage}%
                        `;
                    }
                },
                legend: {
                    orient: 'vertical',
                    right: 10,
                    top: 'center',
                    textStyle: {
                        fontSize: 11
                    }
                },
                series: []
            };
            
            if (type === 'pie') {
                baseOption.series.push({
                    name: 'Pekerjaan',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 14,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: chartData.categories.map((name, index) => ({
                        name: name,
                        value: chartData.values[index],
                        itemStyle: {
                            color: chartData.colors[index % chartData.colors.length]
                        }
                    }))
                });
                
                baseOption.title = {
                    text: 'Distribusi Pekerjaan',
                    subtext: 'Presentase Penduduk Desa Dotte',
                    left: 'center',
                    textStyle: {
                        fontSize: 18,
                        fontWeight: 'bold'
                    },
                    subtextStyle: {
                        fontSize: 14,
                        color: '#666'
                    }
                };
            } 
            else if (type === 'bar') {
                baseOption.series.push({
                    name: 'Jumlah',
                    type: 'bar',
                    data: chartData.values,
                    itemStyle: {
                        color: function(params) {
                            return chartData.colors[params.dataIndex % chartData.colors.length];
                        }
                    },
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}',
                        fontSize: 12
                    }
                });
                
                baseOption.xAxis = {
                    type: 'category',
                    data: chartData.categories.map(name => {
                        // Singkatkan nama jika terlalu panjang
                        return name.length > 10 ? name.substring(0, 8) + '...' : name;
                    }),
                    axisLabel: {
                        fontSize: 11,
                        rotate: 45
                    }
                };
                
                baseOption.yAxis = {
                    type: 'value',
                    axisLabel: {
                        fontSize: 12
                    }
                };
                
                baseOption.title = {
                    text: 'Jumlah Penduduk Berdasarkan Pekerjaan',
                    left: 'center',
                    textStyle: {
                        fontSize: 18,
                        fontWeight: 'bold'
                    }
                };
                
                baseOption.grid = {
                    left: '3%',
                    right: '4%',
                    bottom: '20%',
                    containLabel: true
                };
            }
            else if (type === 'doughnut') {
                baseOption.series.push({
                    name: 'Pekerjaan',
                    type: 'pie',
                    radius: ['30%', '60%'],
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 14,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: chartData.categories.map((name, index) => ({
                        name: name,
                        value: chartData.values[index],
                        itemStyle: {
                            color: chartData.colors[index % chartData.colors.length]
                        }
                    }))
                });
                
                baseOption.title = {
                    text: 'Rasio Pekerjaan',
                    subtext: 'Dalam bentuk donat',
                    left: 'center',
                    textStyle: {
                        fontSize: 18,
                        fontWeight: 'bold'
                    },
                    subtextStyle: {
                        fontSize: 14,
                        color: '#666'
                    }
                };
            }
            
            return baseOption;
        }
        
        // Toggle chart type
        window.toggleChartType = function() {
            const types = ['pie', 'bar', 'doughnut'];
            const currentIndex = types.indexOf(chartType);
            const nextIndex = (currentIndex + 1) % types.length;
            chartType = types[nextIndex];
            
            initChart(chartType);
            
            // Update button text
            const button = document.querySelector('button[onclick="toggleChartType()"]');
            const typeNames = {
                'pie': 'Diagram Pie',
                'bar': 'Diagram Batang',
                'doughnut': 'Diagram Donat'
            };
            button.innerHTML = `<i class="bi bi-arrow-repeat me-1"></i>${typeNames[chartType]}`;
        };
        
        // Export chart as image
        document.getElementById('exportChart').addEventListener('click', function() {
            if (chartInstance) {
                const link = document.createElement('a');
                link.download = `statistik-pekerjaan-${new Date().toISOString().split('T')[0]}.png`;
                link.href = chartInstance.getDataURL({
                    type: 'png',
                    pixelRatio: 2,
                    backgroundColor: '#fff'
                });
                link.click();
                
                // Show notification
                showToast('Grafik berhasil diunduh!', 'success');
            }
        });
        
        // Filter by category
        window.filterByCategory = function() {
            const selectedCategory = document.getElementById('categoryFilter').value;
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                if (row.classList.contains('table-light')) return; // Skip total row
                
                const categoryBadge = row.querySelector('.badge');
                if (categoryBadge) {
                    const rowCategory = categoryBadge.textContent.trim();
                    const categoryText = rowCategory.replace(/^[^a-zA-Z]+/, '').trim();
                    
                    if (selectedCategory === 'all' || categoryText === selectedCategory) {
                        row.classList.remove('table-row-hidden');
                    } else {
                        row.classList.add('table-row-hidden');
                    }
                }
            });
            
            if (selectedCategory !== 'all') {
                showToast(`Menampilkan kategori: ${selectedCategory}`, 'info');
            }
        };
        
        // Search jobs
        window.searchJobs = function() {
            const searchTerm = document.getElementById('searchJob').value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                if (row.classList.contains('table-light')) return; // Skip total row
                
                const jobCell = row.querySelector('td:nth-child(2)');
                if (jobCell) {
                    const jobText = jobCell.textContent.toLowerCase();
                    if (jobText.includes(searchTerm)) {
                        row.classList.remove('table-row-hidden');
                    } else {
                        row.classList.add('table-row-hidden');
                    }
                }
            });
            
            if (searchTerm) {
                showToast(`Mencari: ${searchTerm}`, 'info');
            }
        };
        
        // Clear search
        window.clearSearch = function() {
            document.getElementById('searchJob').value = '';
            document.getElementById('categoryFilter').value = 'all';
            
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.classList.remove('table-row-hidden');
            });
            
            showToast('Filter dan pencarian dibersihkan', 'info');
        };
        
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
        
        // Initialize the chart
        initChart(chartType);
    });
</script>
@endsection

@include('layouts.footer')
@endsection