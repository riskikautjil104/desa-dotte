@extends('admin.layouts.main', ['title' => 'Sambutan Kepala Desa'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <h2 class="mb-2 page-title"><i class="fe fe-file-plus"></i> Edit sambutan</h2>
    <div class="card shadow mb-4">

        @if ($sambutan->count())
            @foreach ($sambutan as $sambutan)
                <form action="{{ route('lurah.update', $sambutan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Nama Kepala Desa</label>
                                    <input type="text" id="simpleinput"
                                        class="form-control  @error('nama_lurah') is-invalid @enderror" name="nama_lurah"
                                        value="{{ old('nama_lurah', $sambutan->nama_lurah) }}">
                                    @error('nama_lurah')
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
                                        class="form-control-file  @error('gambar_lurah') is-invalid @enderror"
                                        name="gambar_lurah">
                                    @error('gambar_lurah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <img id="image" src="{{ asset('storage/' . $sambutan->gambar_lurah) }}"
                                        alt="" height="70rem" width="100rem" style="border-radius: 3%">
                                    <input type="hidden" name="gambarlama" value="{{ $sambutan->gambar_lurah }}">
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title">Sambutan Kepala Desa</h5>
                                    <input id="sambutan_lurah"
                                        class="form-control @error('sambutan_lurah') is-invalid @enderror" type="hidden"
                                        name="sambutan_lurah"
                                        value="{{ old('sambutan_lurah', $sambutan->sambutan_lurah) }}">
                                    @error('sambutan_lurah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <trix-editor input="sambutan_lurah"></trix-editor>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        @else
            <form action="{{ route('lurah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Nama Kepala Desa</label>
                                <input type="text" id="simpleinput"
                                    class="form-control  @error('nama_lurah') is-invalid @enderror" name="nama_lurah"
                                    value="{{ old('nama_lurah') }}">
                                @error('nama_lurah')
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
                                    class="form-control-file  @error('gambar_lurah') is-invalid @enderror"
                                    name="gambar_lurah">
                                @error('gambar_lurah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <img id="image" src="{{ asset('assets/img/choose-image.png') }}" alt=""
                                    height="70rem" width="100rem" style="border-radius: 3%">
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">Sambutan Kepala Desa</h5>
                                <input id="sambutan_lurah"
                                    class="form-control @error('sambutan_lurah') is-invalid @enderror" type="hidden"
                                    name="sambutan_lurah" value="{{ old('sambutan_lurah') }}">
                                @error('sambutan_lurah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                                <trix-editor input="sambutan_lurah"></trix-editor>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
