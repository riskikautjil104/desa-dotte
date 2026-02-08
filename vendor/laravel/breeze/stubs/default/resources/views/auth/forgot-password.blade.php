<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@extends('admin.layouts.main')
@section('body')
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
                <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST"
                    action="{{ route('password.email') }}">
                    @csrf
                    <p>lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimi Anda tautan setel ulang kata sandi melalui email yang memungkinkan Anda memilih yang baru</p>
                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror form-control-lg"
                            placeholder="Email address" required="" autofocus="" autocomplete="current-password"
                            value="{{ old('email') }}" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-danger">Masukan Email Yang Valid</small>
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Kirim</button>
                    <p class="mt-5 mb-3 text-muted">© Copyright Kampung Makassar Barat 2020. All Rights Reserved</p>
                </form>
        </div>
    </div>
@endsection
