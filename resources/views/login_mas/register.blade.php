@extends('layouts.login', ['title' => 'Pengguna Register'])
@section('body')
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                    alt="illustration" class="illustration" />
                <h1 class="opacity">REGISTER</h1>
                <form method="POST" action="{{ route('prosesregister') }}">
                    @csrf
                    <input type="text" placeholder="NAMA ASLI" name="nama"  value="{{ old('nama') }}"/>
                    @error('nama')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="number" placeholder="NIK" name="nik"  value="{{ old('nik') }}"/>
                    @error('nik')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="number" placeholder="Nomor HP/WA" name="no_hp"  value="{{ old('no_hp') }}"/>
                    @error('no_hp')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="email" placeholder="EMAIL" name="email"  value="{{ old('email') }}"/>
                    @error('email')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="password" placeholder="PASSWORD" name="password"/>
                    @error('password')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="password" placeholder="KONFIRMASI PASSWORD" name="password_confirmation"/>
                    @error('password_confirmation')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <button class="opacity">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a href="{{ route('login') }}">LOGIN</a>
                    <a href="/">BACK</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
@endsection
