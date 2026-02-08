{{--  --}}
@extends('admin.layouts.main', ['title' => 'Detail Pengaduan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Pengaduan {{ $pengaduan->jenis_pengaduan }}</h2>
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('assets/img/profile.png') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h4 class="mb-1">{{ $pengaduan->nama }}</h4>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-7">
                                <p class="small mb-1 bg-secondary btn text-light">Nik : {{ $pengaduan->nik }}</p>
                                <p class="small mb-1 bg-secondary btn text-light">Email : {{ $pengaduan->email }}</p>
                                <p class="small mb-1 bg-secondary btn text-light">Jenis Pengaduan :
                                    {{ $pengaduan->jenis_pengaduan }}</p>
                            </div>
                            <div class="col-md-5">
                                <a download="lampiran_pengaduan_{{ $pengaduan->nama }}"
                                    class="btn btn-success"
                                    href="{{ url('storage/' . $pengaduan->lampiran) }}"><i
                                        class="fe fe-download"></i> Download Lampiran</a>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="container">
                            <h3>Deskripsi</h3>
                            <p>{{ $pengaduan->deskripsi }}</p>
                        </div> <!-- .card -->
                    </div> <!-- .col-md-->
                </div> <!-- .row-->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
