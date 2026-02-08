@extends('layouts.main',['title' => 'Profil Pengguna'])

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
                <li>Profil Pengguna</li>

            </ol>
        </div>

    </div>
</section><!-- End breadcrumbs Section -->

<!-- ======= LPM Section ======= -->
<section id="struktur_organisasi" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ asset('assets/img/profile.png') }}" alt=""
                        class="img-fluid rounded-circle mb-4" width="200px">
                </div>
                <div class="col-lg-6 text-start">
                    <form>
                        <fieldset disabled>
                          <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Nama</label>
                            <input type="text" id="disabledTextInput" class="form-control" value="{{ Auth::guard('masyarakat')->user()->nama }}">
                          </div>
                          <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Email</label>
                            <input type="text" id="disabledTextInput" class="form-control" value="{{ Auth::guard('masyarakat')->user()->email }}">
                          </div>
                          <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Nomor Hp/Wa</label>
                            <input type="text" id="disabledTextInput" class="form-control" value="{{ Auth::guard('masyarakat')->user()->no_hp }}">
                          </div>
                        </fieldset>
                      </form>
                </div>
            </div>
        </div>
</section><!-- End LPM Section -->

@include('layouts.footer')
@endsection
