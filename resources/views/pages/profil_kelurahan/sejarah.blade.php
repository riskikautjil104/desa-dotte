@extends('layouts.main',['title' => 'Sejarah Desa'])

@section('body')
@section('outmain')
    @include('layouts.header')
    {{-- @include('layouts.hero') --}}
    @include('layouts.page-hero', [
        'title' => 'Sejarah Desa',
        'subtitle' => 'Temukan sejarah terbaru tentang Desa Dotte',
        'breadcrumb' => 'Sejarah',
        'showBreadcrumb' => true
    ])
@endsection
<!-- ======= breadcrumbs Section ======= -->
{{-- <section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li><a href="">Profil Desa</a></li>
                <li>Sejarah Desa</li>
            </ol>
        </div>

    </div>
</section><!-- End breadcrumbs Section --> --}}
<!-- ======= Sejarah Section ======= -->
<section id="sejarah" class="blog">
    <div class="container" data-aos="fade-up">
        @foreach ($sejarah as $sj)
            <p>{!! $sj->isi !!}</p>
        @endforeach
    </div>
   
</section><!-- End Sejarah Section -->

@include('layouts.footer')
@endsection
