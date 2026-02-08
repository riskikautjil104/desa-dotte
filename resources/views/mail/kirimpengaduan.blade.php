@extends('admin.layouts.main')
@section('content')
<div class="card shadow">
  <div class="card-body p-5">
      <div class="row mb-5">
          <div class="col-12 text-center mb-4">
              <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img brand-md mx-auto mb-4" alt="...">
              <h4 class="text-center">Website Resmi Kelurahan Makssar Barat</h4>
      </div>
      <div class="col-md-7">
        <p class="small text-muted text-uppercase mb-2">Dari</p>
        <p class="mb-4">
          <strong>Admin Kelurahan</strong>
        </p>
        <p>
          <span class="small text-muted text-uppercase">Pengaduan</span><br />
          <strong>{{ $data->jenis_pengaduan }}</strong>
        </p>
      </div>
      <div class="col-md-5">
        <p class="small text-muted text-uppercase mb-2">Kepada</p>
        <p class="mb-4">
          <strong>{{ $data->nama }}</strong>
        </p>
        <p>
          <small class="small text-muted text-uppercase">Tanggal Di Buat</small><br />
          <strong>{{ $data->created_at->format('M, d, Y') }}</strong>
        </p>
      </div>
    </div> <!-- /.row -->
    <div class="row mb-5">
      <div class="col-12 mb-4">
        <p>Dengan Hormat.</p>
        <br>
        <p>Pengaduan Saudara yang kami terima {{ $data->created_at->format('M, d, Y') }}. perihan {{ $data->jenis_pengaduan }}. Telah kami terima dengan penuh perhatian.</p>
        <br>
        <p>Atas Perhatian Saudara, Kami sampaikan terima kasih</p>
      </div>
    </div> <!-- /.row -->
    
  </div> <!-- /.card-body -->
</div> <!-- /.card -->
@endsection

