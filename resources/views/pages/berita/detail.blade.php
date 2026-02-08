@extends('layouts.main',['title' => $berita->judul])

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
          <li><a href="{{ route('berita') }}">Berita</a></li>
          <li>{{ $berita->slug }}</li>
        </ol>
      </div>

    </div>
  </section><!-- End breadcrumbs Section -->

<!-- ======= posts Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">

            {{-- berita --}}
            <div class="col-lg-7 entries">
                <div class="row">
                        <div class="col-sm-12">
                            <article class="entry">

                                <div class="entry-img" style="max-height: 500px">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" width="100%" alt=""
                                        class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a href="{{ route('detail.berita', $berita->slug) }}">{{ $berita->judul }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a
                                                href="{{ route('detail.berita', $berita->slug) }}">{{ $berita->views }}</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="{{ route('detail.berita', $berita->slug) }}"><time
                                                    datetime="2020-01-01">{{ $berita->created_at->format('M d, Y') }}</time></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p class="text-center">
                                        {!! $berita->isi !!}
                                    </p>
                                </div>

                            </article><!-- End blog entry -->
                        </div>
                </div>
            </div><!-- End blog entries list -->

            {{-- side berita --}}
            <div class="col-lg-5">

                <div class="sidebar sticky-top">
                    {{-- sambutan Lurah --}}
                    <h3 class="sidebar-title">Sambutan Lurah</h3>
                    <div class="sidebar-item recent-posts">
                        @foreach ($sambutan_lurah as $sambutan)
                        <div class="post-item clearfix">
                            <img src="{{ asset('storage/' . $sambutan->gambar_lurah) }}" alt="gambar lurah">
                            <h4><a href="{{ route('sambutanlurah', $sambutan->slug) }}">{{ $sambutan->nama_lurah }}</a></h4>
                            <time datetime="2020-01-01">{{ $sambutan->updated_at->format('M d, Y') }}</time>
                        </div>
                        @endforeach
                    </div><!-- End sidebar recent posts-->
                    {{-- end sambutan Lurah --}}
                    <h3 class="sidebar-title">Recent Posts</h3>
                    <div class="sidebar-item recent-posts">
                        @foreach ($recentberita as $b)
                            <div class="post-item clearfix">
                                <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}">
                                <h4><a href="{{ route('detail.berita', $b->slug) }}">{{ $b->judul }}</a></h4>
                                <time datetime="2020-01-01">{{ $b->created_at->format('M d, Y') }}</time>
                            </div>
                        @endforeach

                    </div><!-- End sidebar recent posts-->
                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section><!-- End posts Section -->

@include('layouts.footer')
@endsection
