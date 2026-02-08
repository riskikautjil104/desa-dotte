@extends('layouts.main', ['title' => 'Peta Desa'])

@section('body')
@section('outmain')
    @include('layouts.header')
    {{-- @include('layouts.hero') --}}
    @include('layouts.page-hero', [
        'title' => 'Peta Desa',
        'subtitle' => 'Temukan peta terbaru tentang Desa Dotte',
        'breadcrumb' => 'Peta Desa',
        'showBreadcrumb' => true
    ])
@endsection
<!-- ======= breadcrumbs Section ======= -->
{{-- <section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Peta Desa</li>
            </ol>
        </div>

    </div>
</section><!-- End breadcrumbs Section --> --}}

<!-- ======= LPM Section ======= -->
<section id="struktur_organisasi" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <div class="mb-5 mt-5" id="map" style=" height :650px;"></div>
        </div>
</section><!-- End LPM Section -->

@include('layouts.footer')
@endsection

@section('js')
<script>
   var map = L.map('map').setView([0.40126270164268124, 128.2993492297192], 17);

// Base layers
var streets = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
});

var satellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3'],
    attribution: '&copy; Google'
});

// Default pakai satellite
satellite.addTo(map);

// Layer control untuk toggle
var baseMaps = {
    "Street Map": streets,
    "Satellite": satellite
};

L.control.layers(baseMaps).addTo(map);

@foreach ($peta as $i)
    L.marker([{{ $i->lat }}, {{ $i->long }}]).addTo(map)
        .bindPopup(
            " <img class='mt-1' width='200px' height='130px' src='{{ asset('storage/' . $i->gambar) }}' alt=''> <br> <h4 class='mt-3'>{{ $i->nama_tempat }}</h4>"
        )
@endforeach
</script>
@endsection
