@extends('layouts.main', ['title' => 'Pelayanan'])

@section('body')
@section('outmain')
    @include('layouts.header')
    {{-- @include('layouts.hero') --}}
    @include('layouts.page-hero', [
        'title' => 'Pelayanan',
        'subtitle' => 'Temukan layanan terbaru tentang Desa Dotte',
        'breadcrumb' => 'Pelayanan',
        'showBreadcrumb' => true
    ])
@endsection
<!-- ======= breadcrumbs Section ======= -->
{{-- <section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Pelayanan</li>
            </ol>
        </div>

    </div>
</section><!-- End breadcrumbs Section --> --}}

<section id="Pengaduan" class="blog">

    <div class="container" data-aos="fade-up">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <small>Jika Berkas Sudah Siap Kami Akan Menghubungi Anda Melalui Email Atau WA</small> <br>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h3>Alur Pelayanan</h3>
                    <ol>
                        <li>
                            Scan PDF Pengantar RT,
                            Scan PDF Fotocopy KTP & KK pemohon,
                            Scan PDF Surat Pernyataan tanda tangan bermaterai,
                        </li>
                        <li> Jika Surat Keterangan telah selesai dibuat, maka akan dihubungi oleh petugas.

                    </ol>
                    <small class="text-muted">Maksimal Ukuran File 2mb. format dokument : pdf, docs</small>
                </div>
                <form action="{{ route('pelayanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @auth('masyarakat')
                        <input type="hidden" value="  {{ Auth::guard('masyarakat')->user()->id }}" name="masyarakat_id">
                    @endauth
                    <div class="mb-3">
                        <label for="fc_kk" class="form-label">Foto Copy Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                        <input id="fc_kk" class="form-control @error('fc_kk') is-invalid @enderror" type="file"
                            id="formFileMultiple" name="fc_kk">

                        @error('fc_kk')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-danger">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fc_ktp" class="form-label">Foto Copy Kartu Tanda Penduduk (KTP) <span class="text-danger">*</span></label>
                        <input id="fc_ktp" class="form-control @error('fc_ktp') is-invalid @enderror" type="file"
                            id="formFileMultiple" name="fc_ktp">

                        @error('fc_ktp')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-danger">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="surat_pernyataan" class="form-label">Surat Pernyataan </label>
                        <input id="surat_pernyataan" class="form-control @error('surat_pernyataan') is-invalid @enderror" type="file"
                            id="formFileMultiple" name="surat_pernyataan">
                        @error('surat_pernyataan')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-danger">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pelayanan_id" class="form-label">Jenis Pelayanan <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_pelayanan_id') is-invalid @enderror"
                            aria-label="Default select example" name="jenis_pelayanan_id">
                            @foreach ($jenis_pelayanan as $pelayanan)
                                <option selected value="{{ $pelayanan->id }}">{{ $pelayanan->nama_pelayanan }}</option>
                            @endforeach
                        </select>
                        @error('jenis_pelayanan_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pengantar_rt_rw" class="form-label">Surat Pengantar dari Ketua RT/RW
                            setempat <span class="text-danger">*</span></label>
                        <input id="pengantar_rt_rw" class="form-control @error('pengantar_rt_rw') is-invalid @enderror"
                            type="file" id="formFileMultiple" name="pengantar_rt_rw">

                        @error('pengantar_rt_rw')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-danger">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="capctha w-100">
                        </div>
                    </div>
                    <div class="col-auto ">
                        <button type="submit" class="btn index-bg mb-3">Kirim</button>

                    </div>
                </form>

            </div>
        </div>
</section>

@include('layouts.footer')
@endsection
