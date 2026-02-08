@extends('admin.layouts.main',['title' => 'Edit Berita'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <h2 class="mb-2 page-title"><i class="fe fe-file-plus"></i> Edit Berita</h2>
    <div class="card shadow mb-4">

        <form action="{{ route('berita.update',$berita->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-header">
                <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                <a href="{{ route('berita.index') }}" class="btn btn-secondary"><i class="fe fe-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="simpleinput">Judul</label>
                            <input type="text" id="simpleinput"
                                class="form-control  @error('judul') is-invalid @enderror" name="judul"
                                value="{{ old('judul',$berita->judul) }}">
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> <!-- /.col -->
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="example-fileinput">Max size 2mb. format : png, jpg, jpeg</label>
                            <input type="file" id="fileinput"
                                class="form-control-file  @error('gambar') is-invalid @enderror" name="gambar">
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> <!-- /.col -->
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <img id="image" src="{{ asset('storage/'.$berita->gambar) }}" alt=""
                                        height="70rem" width="100rem" style="border-radius: 3%">
                            <input type="hidden" name="gambarlama" value="{{ $berita->gambar }}">
                        </div>
                    </div> <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">Isi</h5>
                            <input id="isi" class="form-control @error('isi') is-invalid @enderror" type="hidden"
                                name="isi" value="{{ old('isi',$berita->isi) }}">
                            @error('isi')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            <trix-editor input="isi"></trix-editor>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
