@extends('layouts.login', ['title' => 'Pengguna Login'])
@section('body')
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                    alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form method="POST" action="{{ route('proseslogin') }}">
                    @csrf
                    <input type="email" placeholder="EMAIL" name="email" value="{{ old('email') }}" />
                    @error('email')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <input type="password" placeholder="PASSWORD" name="password" />
                    @error('password')
                        <span class="pesan-error">{{ $message }}</span>
                    @enderror
                    <button class="opacity">MASUK</button>
                </form>
                <div class="d-flex justify-content-center">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-center"
                            href="{{ route('password.request') }}">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>
                <div class="register-forget opacity">
                    <a href="{{ route('mas_register') }}">REGISTER</a>
                    <a href="/">BACK</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
@endsection
