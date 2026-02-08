@extends('layouts.main', ['title' => 'Galeri'])

@section('body')

@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Galeri Desa',
        'subtitle' => 'Temukan galeri terbaru tentang Desa Dotte',
        'breadcrumb' => 'Galeri',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= breadcrumbs Section ======= -->
{{-- <section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Galeri</li>
            </ol>
        </div>
    </div>
</section><!-- End breadcrumbs Section --> --}}

<!-- ======= Gallery Section ======= -->
<section id="gallery" class="gallery">
    <div class="container" data-aos="fade-up">
        <div class="row">
            @foreach ($galleries as $gallery)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="gallery-item">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" class="img-fluid gallery-img"
                            alt="{{ $gallery->title }}" data-bs-toggle="modal" data-bs-target="#galleryModal"
                            data-image="{{ asset('storage/' . $gallery->image_path) }}"
                            data-title="{{ $gallery->title }}">
                        <div class="gallery-info">
                            <h5>{{ $gallery->title }}</h5>
                            <p>{{ $gallery->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section><!-- End Gallery Section -->

<!-- ======= Modal ======= -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Detail Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImagegaleri" src="" class="img-fluid" alt="" width="100%"
                    height="100vh">
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

@include('layouts.footer')



@endsection
@section('js')
<script>
    // Script untuk menangani modal
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.gallery-img').forEach(item => {
            item.addEventListener('click', event => {
                const imageSrc = event.currentTarget.getAttribute('data-image');
                const imageTitle = event.currentTarget.getAttribute('data-title');

                document.getElementById('modalImagegaleri').src = imageSrc;
                document.getElementById('galleryModalLabel').textContent = imageTitle;
            });
        });
    });
</script>
@endsection
