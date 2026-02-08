@extends('admin.layouts.main')
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <h3 class="page-title">Selamat Datang {{ auth()->user()->name }}</h3>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{ $rt }}</span>
                            <p class="small text-muted mb-0">RT</p>
                        </div>
                        <div class="col-auto">
                            <span class="fe fe-32 fe-map-pin text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{ $rw }}</span>
                            <p class="small text-muted mb-0">RW</p>
                        </div>
                        <div class="col-auto">
                            <span class="fe fe-32 fe-map-pin text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{ $datapenduduk }}</span>
                            <p class="small text-muted mb-0">Penduduk</p>
                        </div>
                        <div class="col-auto">
                            <span class="fe fe-32 fe-users text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{ $berita }}</span>
                            <p class="small text-muted mb-0">Postingan Berita</p>
                        </div>
                        <div class="col-auto">
                            <span class="fe fe-32 fe-grid text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{ $pengaduan }}</span>
                            <p class="small text-muted mb-0">Pengaduan</p>
                        </div>
                        <div class="col-auto">
                            <span class="fe fe-32 fe-file-text text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
