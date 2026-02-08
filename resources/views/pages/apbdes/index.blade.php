@extends('layouts.main', ['title' => 'APBDes Desa'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'APBDes Desa',
        'subtitle' => 'Temukan APBDes terbaru tentang Desa Dotte',
        'breadcrumb' => 'APBDes',
        'showBreadcrumb' => true,
    ])
@endsection

<!-- ======= APBDes Section ======= -->
<section id="apbdes" class="py-4 py-lg-5">
    <div class="container" data-aos="fade-up">
        <!-- Header Section -->
        <div class="section-title text-center mb-4 mb-lg-5">
            <h2 class="fw-bold mb-3">APB Desa Dotte</h2>
            <p id="yearText" class="text-muted lead">
                Perbandingan Anggaran Pendapatan dan Belanja Desa Dotte Tahun {{ now()->year }}
            </p>
        </div>

        <!-- Year Selection -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="yearSelect" class="form-label fw-medium mb-2">
                                <i class="bi bi-calendar-event me-2" style="color: #0dcdbd;"></i>Pilih Tahun APBDes
                            </label>
                            <select id="yearSelect" class="form-select form-select-lg">
                                <option selected value="">-- Pilih Tahun --</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-3 mb-4">
            <!-- Pendapatan Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 205, 189, 0.1);">
                                <i class="bi bi-arrow-down-circle fs-4" style="color: #0dcdbd;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Pendapatan</h6>
                                <h4 id="pendapatanText" class="mb-0 fw-bold" style="color: #0dcdbd;">
                                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: 100%; background-color: #0dcdbd;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Belanja Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(220, 53, 69, 0.1);">
                                <i class="bi bi-arrow-up-circle fs-4 text-danger"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Belanja</h6>
                                <h4 id="belanjaText" class="mb-0 fw-bold text-danger">
                                    Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: 100%; background-color: #dc3545;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surplus/Defisit Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" 
                                 style="background-color: rgba({{ $surplusDefisit >= 0 ? '25,135,84' : '220,53,69' }}, 0.1);">
                                <i class="bi bi-graph-up-arrow fs-4" 
                                   style="color: {{ $surplusDefisit >= 0 ? '#198754' : '#dc3545' }};"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Surplus/Defisit</h6>
                                <h4 id="surplusDefisitText" class="mb-0 fw-bold" 
                                    style="color: {{ $surplusDefisit >= 0 ? '#198754' : '#dc3545' }};">
                                    Rp {{ number_format(abs($surplusDefisit), 0, ',', '.') }}
                                    <small class="d-block fs-6 fw-normal">
                                        ({{ $surplusDefisit >= 0 ? 'Surplus' : 'Defisit' }})
                                    </small>
                                </h4>
                            </div>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" 
                                 style="width: 100%; background-color: {{ $surplusDefisit >= 0 ? '#198754' : '#dc3545' }};"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tahun Aktif Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(13, 110, 253, 0.1);">
                                <i class="bi bi-calendar-check fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Tahun Aktif</h6>
                                <h4 id="currentYear" class="mb-0 fw-bold text-primary">
                                    {{ now()->year }}
                                </h4>
                            </div>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: 100%; background-color: #0d6efd;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pembiayaan Cards -->
        <div class="row g-3 mb-5">
            <!-- Penerimaan Card -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(32, 201, 151, 0.1);">
                                <i class="bi bi-cash-coin fs-4" style="color: #20c997;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Penerimaan Pembiayaan</h6>
                                <h4 id="penerimaanText" class="mb-0 fw-bold" style="color: #20c997;">
                                    Rp {{ number_format($penerimaan, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Sumber Pembiayaan</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengeluaran Card -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-2 me-3" style="background-color: rgba(253, 126, 20, 0.1);">
                                <i class="bi bi-cash-stack fs-4" style="color: #fd7e14;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Pengeluaran Pembiayaan</h6>
                                <h4 id="pengeluaranText" class="mb-0 fw-bold" style="color: #fd7e14;">
                                    Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Penggunaan Dana</span>
                            <span class="badge bg-warning">Dikelola</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4">
            <!-- Pendapatan vs Belanja Per Tahun -->
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-bar-chart-line me-2" style="color: #0dcdbd;"></i>
                            Trend Pendapatan vs Belanja Per Tahun
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="all" style="min-height: 400px;"></div>
                    </div>
                </div>
            </div>

            <!-- Pendapatan Details -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 mb-4 h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-pie-chart-fill me-2" style="color: #0dcdbd;"></i>
                            Detail Pendapatan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="pendapatanChart" style="min-height: 350px;"></div>
                    </div>
                </div>
            </div>

            <!-- Belanja Details -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 mb-4 h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-pie-chart me-2 text-danger"></i>
                            Detail Belanja
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="belanjaChart" style="min-height: 350px;"></div>
                    </div>
                </div>
            </div>

            <!-- Pembiayaan Details -->
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-cash-stack me-2" style="color: #20c997;"></i>
                            Detail Pembiayaan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="pembiayaanChart" style="min-height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom Styles for APBDes Page */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Custom progress bars */
    .progress {
        background-color: rgba(13, 205, 189, 0.1);
        border-radius: 10px;
    }
    
    .progress-bar {
        border-radius: 10px;
    }
    
    /* Card styling */
    .card.border-0.shadow-sm {
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
    }
    
    /* Form styling */
    .form-select-lg {
        padding: 0.75rem 2.25rem 0.75rem 1rem;
        font-size: 1.1rem;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .form-select-lg:focus {
        border-color: #0dcdbd;
        box-shadow: 0 0 0 0.25rem rgba(13, 205, 189, 0.25);
    }
    
    /* Chart containers */
    #all, #pendapatanChart, #belanjaChart, #pembiayaanChart {
        position: relative;
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
        
        .form-select-lg {
            font-size: 1rem;
            padding: 0.5rem 2rem 0.5rem 0.75rem;
        }
        
        h4.fw-bold {
            font-size: 1.25rem;
        }
        
        h6 {
            font-size: 0.875rem;
        }
        
        /* Adjust chart height for mobile */
        #all, #pendapatanChart, #belanjaChart, #pembiayaanChart {
            min-height: 300px !important;
        }
        
        /* Stack cards on mobile */
        .col-md-6, .col-lg-3, .col-lg-6 {
            margin-bottom: 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .section-title h2 {
            font-size: 1.5rem;
        }
        
        .card-header h5 {
            font-size: 1.1rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        /* Smaller font sizes for very small screens */
        h4.fw-bold {
            font-size: 1.1rem;
        }
        
        .badge {
            font-size: 0.75rem;
        }
        
        /* Adjust icon sizes */
        .fs-4 {
            font-size: 1.25rem !important;
        }
        
        .rounded-circle.p-2.me-3 {
            padding: 0.5rem !important;
            margin-right: 0.75rem !important;
        }
    }
    
    /* Animation for numbers */
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
    
    .card h4 {
        animation: countUp 0.5s ease;
    }
</style>

@section('js')
<!-- ECharts Library -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const yearSelect = document.getElementById('yearSelect');
        const pendapatanText = document.getElementById('pendapatanText');
        const belanjaText = document.getElementById('belanjaText');
        const penerimaanText = document.getElementById('penerimaanText');
        const pengeluaranText = document.getElementById('pengeluaranText');
        const surplusDefisitText = document.getElementById('surplusDefisitText');
        const currentYear = document.getElementById('currentYear');
        const yearText = document.getElementById('yearText');

        const years = @json($years);
        const pendapatanValuesByYear = @json($pendapatanValuesByYear);
        const belanjaValuesByYear = @json($belanjaValuesByYear);

        const nowYear = new Date().getFullYear();
        yearSelect.value = nowYear;

        // Format currency function
        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        }

        // Format large numbers
        function formatNumber(value) {
            if (value >= 1000000000) {
                return (value / 1000000000).toFixed(1) + 'M';
            }
            if (value >= 1000000) {
                return (value / 1000000).toFixed(1) + 'Jt';
            }
            if (value >= 1000) {
                return (value / 1000).toFixed(1) + 'K';
            }
            return value.toString();
        }

        // Initialize charts
        function initCharts() {
            // Chart 1: Yearly Comparison
            const chart1 = echarts.init(document.getElementById('all'));
            chart1.setOption({
                title: {
                    text: 'Perbandingan Pendapatan dan Belanja Desa (Per Tahun)',
                    left: 'center',
                    textStyle: {
                        fontSize: 16,
                        fontWeight: 'bold'
                    }
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    },
                    formatter: function(params) {
                        let result = `<strong>${params[0].axisValue}</strong><br/>`;
                        params.forEach(item => {
                            result += `${item.marker} ${item.seriesName}: ${formatCurrency(item.value)}<br/>`;
                        });
                        return result;
                    }
                },
                legend: {
                    data: ['Pendapatan', 'Belanja'],
                    bottom: 10,
                    textStyle: {
                        fontSize: 12
                    }
                },
                xAxis: {
                    type: 'category',
                    data: years,
                    axisLabel: {
                        fontSize: 11,
                        rotate: 45
                    }
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        fontSize: 11,
                        formatter: function(value) {
                            return formatNumber(value);
                        }
                    }
                },
                series: [{
                        name: 'Pendapatan',
                        type: 'bar',
                        data: pendapatanValuesByYear,
                        itemStyle: {
                            color: '#0dcdbd',
                            borderRadius: [4, 4, 0, 0]
                        },
                        barWidth: '40%'
                    },
                    {
                        name: 'Belanja',
                        type: 'bar',
                        data: belanjaValuesByYear,
                        itemStyle: {
                            color: '#dc3545',
                            borderRadius: [4, 4, 0, 0]
                        },
                        barWidth: '40%'
                    }
                ],
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '15%',
                    containLabel: true
                }
            });

            // Chart 2: Pendapatan Details
            const chart2 = echarts.init(document.getElementById('pendapatanChart'));
            chart2.setOption({
                title: {
                    text: 'Komposisi Pendapatan',
                    left: 'center',
                    textStyle: {
                        fontSize: 14,
                        fontWeight: 'bold'
                    }
                },
                tooltip: {
                    trigger: 'item',
                    formatter: function(params) {
                        const total = params.data.value;
                        const percentage = params.percent;
                        return `
                            <strong>${params.name}</strong><br/>
                            Jumlah: ${formatCurrency(total)}<br/>
                            Persentase: ${percentage}%
                        `;
                    }
                },
                legend: {
                    orient: 'vertical',
                    right: 10,
                    top: 'middle',
                    textStyle: {
                        fontSize: 11
                    }
                },
                series: [{
                    name: 'Pendapatan',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 8,
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
                    data: @json($pendapatan->map(function($value, $key) {
                        return ['name' => $key, 'value' => $value];
                    })->values()),
                    color: ['#0dcdbd', '#1aafbc', '#2891bb', '#3573ba', '#4255b9']
                }]
            });

            // Chart 3: Belanja Details
            const chart3 = echarts.init(document.getElementById('belanjaChart'));
            chart3.setOption({
                title: {
                    text: 'Komposisi Belanja',
                    left: 'center',
                    textStyle: {
                        fontSize: 14,
                        fontWeight: 'bold'
                    }
                },
                tooltip: {
                    trigger: 'item',
                    formatter: function(params) {
                        const total = params.data.value;
                        const percentage = params.percent;
                        return `
                            <strong>${params.name}</strong><br/>
                            Jumlah: ${formatCurrency(total)}<br/>
                            Persentase: ${percentage}%
                        `;
                    }
                },
                legend: {
                    orient: 'vertical',
                    right: 10,
                    top: 'middle',
                    textStyle: {
                        fontSize: 11
                    }
                },
                series: [{
                    name: 'Belanja',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 8,
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
                    data: @json($belanja->map(function($value, $key) {
                        return ['name' => $key, 'value' => $value];
                    })->values()),
                    color: ['#dc3545', '#e35d6a', '#ea858f', '#f0adb4', '#f7d5d9']
                }]
            });

            // Chart 4: Pembiayaan Details
            const chart4 = echarts.init(document.getElementById('pembiayaanChart'));
            const pembiayaanData = {
                categories: ['Penerimaan', 'Pengeluaran'],
                values: [@json($penerimaan), @json($pengeluaran)]
            };
            
            chart4.setOption({
                title: {
                    text: 'Pembiayaan Desa',
                    left: 'center',
                    textStyle: {
                        fontSize: 14,
                        fontWeight: 'bold'
                    }
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    },
                    formatter: function(params) {
                        const value = params[0].value;
                        const name = params[0].name;
                        return `<strong>${name}</strong><br/>Jumlah: ${formatCurrency(value)}`;
                    }
                },
                xAxis: {
                    type: 'category',
                    data: pembiayaanData.categories,
                    axisLabel: {
                        fontSize: 12
                    }
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        fontSize: 11,
                        formatter: function(value) {
                            return formatNumber(value);
                        }
                    }
                },
                series: [{
                    name: 'Pembiayaan',
                    type: 'bar',
                    data: pembiayaanData.values,
                    itemStyle: {
                        color: function(params) {
                            return params.dataIndex === 0 ? '#20c997' : '#fd7e14';
                        },
                        borderRadius: [4, 4, 0, 0]
                    },
                    barWidth: '60%',
                    label: {
                        show: true,
                        position: 'top',
                        formatter: function(params) {
                            return formatCurrency(params.value);
                        },
                        fontSize: 11
                    }
                }],
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                }
            });

            // Handle window resize for all charts
            function resizeCharts() {
                chart1.resize();
                chart2.resize();
                chart3.resize();
                chart4.resize();
            }

            window.addEventListener('resize', resizeCharts);

            // Return chart instances for updates
            return { chart1, chart2, chart3, chart4 };
        }

        // Initialize charts
        let charts = initCharts();

        // Handle year selection change
        yearSelect.addEventListener('change', async (event) => {
            const selectedYear = event.target.value || nowYear;
            
            // Update text elements
            yearText.textContent = `Perbandingan Anggaran Pendapatan dan Belanja Desa Dotte Tahun ${selectedYear}`;
            currentYear.textContent = selectedYear;

            try {
                // Show loading state
                yearSelect.disabled = true;
                yearSelect.classList.add('opacity-50');

                // Fetch data for selected year
                const response = await fetch(`/apbdes/data?year=${selectedYear}`);
                const data = await response.json();
                
                const { pendapatan, belanja, pembiayaan } = data;
                const surplusDefisit = pendapatan.total - belanja.total;

                // Update summary cards with animation
                animateNumber(pendapatanText, pendapatan.total, '#0dcdbd');
                animateNumber(belanjaText, belanja.total, '#dc3545');
                animateNumber(penerimaanText, pembiayaan.penerimaan, '#20c997');
                animateNumber(pengeluaranText, pembiayaan.pengeluaran, '#fd7e14');
                
                // Update surplus/deficit with color based on value
                const surplusColor = surplusDefisit >= 0 ? '#198754' : '#dc3545';
                const surplusText = surplusDefisit >= 0 ? 'Surplus' : 'Defisit';
                animateNumber(surplusDefisitText, Math.abs(surplusDefisit), surplusColor, surplusText);

                // Update charts
                charts.chart2.setOption({
                    series: [{
                        data: pendapatan.categories.map((name, index) => ({
                            name,
                            value: pendapatan.values[index]
                        }))
                    }]
                });

                charts.chart3.setOption({
                    series: [{
                        data: belanja.categories.map((name, index) => ({
                            name,
                            value: belanja.values[index]
                        }))
                    }]
                });

                charts.chart4.setOption({
                    series: [{
                        data: [pembiayaan.penerimaan, pembiayaan.pengeluaran]
                    }]
                });

                // Show success toast
                showToast(`Data APBDes Tahun ${selectedYear} berhasil dimuat`, 'success');

            } catch (error) {
                console.error('Error fetching APBDes data:', error);
                showToast('Gagal memuat data APBDes', 'error');
            } finally {
                // Re-enable select
                yearSelect.disabled = false;
                yearSelect.classList.remove('opacity-50');
            }
        });

        // Animate number changes
        function animateNumber(element, newValue, color, suffix = '') {
            const currentValue = parseInt(element.textContent.replace(/[^0-9]/g, ''));
            const duration = 1000;
            const startTime = Date.now();
            const suffixHtml = suffix ? `<small class="d-block fs-6 fw-normal">(${suffix})</small>` : '';

            function updateNumber() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const current = Math.floor(currentValue + (newValue - currentValue) * progress);
                
                element.innerHTML = `${formatCurrency(current)}${suffixHtml}`;
                element.style.color = color;

                if (progress < 1) {
                    requestAnimationFrame(updateNumber);
                }
            }

            updateNumber();
        }

        // Toast notification
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'error' ? 'danger' : 'info'} border-0`;
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
    });
</script>
@endsection

@include('layouts.footer')
@endsection