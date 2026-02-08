@extends('layouts.main',['title' => 'Gambaran Umum Desa'])

@section('body')
@section('outmain')
    @include('layouts.header')
    {{-- @include('layouts.hero') --}}
    @include('layouts.page-hero', [
        'title' => 'Gambaran Umum Desa',
        'subtitle' => 'Temukan gambaran umum terbaru tentang Desa Dotte',
        'breadcrumb' => 'Gambaran Umum',
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
                <li>Gambaran Umum</li>
            </ol>
        </div>

    </div>
</section><!-- End breadcrumbs Section --> --}}

<!-- ======= Gambaran UMUM Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
       
        @foreach ($gambaranumum as $gu)
            <p>{!! $gu->isi !!}</p>
        @endforeach
    </div>
</section><!-- End Gambaran UMUM Section -->

@include('layouts.footer')
@endsection
