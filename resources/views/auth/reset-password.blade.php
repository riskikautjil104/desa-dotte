
@extends('admin.layouts.main')
@section('body')
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
                <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST"
                    action="{{ route('password.store') }}">
                    @csrf
                    
                    <!-- Password Reset Token -->
                     <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror form-control-lg"
                            placeholder="Email address" required="" autofocus="" autocomplete="current-password"
                            value="{{ old('email',$request->email) }}" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-danger">Masukan Email Yang Valid</small>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">Password</label>
                        <input type="email" id="password" class="form-control form-control-lg"
                            placeholder="Password" required="" autofocus="" autocomplete="current-password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="sr-only">Confirm Password</label>
                        <input type="email" id="password" class="form-control form-control-lg"
                            placeholder="Confirm Password" required="" autofocus="" autocomplete="current-password" name="password_confirmation">
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
                    <p class="mt-5 mb-3 text-muted">© Copyright Kampung Makassar Barat 2020. All Rights Reserved</p>
                </form>
        </div>
    </div>
@endsection

