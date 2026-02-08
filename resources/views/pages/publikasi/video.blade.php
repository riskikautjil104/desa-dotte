@extends('layouts.main', ['title' => 'Video'])

@section('body')

@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Video Desa',
        'subtitle' => 'Temukan video terbaru tentang Desa Dotte',
        'breadcrumb' => 'Video',
        'showBreadcrumb' => true
    ])
@endsection

<!-- ======= breadcrumbs Section ======= -->
{{-- <section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Video</li>
            </ol>
        </div>
    </div>
</section><!-- End breadcrumbs Section --> --}}

<!-- ======= Video Section ======= -->
<section id="video" class="video">
    <div class="container" data-aos="fade-up">
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <video class="img-fluid video-img" controls
                            poster="{{ asset('storage/' . $video->image_path) }}" data-bs-toggle="modal"
                            data-bs-target="#videoModal" data-video="{{ asset('storage/' . $video->video_path) }}"
                            data-title="{{ $video->title }}">
                            <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="video-info">
                            <h5>{{ $video->title }}</h5>
                            <p>{{ $video->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section><!-- End Video Section -->

<!-- ======= Modal ======= -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Detail Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video id="modalVideovideo" class="img-fluid" controls style="display: none;" width="100%"></video>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

@include('layouts.footer')

@endsection
