@extends('admin.layouts.main', ['title' => 'Detail Pelayanan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="h3 mb-4 page-title">Pelayanan {{ $pelayanan->jenisPelayanan->nama_pelayanan }}</h2>
        <div class="row mt-5 align-items-center">
          <div class="col-md-3 text-center mb-5">
            <div class="avatar avatar-xl">
              <img src="{{ asset('assets/img/profile.png') }}" alt="..." class="avatar-img rounded-circle">
            </div>
          </div>
          <div class="col">
            <div class="row align-items-center">
              <div class="col-md-7">
                <h4 class="mb-1">{{ $pelayanan->masyarakat->nama }}</h4>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-7">
                  <p class="small mb-1 bg-secondary btn text-light">Nik : {{ $pelayanan->masyarakat->nik }}</p>
                <p class="small mb-1 bg-secondary btn text-light">Email : {{ $pelayanan->masyarakat->email }}</p>
                <p class="small mb-1 bg-secondary btn text-light">No Hp : {{ $pelayanan->masyarakat->no_hp }}</p>
              </div>
              <div class="col-md-5">
                <a class="text-light btn btn-primary m-1" href="mailto:{{ $pelayanan->masyarakat->email }}"><i class="fe fe-mail fe-16"></i> Kirim Email</a>
                <a class="text-light btn btn-success m-1" target="_blank" href="https://wa.me/+62{{ $pelayanan->masyarakat->no_hp }}"><i class="fe fe-phone fe-16"></i> Kirim WA</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row my-4">
          <div class="col-md-3">
            <div class="card mb-4 shadow">
              <div class="card-body my-n3">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-lg bg-light">
                      <i class="fe fe-file-text fe-24 text-primary"></i>
                    </span>
                  </div> <!-- .col -->
                  <div class="col">
                      <h3 class="h5 mt-4 mb-1">Foto Copy Kartu Keluarga</h3>
                  </div> <!-- .col -->
                </div> <!-- .row -->
              </div> <!-- .card-body -->
              <div class="card-footer">
                <a download="foto_copy_kartu_keluarga_{{ $pelayanan->masyarakat->nama }}" href="{{ url('storage/' . $pelayanan->fc_kk) }}" class="d-flex justify-content-between text-muted"><span>Download File</span><i class="fe fe-download"></i></a>
              </div> <!-- .card-footer -->
            </div> <!-- .card -->
          </div> <!-- .col-md-->
          <div class="col-md-3">
            <div class="card mb-4 shadow">
              <div class="card-body my-n3">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-lg bg-light">
                      <i class="fe fe-file-text fe-24 text-primary"></i>
                    </span>
                  </div> <!-- .col -->
                  <div class="col">
                      <h3 class="h5 mt-4 mb-1">Foto Copy Kartu Tanda Penduduk</h3>
                  </div> <!-- .col -->
                </div> <!-- .row -->
              </div> <!-- .card-body -->
              <div class="card-footer">
                <a download="Foto-Copy-Kartu-Tanda-Penduduk_{{ $pelayanan->masyarakat->nama }}" href="{{ url('storage/' . $pelayanan->fc_ktp) }}" class="d-flex justify-content-between text-muted"><span>Download File</span><i class="fe fe-download"></i></a>
              </div> <!-- .card-footer -->
            </div> <!-- .card -->
          </div> <!-- .col-md-->
          <div class="col-md-3">
            <div class="card mb-4 shadow">
              <div class="card-body my-n3">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-lg bg-light">
                      <i class="fe fe-file-text fe-24 text-primary"></i>
                    </span>
                  </div> <!-- .col -->
                  <div class="col">
                      <h3 class="h5 mt-4 mb-1">Surat Pengantar Rt/Rw</h3>
                  </div> <!-- .col -->
                </div> <!-- .row -->
              </div> <!-- .card-body -->
              <div class="card-footer">
                <a download="Foto-Copy-Kartu-Tanda-Penduduk_{{ $pelayanan->masyarakat->nama }}" href="{{ url('storage/' . $pelayanan->pengantar_rt_rw) }}" class="d-flex justify-content-between text-muted"><span>Download File</span><i class="fe fe-download"></i></a>
              </div> <!-- .card-footer -->
            </div> <!-- .card -->
          </div> <!-- .col-md-->
          <div class="col-md-3">
            <div class="card mb-4 shadow">
              <div class="card-body my-n3">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-lg bg-light">
                      <i class="fe fe-file-text fe-24 text-primary"></i>
                    </span>
                  </div> <!-- .col -->
                  <div class="col">
                      <h3 class="h5 mt-4 mb-1">Surat Pernyataan</h3>
                  </div> <!-- .col -->
                </div> <!-- .row -->
              </div> <!-- .card-body -->
              <div class="card-footer">
                @if ($pelayanan->surat_pernyataan)
                <a download="Foto-Copy-Kartu-Tanda-Penduduk_{{ $pelayanan->masyarakat->nama }}" href="{{ url('storage/' . $pelayanan->surat_pernyataan) }}" class="d-flex justify-content-between text-muted"><span>Download File</span><i class="fe fe-download"></i></a>
                @else
                <p class="small mb-0">Surat Tidak Ada</p>
                @endif
              </div> <!-- .card-footer -->
            </div> <!-- .card -->
          </div> <!-- .col-md-->
        </div> <!-- .row-->
      </div> <!-- /.col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->
@endsection
