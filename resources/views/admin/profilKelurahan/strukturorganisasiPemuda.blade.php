{{--  --}}
@extends('admin.layouts.main', ['title' => 'Struktur Organisasi Pemuda'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <h2 class="mb-2 page-title"><i class="fe fe-file-plus"></i> Struktur Organisasi Pemuda</h2>
    <div class="card shadow mb-4">

        @if ($struktur_organisasi->count())
            @foreach ($struktur_organisasi as $so)
                <form action="{{ route('strukturorganisasiPemuda.update', $so->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">Struktur Organisasi Pemuda</h5>
                            <div class="form-group mb-3">
                                <label for="example-fileinput">Bagan:</label>
                                <input type="file" id="fileinput"
                                    class="form-control-file @error('gambar') is-invalid @enderror" name="gambar">
                                <input type="hidden" name="gambarlama" value="{{ $so->gambar }}">
                                @error('gambar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
                <div>
                    <img id="image" src="{{ asset('storage/' . $so->gambar) }}" alt="" height="50%"
                        width="100%" style="border-radius: 3%">

                </div>
            @endforeach
        @else
            <form action="{{ route('organisasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <label for="example-fileinput">Bagan:</label>
                        <input type="file" id="fileinput" class="form-control-file @error('gambar') is-invalid @enderror"
                            name="gambar">
                        @error('gambar')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </form>
            <div>
                <img id="image" src="{{ asset('assets/img/choose-image.png') }}" alt="" height="50%"
                    width="100%" style="border-radius: 3%">

            </div>
        @endif
    </div> <!-- / .card -->
@endsection
@section('scrip')
    <script>
        let img = document.querySelector('#image')
        let input = document.querySelector('#fileinput')

        // choose image
        input.onchange = (e) => {
            if (input.files[0]) {

                img.src = URL.createObjectURL(input.files[0]);
            }
        }
    </script>
@endsection
