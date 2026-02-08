@extends('admin.layouts.main',['title' => 'Visi & Misi Kelurahan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <h2 class="mb-2 page-title"><i class="fe fe-file-plus"></i> Visi & Misi</h2>
    <div class="card shadow mb-4">

        @if ($visimisi->count())
            @foreach ($visimisi as $vm)
            <form action="{{ route('visimisi.update', $vm->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-header">
                    <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">Isi Visi & Misi</h5>
                        <input id="isi" class="form-control @error('isi') is-invalid @enderror" type="hidden"
                            name="isi" value="{{ old('isi', $vm->isi) }}">
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
            <form action="{{ route('visimisi.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">Isi Visi & Misi</h5>
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
