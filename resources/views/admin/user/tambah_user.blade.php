@extends('admin.layouts.main', ['title' => 'Detail Pelayanan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Tambah User</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="text" placeholder="NAMA ASLI" name="nama" value="{{ old('nama') }}" />
                    @error('nama')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="number" placeholder="NIK" name="nik" value="{{ old('nik') }}" />
                    @error('nik')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="number" placeholder="Nomor HP/WA" name="no_hp" value="{{ old('no_hp') }}" />
                    @error('no_hp')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="email" placeholder="EMAIL" name="email" value="{{ old('email') }}" />
                    @error('email')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="password" placeholder="PASSWORD" name="password" />
                    @error('password')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="password" placeholder="KONFIRMASI PASSWORD" name="password_confirmation" />
                    @error('password_confirmation')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <button class="opacity">SUBMIT</button>
                </form>
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
