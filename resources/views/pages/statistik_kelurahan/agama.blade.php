@extends('layouts.main',['title' => 'Statistik Berdasarkan Agama'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Statistik Berdasarkan Agama',
        'subtitle' => 'Temukan statistik berdasarkan agama terbaru tentang Desa Dotte',
        'breadcrumb' => 'Agama',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= Statistik Section ======= -->
<section id="statistik" class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center text-lg-start mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">Statistik Agama</h2>
            <p class="text-muted lead">Data distribusi penduduk berdasarkan agama di Desa Dotte</p>
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
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3 mb-2 active" 
                                   style="background-color: rgba(13, 205, 189, 0.1);">
                                    <i class="bi bi-pray me-3 fs-5" style="color: #0dcdbd;"></i>
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
                                   class="nav-link d-flex align-items-center py-3 px-3 rounded-3">
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
                            <div class="row g-2 text-center">
                                <div class="col-12">
                                    <div class="bg-light rounded-3 p-3 mb-2">
                                        <h3 class="mb-1" style="color: #0dcdbd;">{{ $penduduk->where('agama', 'ISLAM')->count() }}</h3>
                                        <small class="text-muted d-block">Islam</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <h5 class="mb-1">{{ $penduduk->where('agama', 'KRISTEN PROTESTAN')->count() }}</h5>
                                        <small class="text-muted d-block">Kristen Protestan</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <h5 class="mb-1">{{ $penduduk->where('agama', 'KRISTEN KATOLIK')->count() }}</h5>
                                        <small class="text-muted d-block">Kristen Katolik</small>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="bg-light rounded-3 p-3">
                                        <h3 class="mb-1 text-success">{{ $penduduk->count() }}</h3>
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
                                        <th scope="col">Agama</th>
                                        <th scope="col" class="text-center">Jumlah</th>
                                        <th scope="col" class="text-center">Laki-laki</th>
                                        <th scope="col" class="text-center">Perempuan</th>
                                        <th scope="col" class="text-center">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPenduduk = $penduduk->count();
                                        $agamaData = [
                                            'ISLAM' => [
                                                'total' => $penduduk->where('agama', 'ISLAM')->count(),
                                                'laki' => $penduduk->where('agama', 'ISLAM')->where('jenis_kelamin', 'LAKI-LAKI')->count(),
                                                'perempuan' => $penduduk->where('agama', 'ISLAM')->where('jenis_kelamin', 'PEREMPUAN')->count(),
                                                'color' => '#0dcdbd'
                                            ],
                                            'KRISTEN PROTESTAN' => [
                                                'total' => $penduduk->where('agama', 'KRISTEN PROTESTAN')->count(),
                                                'laki' => $penduduk->where('agama', 'KRISTEN PROTESTAN')->where('jenis_kelamin', 'LAKI-LAKI')->count(),
                                                'perempuan' => $penduduk->where('agama', 'KRISTEN PROTESTAN')->where('jenis_kelamin', 'PEREMPUAN')->count(),
                                                'color' => '#ff6b6b'
                                            ],
                                            'KRISTEN KATOLIK' => [
                                                'total' => $penduduk->where('agama', 'KRISTEN KATOLIK')->count(),
                                                'laki' => $penduduk->where('agama', 'KRISTEN KATOLIK')->where('jenis_kelamin', 'LAKI-LAKI')->count(),
                                                'perempuan' => $penduduk->where('agama', 'KRISTEN KATOLIK')->where('jenis_kelamin', 'PEREMPUAN')->count(),
                                                'color' => '#4ecdc4'
                                            ],
                                            'HINDU' => [
                                                'total' => $penduduk->where('agama', 'HINDU')->count(),
                                                'laki' => $penduduk->where('agama', 'HINDU')->where('jenis_kelamin', 'LAKI-LAKI')->count(),
                                                'perempuan' => $penduduk->where('agama', 'HINDU')->where('jenis_kelamin', 'PEREMPUAN')->count(),
                                                'color' => '#ffe66d'
                                            ],
                                            'BUDDHA' => [
                                                'total' => $penduduk->where('agama', 'BUDDHA')->count(),
                                                'laki' => $penduduk->where('agama', 'BUDDHA')->where('jenis_kelamin', 'LAKI-LAKI')->count(),
                                                'perempuan' => $penduduk->where('agama', 'BUDDHA')->where('jenis_kelamin', 'PEREMPUAN')->count(),
                                                'color' => '#95e1d3'
                                            ],
                                            'KONGHUCU' => [
                                                'total' => $penduduk->where('agama', 'KONGHUCU')->count(),
                                                'laki' => $penduduk->where('agama', 'KONGHUCU')->where('jenis_kelamin', 'LAKI-LAKI')->count(),
                                                'perempuan' => $penduduk->where('agama', 'KONGHUCU')->where('jenis_kelamin', 'PEREMPUAN')->count(),
                                                'color' => '#ff9a76'
                                            ],
                                            'AGAMA LAINNYA' => [
                                                'total' => $penduduk->where('agama', 'AGAMA LAINNYA')->count(),
                                                'laki' => $penduduk->where('agama', 'AGAMA LAINNYA')->where('jenis_kelamin', 'LAKI-LAKI')->count(),
                                                'perempuan' => $penduduk->where('agama', 'AGAMA LAINNYA')->where('jenis_kelamin', 'PEREMPUAN')->count(),
                                                'color' => '#a8e6cf'
                                            ]
                                        ];
                                        $counter = 1;
                                    @endphp
                                    
                                    @foreach($agamaData as $agama => $data)
                                        @php
                                            $percentage = $totalPenduduk > 0 ? round(($data['total'] / $totalPenduduk) * 100, 2) : 0;
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold">{{ $counter++ }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle me-3" style="width: 12px; height: 12px; background-color: {{ $data['color'] }};"></div>
                                                    <span class="fw-medium">{{ $agama }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center fw-bold" style="color: {{ $data['color'] }};">{{ $data['total'] }}</td>
                                            <td class="text-center">{{ $data['laki'] }}</td>
                                            <td class="text-center">{{ $data['perempuan'] }}</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="progress flex-grow-1 me-2" style="height: 6px; width: 100px;">
                                                        <div class="progress-bar" style="width: {{ $percentage }}%; background-color: {{ $data['color'] }};"></div>
                                                    </div>
                                                    <span class="fw-medium">{{ $percentage }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    <tr class="table-light">
                                        <td class="text-center fw-bold"></td>
                                        <td class="fw-bold">Total</td>
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

                <!-- Summary Cards -->
                <div class="row g-3">
                    @foreach($agamaData as $agama => $data)
                        @if($data['total'] > 0)
                            @php
                                $percentage = $totalPenduduk > 0 ? round(($data['total'] / $totalPenduduk) * 100, 2) : 0;
                                $iconClass = [
                                    'ISLAM' => 'bi-moon-stars',
                                    'KRISTEN PROTESTAN' => 'bi-cross',
                                    'KRISTEN KATOLIK' => 'bi-cross',
                                    'HINDU' => 'bi-flower1',
                                    'BUDDHA' => 'bi-flower2',
                                    'KONGHUCU' => 'bi-incognito',
                                    'AGAMA LAINNYA' => 'bi-question-circle'
                                ][$agama] ?? 'bi-question-circle';
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="rounded-circle p-2 me-3" style="background-color: rgba({{ hexdec(substr($data['color'], 1, 2)) }}, {{ hexdec(substr($data['color'], 3, 2)) }}, {{ hexdec(substr($data['color'], 5, 2)) }}, 0.1);">
                                                <i class="bi {{ $iconClass }} fs-5" style="color: {{ $data['color'] }};"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1" style="color: {{ $data['color'] }}; font-size: 0.9rem;">{{ $agama }}</h6>
                                                <small class="text-muted">Rasio: {{ $percentage }}%</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="mb-0" style="color: {{ $data['color'] }}; font-size: 1.5rem;">{{ $data['total'] }}</h4>
                                                <small class="text-muted">Total penduduk</small>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block">L: {{ $data['laki'] }} | P: {{ $data['perempuan'] }}</small>
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
    #chartContainer {
        position: relative;
    }
</style>

@section('js')
<!-- ECharts Library -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let chartInstance = null;
        let chartType = 'pie'; // default chart type
        
        // Data for charts
        const chartData = {
            categories: ['ISLAM', 'KRISTEN PROTESTAN', 'KRISTEN KATOLIK', 'HINDU', 'BUDDHA', 'KONGHUCU', 'AGAMA LAINNYA'],
            values: [
                {{ $penduduk->where('agama', 'ISLAM')->count() }},
                {{ $penduduk->where('agama', 'KRISTEN PROTESTAN')->count() }},
                {{ $penduduk->where('agama', 'KRISTEN KATOLIK')->count() }},
                {{ $penduduk->where('agama', 'HINDU')->count() }},
                {{ $penduduk->where('agama', 'BUDDHA')->count() }},
                {{ $penduduk->where('agama', 'KONGHUCU')->count() }},
                {{ $penduduk->where('agama', 'AGAMA LAINNYA')->count() }}
            ],
            colors: ['#0dcdbd', '#ff6b6b', '#4ecdc4', '#ffe66d', '#95e1d3', '#ff9a76', '#a8e6cf']
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
                        fontSize: 12
                    }
                },
                series: []
            };
            
            if (type === 'pie') {
                baseOption.series.push({
                    name: 'Agama',
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
                    text: 'Distribusi Agama',
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
                    data: chartData.categories.map(name => name.split(' ')[0]),
                    axisLabel: {
                        fontSize: 12,
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
                    text: 'Jumlah Penduduk Berdasarkan Agama',
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
                    name: 'Agama',
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
                    text: 'Rasio Agama',
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
                link.download = `statistik-agama-${new Date().toISOString().split('T')[0]}.png`;
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