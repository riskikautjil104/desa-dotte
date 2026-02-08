{{--  --}}
@extends('admin.layouts.main', ['title' => 'Informasi Profil'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
    
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
