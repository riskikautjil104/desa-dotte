@extends('admin.layouts.main',['title' => 'Gambaran Umum'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <h2 class="mb-2 page-title"><i class="fe fe-file-plus"></i> Gambaran Umum Kelurahan</h2>
    <div class="card shadow mb-4">

        @if ($gambaranumum->count())
            @foreach ($gambaranumum as $gu)
            <form action="{{ route('gambaranumum.update', $gu->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-header">
                    <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">Gambaran Umum Kelurahan</h5>
                        <input id="isi" class="form-control @error('isi') is-invalid @enderror" type="hidden"
                            name="isi" value="{{ old('isi', $gu->isi) }}">
                        @error('isi')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                        <trix-editor input="isi"></trix-editor>
                    </div>
                </div>
            </form>
            @endforeach
        @else
            <form action="{{ route('gambaranumum.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">Gambaran Umum Kelurahan</h5>
                        <input id="isi" class="form-control @error('isi') is-invalid @enderror" type="hidden"
                            name="isi" value="{{ old('isi') }}">
                        @error('isi')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                        <trix-editor input="isi"></trix-editor>
                    </div>
                </div>
            </form>
        @endif
    </div> <!-- / .card -->
@endsection
