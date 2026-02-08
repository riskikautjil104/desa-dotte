@extends('layouts.main', ['title' => 'Statistik Berdasarkan Kelompok Umur'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Statistik Berdasarkan Kelompok Umur',
        'subtitle' => 'Temukan statistik berdasarkan kelompok umur terbaru tentang Desa Dotte',
        'breadcrumb' => 'Kelompok Umur',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Statistik Section ======= -->
<section id="statistik" class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center text-lg-start mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">Statistik Kelompok Umur</h2>
            <p class="text-muted lead">Data distribusi penduduk berdasarkan kelompok umur di Desa Dotte</p>
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
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2">
                                    <i class="bi bi-briefcase me-3 fs-5 text-muted"></i>
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
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2 active" 
                                   style="background-color: rgba(13, 205, 189, 0.1);">
                                    <i class="bi bi-people me-3 fs-5" style="color: #0dcdbd;"></i>
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
                                $usiaMuda = $penduduk->where('usia', '>=', 0)->where('usia', '<=', 17)->count();
                                $usiaProduktif = $penduduk->where('usia', '>=', 18)->where('usia', '<=', 64)->count();
                                $usiaLanjut = $penduduk->where('usia', '>=', 65)->count();
                                $totalPenduduk = $penduduk->count();
                            @endphp
                            <div class="row g-2 text-center">
                                <div class="col-12">
                                    <div class="bg-light rounded-3 p-3 mb-2">
                                        <h3 class="mb-1" style="color: #0dcdbd;">{{ $usiaProduktif }}</h3>
                                        <small class="text-muted d-block">Usia Produktif (18-64)</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <h5 class="mb-1 text-primary">{{ $usiaMuda }}</h5>
                                        <small class="text-muted d-block">Usia Muda (0-17)</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <h5 class="mb-1 text-warning">{{ $usiaLanjut }}</h5>
                                        <small class="text-muted d-block">Usia Lanjut (65+)</small>
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
                                        <th scope="col">Kelompok Umur</th>
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
                                        $kelompokUmur = [
                                            [
                                                'range' => '0 - 5 Tahun',
                                                'label' => 'Balita',
                                                'min' => 0,
                                                'max' => 5,
                                                'color' => '#ff9a76',
                                                'category' => 'Usia Dini'
                                            ],
                                            [
                                                'range' => '5 - 11 Tahun',
                                                'label' => 'Anak-anak',
                                                'min' => 5,
                                                'max' => 11,
                                                'color' => '#a8e6cf',
                                                'category' => 'Usia Dini'
                                            ],
                                            [
                                                'range' => '12 - 16 Tahun',
                                                'label' => 'Remaja Awal',
                                                'min' => 12,
                                                'max' => 16,
                                                'color' => '#95e1d3',
                                                'category' => 'Remaja'
                                            ],
                                            [
                                                'range' => '17 - 25 Tahun',
                                                'label' => 'Remaja Akhir',
                                                'min' => 17,
                                                'max' => 25,
                                                'color' => '#4ecdc4',
                                                'category' => 'Remaja'
                                            ],
                                            [
                                                'range' => '26 - 35 Tahun',
                                                'label' => 'Dewasa Awal',
                                                'min' => 26,
                                                'max' => 35,
                                                'color' => '#0dcdbd',
                                                'category' => 'Produktif'
                                            ],
                                            [
                                                'range' => '36 - 45 Tahun',
                                                'label' => 'Dewasa Madya',
                                                'min' => 36,
                                                'max' => 45,
                                                'color' => '#1aafbc',
                                                'category' => 'Produktif'
                                            ],
                                            [
                                                'range' => '46 - 55 Tahun',
                                                'label' => 'Dewasa Akhir',
                                                'min' => 46,
                                                'max' => 55,
                                                'color' => '#2891bb',
                                                'category' => 'Produktif'
                                            ],
                                            [
                                                'range' => '56 - 65 Tahun',
                                                'label' => 'Pra-Lansia',
                                                'min' => 56,
                                                'max' => 65,
                                                'color' => '#ff6b6b',
                                                'category' => 'Pra-Lansia'
                                            ],
                                            [
                                                'range' => '> 65 Tahun',
                                                'label' => 'Lansia',
                                                'min' => 65,
                                                'max' => null,
                                                'color' => '#e83e8c',
                                                'category' => 'Lansia'
                                            ]
                                        ];
                                        $counter = 1;
                                    @endphp
                                    
                                    @foreach($kelompokUmur as $kelompok)
                                        @php
                                            if ($kelompok['max'] !== null) {
                                                $total = $penduduk->where('usia', '>=', $kelompok['min'])
                                                                  ->where('usia', '<=', $kelompok['max'])
                                                                  ->count();
                                                $laki = $penduduk->where('usia', '>=', $kelompok['min'])
                                                                 ->where('usia', '<=', $kelompok['max'])
                                                                 ->where('jenis_kelamin', 'LAKI-LAKI')
                                                                 ->count();
                                                $perempuan = $penduduk->where('usia', '>=', $kelompok['min'])
                                                                     ->where('usia', '<=', $kelompok['max'])
                                                                     ->where('jenis_kelamin', 'PEREMPUAN')
                                                                     ->count();
                                            } else {
                                                $total = $penduduk->where('usia', '>=', $kelompok['min'])->count();
                                                $laki = $penduduk->where('usia', '>=', $kelompok['min'])
                                                                 ->where('jenis_kelamin', 'LAKI-LAKI')
                                                                 ->count();
                                                $perempuan = $penduduk->where('usia', '>=', $kelompok['min'])
                                                                     ->where('jenis_kelamin', 'PEREMPUAN')
                                                                     ->count();
                                            }
                                            $percentage = $totalPenduduk > 0 ? round(($total / $totalPenduduk) * 100, 2) : 0;
                                        @endphp
                                        
                                        @if($total > 0)
                                            <tr>
                                                <td class="text-center fw-bold">{{ $counter++ }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-circle me-3" style="width: 12px; height: 12px; background-color: {{ $kelompok['color'] }};"></div>
                                                        <div>
                                                            <span class="fw-medium d-block">{{ $kelompok['range'] }}</span>
                                                            <small class="text-muted">{{ $kelompok['label'] }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge 
                                                        @if($kelompok['category'] == 'Usia Dini') bg-info
                                                        @elseif($kelompok['category'] == 'Remaja') bg-primary
                                                        @elseif($kelompok['category'] == 'Produktif') bg-success
                                                        @elseif($kelompok['category'] == 'Pra-Lansia') bg-warning
                                                        @else bg-danger
                                                        @endif">
                                                        {{ $kelompok['category'] }}
                                                    </span>
                                                </td>
                                                <td class="text-center fw-bold" style="color: {{ $kelompok['color'] }};">{{ $total }}</td>
                                                <td class="text-center">{{ $laki }}</td>
                                                <td class="text-center">{{ $perempuan }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="progress flex-grow-1 me-2" style="height: 6px; width: 100px;">
                                                            <div class="progress-bar" style="width: {{ $percentage }}%; background-color: {{ $kelompok['color'] }};"></div>
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

                <!-- Summary Cards by Category -->
                <div class="row g-3 mb-4">
                    @php
                        $categories = [
                            'Usia Dini' => [
                                'kelompok' => $kelompokUmur[0], // 0-5 tahun
                                'kelompok2' => $kelompokUmur[1], // 5-11 tahun
                                'icon' => 'bi-baby',
                                'color' => '#0dcaf0'
                            ],
                            'Remaja' => [
                                'kelompok' => $kelompokUmur[2], // 12-16 tahun
                                'kelompok2' => $kelompokUmur[3], // 17-25 tahun
                                'icon' => 'bi-person',
                                'color' => '#0d6efd'
                            ],
                            'Produktif' => [
                                'kelompok' => $kelompokUmur[4], // 26-35 tahun
                                'kelompok2' => $kelompokUmur[5], // 36-45 tahun
                                'kelompok3' => $kelompokUmur[6], // 46-55 tahun
                                'icon' => 'bi-briefcase',
                                'color' => '#198754'
                            ],
                            'Lansia' => [
                                'kelompok' => $kelompokUmur[7], // 56-65 tahun
                                'kelompok2' => $kelompokUmur[8], // >65 tahun
                                'icon' => 'bi-person-bounding-box',
                                'color' => '#dc3545'
                            ]
                        ];
                    @endphp
                    
                    @foreach($categories as $categoryName => $category)
                        @php
                            // Hitung total untuk kategori
                            $totalCategory = 0;
                            foreach(['kelompok', 'kelompok2', 'kelompok3'] as $key) {
                                if (isset($category[$key])) {
                                    $k = $category[$key];
                                    if ($k['max'] !== null) {
                                        $totalCategory += $penduduk->where('usia', '>=', $k['min'])
                                                                   ->where('usia', '<=', $k['max'])
                                                                   ->count();
                                    } else {
                                        $totalCategory += $penduduk->where('usia', '>=', $k['min'])->count();
                                    }
                                }
                            }
                            $percentageCategory = $totalPenduduk > 0 ? round(($totalCategory / $totalPenduduk) * 100, 2) : 0;
                        @endphp
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle p-2 me-3" style="background-color: rgba({{ hexdec(substr($category['color'], 1, 2)) }}, {{ hexdec(substr($category['color'], 3, 2)) }}, {{ hexdec(substr($category['color'], 5, 2)) }}, 0.1);">
                                            <i class="bi {{ $category['icon'] }} fs-5" style="color: {{ $category['color'] }};"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1" style="color: {{ $category['color'] }}; font-size: 0.9rem;">{{ $categoryName }}</h6>
                                            <small class="text-muted">{{ $totalCategory }} penduduk</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="mb-0" style="color: {{ $category['color'] }}; font-size: 1.5rem;">{{ $percentageCategory }}%</h4>
                                            <small class="text-muted">Persentase</small>
                                        </div>
                                        <div class="text-end">
                                            <div class="progress" style="height: 6px; width: 80px;">
                                                <div class="progress-bar" style="width: {{ $percentageCategory }}%; background-color: {{ $category['color'] }};"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Age Pyramid Chart -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-bar-chart-steps me-2" style="color: #0dcdbd;"></i>Piramida Penduduk
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="pyramidChart" style="min-height: 500px;"></div>
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
    }
    
    /* Chart container */
    #chartContainer, #pyramidChart {
        position: relative;
    }
</style>

@section('js')
<!-- ECharts Library -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let chartInstance = null;
        let chartType = 'bar'; // default chart type for age data
        
        // Data for main chart
        const chartData = {
            categories: [
                '0 - 5 Tahun',
                '5 - 11 Tahun',
                '12 - 16 Tahun',
                '17 - 25 Tahun',
                '26 - 35 Tahun',
                '36 - 45 Tahun',
                '46 - 55 Tahun',
                '56 - 65 Tahun',
                '> 65 Tahun'
            ],
            values: [
                {{ $penduduk->where('usia', '>=', 0)->where('usia', '<=', 5)->count() }},
                {{ $penduduk->where('usia', '>=', 5)->where('usia', '<=', 11)->count() }},
                {{ $penduduk->where('usia', '>=', 12)->where('usia', '<=', 16)->count() }},
                {{ $penduduk->where('usia', '>=', 17)->where('usia', '<=', 25)->count() }},
                {{ $penduduk->where('usia', '>=', 26)->where('usia', '<=', 35)->count() }},
                {{ $penduduk->where('usia', '>=', 36)->where('usia', '<=', 45)->count() }},
                {{ $penduduk->where('usia', '>=', 46)->where('usia', '<=', 55)->count() }},
                {{ $penduduk->where('usia', '>=', 56)->where('usia', '<=', 65)->count() }},
                {{ $penduduk->where('usia', '>=', 65)->count() }}
            ],
            colors: ['#ff9a76', '#a8e6cf', '#95e1d3', '#4ecdc4', '#0dcdbd', '#1aafbc', '#2891bb', '#ff6b6b', '#e83e8c']
        };
        
        // Initialize main chart
        function initChart(type = 'bar') {
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
                        fontSize: 12
                    }
                },
                series: []
            };
            
            if (type === 'pie') {
                baseOption.series.push({
                    name: 'Kelompok Umur',
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
                            color: chartData.colors[index]
                        }
                    }))
                });
                
                baseOption.title = {
                    text: 'Distribusi Kelompok Umur',
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
                            return chartData.colors[params.dataIndex];
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
                    data: chartData.categories.map(name => name.split(' ')[0] + 'T'),
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
                    text: 'Jumlah Penduduk Berdasarkan Kelompok Umur',
                    left: 'center',
                    textStyle: {
                        fontSize: 18,
                        fontWeight: 'bold'
                    }
                };
                
                baseOption.grid = {
                    left: '3%',
                    right: '4%',
                    bottom: '15%',
                    containLabel: true
                };
            }
            else if (type === 'doughnut') {
                baseOption.series.push({
                    name: 'Kelompok Umur',
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
                            color: chartData.colors[index]
                        }
                    }))
                });
                
                baseOption.title = {
                    text: 'Rasio Kelompok Umur',
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
            const types = ['bar', 'pie', 'doughnut'];
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
                link.download = `statistik-kelompok-umur-${new Date().toISOString().split('T')[0]}.png`;
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
        
        // Initialize Age Pyramid Chart
        function initPyramidChart() {
            const pyramidDom = document.getElementById('pyramidChart');
            const pyramidChart = echarts.init(pyramidDom);
            
            // Data for pyramid
            const pyramidData = {
                categories: chartData.categories,
                maleData: [
                    {{ $penduduk->where('usia', '>=', 0)->where('usia', '<=', 5)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 5)->where('usia', '<=', 11)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 12)->where('usia', '<=', 16)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 17)->where('usia', '<=', 25)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 26)->where('usia', '<=', 35)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 36)->where('usia', '<=', 45)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 46)->where('usia', '<=', 55)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 56)->where('usia', '<=', 65)->where('jenis_kelamin', 'LAKI-LAKI')->count() }},
                    {{ $penduduk->where('usia', '>=', 65)->where('jenis_kelamin', 'LAKI-LAKI')->count() }}
                ],
                femaleData: [
                    {{ $penduduk->where('usia', '>=', 0)->where('usia', '<=', 5)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 5)->where('usia', '<=', 11)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 12)->where('usia', '<=', 16)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 17)->where('usia', '<=', 25)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 26)->where('usia', '<=', 35)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 36)->where('usia', '<=', 45)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 46)->where('usia', '<=', 55)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 56)->where('usia', '<=', 65)->where('jenis_kelamin', 'PEREMPUAN')->count() }},
                    {{ $penduduk->where('usia', '>=', 65)->where('jenis_kelamin', 'PEREMPUAN')->count() }}
                ]
            };
            
            const pyramidOption = {
                title: {
                    text: 'Piramida Penduduk Desa Dotte',
                    subtext: 'Distribusi Umur berdasarkan Jenis Kelamin',
                    left: 'center',
                    textStyle: {
                        fontSize: 18,
                        fontWeight: 'bold'
                    }
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    },
                    formatter: function(params) {
                        const male = params[0];
                        const female = params[1];
                        return `
                            <strong>${male.name}</strong><br/>
                            Laki-laki: ${male.value}<br/>
                            Perempuan: ${female.value}<br/>
                            Total: ${male.value + female.value}
                        `;
                    }
                },
                legend: {
                    data: ['Laki-laki', 'Perempuan'],
                    top: 30
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'value',
                        position: 'top',
                        axisLabel: {
                            formatter: '{value}'
                        }
                    },
                    {
                        type: 'value',
                        position: 'top',
                        offset: 80,
                        axisLabel: {
                            formatter: '{value}'
                        }
                    }
                ],
                yAxis: {
                    type: 'category',
                    data: pyramidData.categories,
                    axisLabel: {
                        fontSize: 11
                    }
                },
                series: [
                    {
                        name: 'Laki-laki',
                        type: 'bar',
                        stack: 'total',
                        label: {
                            show: true,
                            formatter: '{b}',
                            position: 'insideLeft'
                        },
                        itemStyle: {
                            color: '#0dcdbd'
                        },
                        data: pyramidData.maleData.map((value, index) => ({
                            value: -value,
                            name: pyramidData.categories[index]
                        }))
                    },
                    {
                        name: 'Perempuan',
                        type: 'bar',
                        stack: 'total',
                        label: {
                            show: true,
                            formatter: '{b}',
                            position: 'insideRight'
                        },
                        itemStyle: {
                            color: '#e83e8c'
                        },
                        data: pyramidData.femaleData
                    }
                ]
            };
            
            pyramidChart.setOption(pyramidOption);
            
            // Handle resize
            window.addEventListener('resize', function() {
                pyramidChart.resize();
            });
        }
        
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
        
        // Initialize the charts
        initChart(chartType);
        initPyramidChart();
    });
</script>
@endsection

@include('layouts.footer')
@endsection