@extends('layouts.main', ['title' => 'Struktur Organisasi Pemuda'])

@section('body')
@section('outmain')
    @include('layouts.header')
    {{-- @include('layouts.hero') --}}
@endsection
<!-- ======= breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li><a href="">Profil Desa</a></li>
                <li>Struktur Organisasi Pemuda</li>
            </ol>
        </div>

    </div>
</section><!-- End breadcrumbs Section -->
<!-- ======= Struktur Organisasi Section ======= -->
<section id="struktur_organisasi" class="blog">
    <div class="container d-flex justify-content-center" data-aos="fade-up">
        @foreach ($struktur as $so)
            <img class="img-fluid" id="image" src="{{ asset('storage/' . $so->gambar) }}" alt=""
                style="border-radius: 3%">
        @endforeach
</section><!-- End Struktur Organisasi Section -->

@include('layouts.footer')
@endsection
