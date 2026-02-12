@extends('layouts.main', ['title' => $berita->judul])

@section('body')
    @section('outmain')
        @include('layouts.header')
    @endsection

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <ol class="mb-0">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('berita') }}">Berita</a></li>
                    <li class="d-none d-md-inline">{{ $berita->slug }}</li>
                    <li class="d-md-none text-truncate" style="max-width: 150px;">{{ $berita->slug }}</li>
                </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Posts Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row g-4">

                <!-- Berita Utama -->
                <div class="col-lg-7 col-12 entries">
                    <article class="entry">
                        <div class="entry-img" style="max-height: 500px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                 alt="{{ $berita->judul }}"
                                 class="img-fluid w-100"
                                 style="object-fit: cover;">
                        </div>

                        <h1 class="entry-title mt-3 mb-2 fs-3 fs-md-2">
                            {{ $berita->judul }}
                        </h1>

                        <div class="entry-meta mb-3">
                            <ul class="list-unstyled d-flex flex-wrap gap-3 mb-0">
                                <li class="d-flex align-items-center gap-1">
                                    <i class="bi bi-eye"></i>
                                    <span>{{ $berita->views }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1">
                                    <i class="bi bi-clock"></i>
                                    <time datetime="{{ $berita->created_at->toIso8601String() }}">
                                        {{ $berita->created_at->format('M d, Y') }}
                                    </time>
                                </li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <div class="text-content">
                                {!! $berita->isi !!}
                            </div>
                        </div>
                    </article>
                </div><!-- End berita utama -->

                <!-- Sidebar -->
                <div class="col-lg-5 col-12">
                    <div class="sidebar sticky-lg-top">
                        <!-- Sambutan Lurah -->
                        <div class="mb-4">
                            <h3 class="sidebar-title">Sambutan Lurah</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($sambutan_lurah as $sambutan)
                                    <div class="post-item d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ asset('storage/' . $sambutan->gambar_lurah) }}"
                                                 alt="gambar lurah"
                                                 class="rounded-circle"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">
                                                <a href="{{ route('sambutanlurah', $sambutan->slug) }}" 
                                                   class="text-decoration-none">
                                                    {{ $sambutan->nama_lurah }}
                                                </a>
                                            </h5>
                                            <small class="text-muted">
                                                {{ $sambutan->updated_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End sambutan lurah -->

                        <!-- Recent Posts -->
                        <div>
                            <h3 class="sidebar-title">Berita Terbaru</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recentberita as $b)
                                    <div class="post-item d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ asset('storage/' . $b->gambar) }}"
                                                 alt="{{ $b->judul }}"
                                                 class="rounded"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">
                                                <a href="{{ route('detail.berita', $b->slug) }}" 
                                                   class="text-decoration-none">
                                                    {{ \Illuminate\Support\Str::limit($b->judul, 50) }}
                                                </a>
                                            </h5>
                                            <small class="text-muted">
                                                {{ $b->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End recent posts -->
                    </div><!-- End sidebar -->
                </div><!-- End sidebar column -->

            </div><!-- End row -->
        </div><!-- End container -->
    </section><!-- End Posts Section -->

    @include('layouts.footer')
@endsection