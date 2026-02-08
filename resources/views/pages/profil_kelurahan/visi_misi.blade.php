
@extends('layouts.main',['title' => 'Visi & Misi Desa'])
@section('meta-description', 'Visi dan misi Desa Dotte untuk mewujudkan desa yang maju, mandiri, sejahtera, dan berdaya saing berlandaskan gotong royong dan kearifan lokal.')
@section('body')
@section('outmain')
    @include('layouts.header')
    {{-- @include('layouts.hero') --}}
    @include('layouts.page-hero', [
        'title' => 'Visi & Misi Desa',
        'subtitle' => 'Temukan visi & misi terbaru tentang Desa Dotte',
        'breadcrumb' => 'Visi & Misi',
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
                <li>Visi & Misi</li>
            </ol>
        </div>

    </div>
</section><!-- End breadcrumbs Section --> --}}

<!-- ======= Visi & Misi Section ======= -->
<section id="visi_misi" class="blog">
    <div class="container" data-aos="fade-up">
        
        @foreach ($visimisi as $vm)
            <p>{!! $vm->isi !!}</p>
        @endforeach
</section><!-- End Visi & Misi Section -->

@include('layouts.footer')
@endsection
