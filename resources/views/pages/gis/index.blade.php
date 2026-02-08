@extends('layouts.main', ['title' => 'Peta GIS Desa'])
@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Peta Interaktif Desa Dotte',
        'subtitle' => 'Lihat data wilayah RT/RW beserta statistik kependudukan secara interaktif',
        'breadcrumb' => 'Pemetaan Wilayah RT/RW',
        'showBreadcrumb' => true,
    ])
@endsection

<!-- GIS Section - RESPONSIVE LAYOUT -->
<section class="gis-section" style="padding: 30px 0; background: #f8f9fa;">
    <div class="container-fluid px-3 px-md-4">
        
        <!-- Header dengan layout baru -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <!-- Title di kiri -->
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h1 class="h3 mb-2" style="color: #0dcdbd;">
                                    <i class="bi bi-map me-2"></i>Peta GIS Desa Dotte
                                </h1>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-geo-alt me-1"></i>Visualisasi wilayah RT/RW dengan data statistik
                                </p>
                            </div>
                            
                            <!-- Filter buttons di kanan -->
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    <div class="btn-group shadow-sm" role="group">
                                        <button class="btn btn-outline-primary active" id="btn-show-all" onclick="showAllMarkers()">
                                            <i class="bi bi-globe me-1"></i> Semua
                                        </button>
                                        <button class="btn btn-outline-primary" id="btn-show-rt" onclick="showOnlyRT()">
                                            <i class="bi bi-house me-1"></i> RT
                                        </button>
                                        <button class="btn btn-outline-primary" id="btn-show-rw" onclick="showOnlyRW()">
                                            <i class="bi bi-building me-1"></i> RW
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="row g-4">
            <!-- Map Area - Lebih besar di desktop -->
            <div class="col-xl-8 col-lg-7">
                <!-- Map Controls -->
                <div class="card border-0 shadow-sm rounded-3 mb-3">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-muted"><i class="bi bi-palette"></i> Tema:</span>
                                    <select id="mapLayer" class="form-select form-select-sm" style="width: 200px;" onchange="changeMapLayer()">
                                        <option value="streets">Jalan (Default)</option>
                                        <option value="satellite">Satelit</option>
                                        <option value="light">Light Mode</option>
                                        <option value="dark">Dark Mode</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="form-check form-switch me-3">
                                    <input class="form-check-input" type="checkbox" id="showBoundary" checked onchange="toggleBoundary()">
                                    <label class="form-check-label small" for="showBoundary">
                                        <i class="bi bi-boundary me-1"></i>Batas Desa
                                    </label>
                                </div>
                                <div class="text-muted small d-none d-md-block">
                                    <i class="bi bi-mouse me-1"></i>Scroll untuk zoom
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Container -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-0" style="border-radius: 12px; overflow: hidden;">
                        <div id="gisMap" style="height: 550px; width: 100%;"></div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Panel - Lebih rapi -->
            <div class="col-xl-4 col-lg-5">
                <!-- Informasi Wilayah -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header d-flex align-items-center" style="background: linear-gradient(135deg, #0dcdbd 0%, #0abab5 100%);">
                        <i class="bi bi-info-circle text-white fs-5 me-2"></i>
                        <h5 class="mb-0 text-white">Informasi Wilayah</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center py-3" id="defaultInfo">
                            <div class="mb-3">
                                <i class="bi bi-map text-muted" style="font-size: 3.5rem;"></i>
                            </div>
                            <h6 class="text-muted mb-2">Pilih Area di Peta</h6>
                            <p class="text-muted small">
                                Klik pada marker RT/RW untuk melihat detail informasi wilayah
                            </p>
                        </div>
                        <div id="detailInfo" style="display: none;"></div>
                    </div>
                </div>

                <!-- Statistik Cepat -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6 col-lg-12 col-xl-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-body p-3 text-center">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="rounded-circle p-2 me-2" style="background-color: rgba(13, 205, 189, 0.1);">
                                        <i class="bi bi-house-door" style="color: #0dcdbd; font-size: 1.2rem;"></i>
                                    </div>
                                    <h3 class="mb-0" style="color: #0dcdbd;" id="totalRt">{{ $rts->count() }}</h3>
                                </div>
                                <p class="text-muted mb-0 small">Total RT</p>
                                <small class="text-muted" id="totalRtGis">
                                    ({{ $rts->whereNotNull('latitude')->count() }} terpetakan)
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12 col-xl-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-body p-3 text-center">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="rounded-circle p-2 me-2" style="background-color: rgba(25, 135, 84, 0.1);">
                                        <i class="bi bi-buildings" style="color: #198754; font-size: 1.2rem;"></i>
                                    </div>
                                    <h3 class="mb-0 text-success" id="totalRw">{{ $rws->count() }}</h3>
                                </div>
                                <p class="text-muted mb-0 small">Total RW</p>
                                <small class="text-muted" id="totalRwGis">
                                    ({{ $rws->whereNotNull('latitude')->count() }} terpetakan)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legenda -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="bi bi-key me-2" style="color: #0dcdbd;"></i>Keterangan Peta
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="marker-preview me-2" 
                                         style="width: 20px; height: 20px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); background-color: #0dcdbd;"></div>
                                    <small>RT</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="marker-preview me-2" 
                                         style="width: 22px; height: 22px; border-radius: 50%; background-color: #198754;"></div>
                                    <small>RW</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="border-preview me-2" 
                                         style="width: 20px; height: 20px; border: 2px dashed #dc3545;"></div>
                                    <small>Batas Desa</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="marker-preview me-2" 
                                         style="width: 18px; height: 18px; border-radius: 50%; background-color: #ffc107;"></div>
                                    <small>Tanpa Koordinat</small>
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="small text-muted">
                            <i class="bi bi-info-circle me-1"></i> 
                            Data diperbarui secara berkala oleh admin desa
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@include('layouts.footer')
@endsection

@section('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    /* Responsive layout tanpa mengganggu map */
    .gis-section {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Map container styling */
    #gisMap {
        min-height: 500px;
        border-radius: 10px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        #gisMap {
            height: 400px !important;
            min-height: 400px;
        }
        
        .card-body {
            padding: 1rem !important;
        }
        
        .btn-group {
            width: 100%;
        }
        
        .btn-group .btn {
            flex: 1;
        }
    }
    
    @media (max-width: 576px) {
        #gisMap {
            height: 350px !important;
        }
        
        .h3 {
            font-size: 1.5rem !important;
        }
    }
    
    /* Button styling */
    .btn-outline-primary.active {
        background-color: #0dcdbd !important;
        border-color: #0dcdbd !important;
        color: white !important;
    }
    
    .btn-outline-primary {
        border-color: #0dcdbd;
        color: #0dcdbd;
    }
    
    .btn-outline-primary:hover {
        background-color: rgba(13, 205, 189, 0.1);
    }
    
    /* Card hover effects */
    .card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
    
    /* Marker preview in legend */
    .marker-preview, .border-preview {
        flex-shrink: 0;
    }
</style>
@endsection

@section('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // === JAVASCRIPT ASLI YANG SUDAH BEKERJA - TIDAK DIUBAH ===
    let map;
    let rtMarkers = [];
    let rwMarkers = [];
    let currentMarkers = [];
    let detailChart = null;
    let currentTileLayer = null;
    let boundaryLayer = null;

    // Batas wilayah Desa Dotte - koordinat polygon (lat, lng)
    const desaDotteBoundary = [
        [0.3985834, 128.2958151],
        [0.3999566, 128.2966305],
        [0.4001497, 128.297639],
        [0.4001497, 128.2986476],
        [0.400021, 128.2995488],
        [0.3998279, 128.2992913],
        [0.3990125, 128.3009435],
        [0.3984117, 128.3021452],
        [0.3983902, 128.3038832],
        [0.3983902, 128.3071448],
        [0.3980469, 128.3091833],
        [0.398283, 128.3103634],
        [0.3989696, 128.3116938],
        [0.3998708, 128.3111145],
        [0.4024886, 128.3075739],
        [0.4030464, 128.303218],
        [0.4040335, 128.299184],
        [0.4035185, 128.2963516],
        [0.402274, 128.294871],
        [0.4014586, 128.2943775],
        [0.4006432, 128.2947852],
        [0.3995704, 128.2950427],
        [0.3984117, 128.2950427],
        [0.3985834, 128.2958151]
    ];

    // Map layer configurations
    const mapLayers = {
        streets: {
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        },
        satellite: {
            url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
            attribution: '&copy; Esri'
        },
        satelliteStreets: {
            url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
            attribution: '&copy; Esri'
        },
        light: {
            url: 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
        },
        dark: {
            url: 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
        },
        topo: {
            url: 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, SRTM | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a>'
        }
    };

    // Initialize map
    document.addEventListener('DOMContentLoaded', function() {
        // Default center (Desa Dotte - Maluku)
        const defaultCenter = [0.40075158553336077, 128.29806820804015];

        map = L.map('gisMap').setView(defaultCenter, 15);

        // Set default layer (streets)
        changeMapLayer('streets');

        // Load markers
        loadMarkers();

        // Load boundary
        loadBoundary();
    });

    // Function to load boundary polygon
    function loadBoundary() {
        // Create polygon
        boundaryLayer = L.polygon(desaDotteBoundary, {
            color: '#dc3545',
            fillColor: '#dc3545',
            fillOpacity: 0.2,
            weight: 3
        }).addTo(map);

        // Add tooltip
        boundaryLayer.bindTooltip('Batas Wilayah Desa Dotte', {
            permanent: false,
            direction: 'center'
        });
    }

    // Function to toggle boundary visibility
    function toggleBoundary() {
        const checkbox = document.getElementById('showBoundary');
        if (checkbox.checked) {
            if (boundaryLayer) {
                map.addLayer(boundaryLayer);
            }
        } else {
            if (boundaryLayer) {
                map.removeLayer(boundaryLayer);
            }
        }
    }

    // Function to change map layer
    function changeMapLayer(layerName) {
        const layer = layerName || document.getElementById('mapLayer').value;
        const layerConfig = mapLayers[layer];

        if (!layerConfig) return;

        // Remove existing tile layer
        if (currentTileLayer) {
            map.removeLayer(currentTileLayer);
        }

        // Add new tile layer
        currentTileLayer = L.tileLayer(layerConfig.url, {
            attribution: layerConfig.attribution
        }).addTo(map);

        // For satellite + streets, add street labels overlay
        if (layer === 'satelliteStreets') {
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; CARTO',
                subdomains: 'abcd',
                maxZoom: 19
            }).addTo(map);
        }
    }

    function loadMarkers() {
        // Clear existing markers
        clearMarkers();

        // Fetch data from API
        fetch('{{ route('gis.api.all') }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Create RT markers
                    data.rts.forEach(rt => {
                        const marker = createRTMarker(rt);
                        rtMarkers.push(marker);
                        marker.addTo(map);
                    });

                    // Create RW markers
                    data.rws.forEach(rw => {
                        const marker = createRWMarker(rw);
                        rwMarkers.push(marker);
                        marker.addTo(map);
                    });

                    currentMarkers = [...rtMarkers, ...rwMarkers];
                }
            })
            .catch(error => console.error('Error loading markers:', error));
    }

    function createRTMarker(rt) {
        const icon = L.divIcon({
            className: 'custom-marker-rt',
            html: `<div style="
                background: #0dcdbd;
                width: 32px;
                height: 32px;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                display: flex;
                align-items: center;
                justify-content: center;
                border: 3px solid white;
                box-shadow: 0 3px 10px rgba(0,0,0,0.3);
            ">
                <span style="
                    transform: rotate(45deg);
                    color: white;
                    font-weight: bold;
                    font-size: 12px;
                ">${rt.nama.replace('RT ', '')}</span>
            </div>`,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        const marker = L.marker([rt.latitude, rt.longitude], {
                icon: icon
            })
            .bindPopup(createPopupContent(rt, 'RT'));

        marker.on('click', function() {
            showDetail(rt.type, rt.id, rt.nama);
        });

        return marker;
    }

    function createRWMarker(rw) {
        const icon = L.divIcon({
            className: 'custom-marker-rw',
            html: `<div style="
                background: #198754;
                width: 38px;
                height: 38px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 3px solid white;
                box-shadow: 0 3px 10px rgba(0,0,0,0.3);
            ">
                <span style="
                    color: white;
                    font-weight: bold;
                    font-size: 13px;
                ">${rw.nama.replace('RW ', '')}</span>
            </div>`,
            iconSize: [38, 38],
            iconAnchor: [19, 19],
            popupAnchor: [0, -19]
        });

        const marker = L.marker([rw.latitude, rw.longitude], {
                icon: icon
            })
            .bindPopup(createPopupContent(rw, 'RW'));

        marker.on('click', function() {
            showDetail(rw.type, rw.id, rw.nama);
        });

        return marker;
    }

    function createPopupContent(data, type) {
        return `
            <div style="min-width: 200px;">
                <h6 class="mb-2"><strong>${type}</strong></h6>
                <p class="mb-1"><strong>Total Penduduk:</strong> ${data.total_penduduk}</p>
                <p class="mb-1"><span style="color: #0dcdbd;">👨 Laki-laki:</span> ${data.laki_laki}</p>
                <p class="mb-0"><span style="color: #e83e8c;">👩 Perempuan:</span> ${data.perempuan}</p>
                <hr class="my-2">
                <button class="btn btn-sm w-100" onclick="showDetail('${data.type}', ${data.id}, '${data.nama}')" style="background-color: #0dcdbd; color: white;">
                    Lihat Detail Lengkap
                </button>
            </div>
        `;
    }

    function showDetail(type, id, nama) {
        const url = type === 'rt' ?
            `{{ route('gis.api.rt', ':id') }}`.replace(':id', id) :
            `{{ route('gis.api.rw', ':id') }}`.replace(':id', id);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayDetailInfo(data.data, type);
                }
            })
            .catch(error => console.error('Error loading detail:', error));
    }

    function displayDetailInfo(data, type) {
        document.getElementById('defaultInfo').style.display = 'none';
        const detailInfo = document.getElementById('detailInfo');
        detailInfo.style.display = 'block';

        // Calculate percentages for charts
        const total = data.total_penduduk || 1;
        const lakiPct = Math.round((data.laki_laki / total) * 100);
        const perempuanPct = Math.round((data.perempuan / total) * 100);

        // Create HTML content
        let html = `
            <div class="mb-3">
                <h5 style="color: #0dcdbd;">${type === 'rt' ? 'RT' : 'RW'} ${data.nama_rt || data.nama_rw}</h5>
                <span class="badge bg-success">Memiliki Koordinat</span>
            </div>
            
            <!-- Gender Chart -->
            <div class="mb-3">
                <h6 class="border-bottom pb-2">Jenis Kelamin</h6>
                <div style="height: 150px;">
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <small><span style="color: #0dcdbd;">●</span> Laki-laki: ${data.laki_laki} (${lakiPct}%)</small>
                    <small><span style="color: #e83e8c;">●</span> Perempuan: ${data.perempuan} (${perempuanPct}%)</small>
                </div>
            </div>
            
            <!-- Stats Grid -->
            <div class="row mb-3">
                <div class="col-6">
                    <div class="bg-light rounded p-2 text-center">
                        <h5 class="mb-0" style="color: #0dcdbd;">${data.total_penduduk}</h5>
                        <small class="text-muted">Total Penduduk</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light rounded p-2 text-center">
                        <h5 class="mb-0 text-success">${data.jumlah_kk}</h5>
                        <small class="text-muted">Jumlah KK</small>
                    </div>
                </div>
            </div>
            
            <!-- Age Groups -->
            <div class="mb-3">
                <h6 class="border-bottom pb-2">Kelompok Umur</h6>
                <div class="d-flex justify-content-between mb-1">
                    <small>0-14 Tahun</small>
                    <small style="color: #0dcdbd;">${data.kelompok_usia['0_14_tahun']}</small>
                </div>
                <div class="progress mb-2" style="height: 8px;">
                    <div class="progress-bar bg-info" style="width: ${(data.kelompok_usia['0_14_tahun']/total)*100}%"></div>
                </div>
                
                <div class="d-flex justify-content-between mb-1">
                    <small>15-59 Tahun</small>
                    <small class="text-success">${data.kelompok_usia['15_59_tahun']}</small>
                </div>
                <div class="progress mb-2" style="height: 8px;">
                    <div class="progress-bar bg-success" style="width: ${(data.kelompok_usia['15_59_tahun']/total)*100}%"></div>
                </div>
                
                <div class="d-flex justify-content-between mb-1">
                    <small>60+ Tahun</small>
                    <small class="text-warning">${data.kelompok_usia['60_plus_tahun']}</small>
                </div>
                <div class="progress mb-2" style="height: 8px;">
                    <div class="progress-bar bg-warning" style="width: ${(data.kelompok_usia['60_plus_tahun']/total)*100}%"></div>
                </div>
            </div>
            
            <!-- Pendidikan -->
            <div class="mb-3">
                <h6 class="border-bottom pb-2">Pendidikan Tertinggi</h6>
                ${data.pendidikan && data.pendidikan.length > 0 ? `
                                                                <ul class="list-unstyled mb-0">
                                                                    ${data.pendidikan.slice(0, 3).map(p => `
                            <li class="d-flex justify-content-between small">
                                <span>${p.nama}</span>
                                <span style="color: #0dcdbd;">${p.jumlah}</span>
                            </li>
                        `).join('')}
                                                                    ${data.pendidikan.length > 3 ? `<li class="text-muted small text-center mt-1">+${data.pendidikan.length - 3} lainnya</li>` : ''}
                                                                </ul>
                                                            ` : '<p class="text-muted small">Data pendidikan tidak tersedia</p>'}
            </div>
            
            <!-- Pekerjaan -->
            <div class="mb-3">
                <h6 class="border-bottom pb-2">Pekerjaan Utama</h6>
                ${data.pekerjaan && data.pekerjaan.length > 0 ? `
                                                                <ul class="list-unstyled mb-0">
                                                                    ${data.pekerjaan.slice(0, 3).map(p => `
                            <li class="d-flex justify-content-between small">
                                <span>${p.nama}</span>
                                <span class="text-success">${p.jumlah}</span>
                            </li>
                        `).join('')}
                                                                    ${data.pekerjaan.length > 3 ? `<li class="text-muted small text-center mt-1">+${data.pekerjaan.length - 3} lainnya</li>` : ''}
                                                                </ul>
                                                            ` : '<p class="text-muted small">Data pekerjaan tidak tersedia</p>'}
            </div>
        `;

        detailInfo.innerHTML = html;

        // Create gender chart
        const ctx = document.getElementById('genderChart');
        if (ctx) {
            if (detailChart) detailChart.destroy();

            detailChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-Laki', 'Perempuan'],
                    datasets: [{
                        data: [data.laki_laki, data.perempuan],
                        backgroundColor: ['#0dcdbd', '#e83e8c'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    }

    function clearMarkers() {
        rtMarkers.forEach(m => map.removeLayer(m));
        rwMarkers.forEach(m => map.removeLayer(m));
        // Don't clear arrays, we need to keep the markers!
    }

    function showAllMarkers() {
        clearMarkers();
        rtMarkers.forEach(m => m.addTo(map));
        rwMarkers.forEach(m => m.addTo(map));
        currentMarkers = [...rtMarkers, ...rwMarkers];
        updateButtonState('btn-show-all');
    }

    function showOnlyRT() {
        clearMarkers();
        rtMarkers.forEach(m => m.addTo(map));
        currentMarkers = [...rtMarkers];
        updateButtonState('btn-show-rt');
    }

    function showOnlyRW() {
        clearMarkers();
        rwMarkers.forEach(m => m.addTo(map));
        currentMarkers = [...rwMarkers];
        updateButtonState('btn-show-rw');
    }

    function fitBoundsToMarkers() {
        if (currentMarkers.length > 0) {
            const group = new L.featureGroup(currentMarkers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }

    function updateButtonState(activeId) {
        ['btn-show-all', 'btn-show-rt', 'btn-show-rw'].forEach(id => {
            const btn = document.getElementById(id);
            if (id === activeId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    // Make functions globally available
    window.showAllMarkers = showAllMarkers;
    window.showOnlyRT = showOnlyRT;
    window.showOnlyRW = showOnlyRW;
    window.showDetail = showDetail;
    window.toggleBoundary = toggleBoundary;
    window.changeMapLayer = changeMapLayer;
</script>

<style>
    .custom-marker-rt,
    .custom-marker-rw {
        background: transparent !important;
        border: none !important;
    }

    .gis-section .card {
        transition: all 0.3s ease;
    }

    .gis-section .card:hover {
        transform: translateY(-2px);
    }

    .marker-legend {
        display: inline-block;
    }

    .btn-group .btn.active {
        background-color: #0dcdbd;
        color: white;
        border-color: #0dcdbd;
    }

    .btn-group .btn {
        transition: all 0.2s ease;
    }
</style>