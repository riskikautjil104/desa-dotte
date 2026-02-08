@extends('admin.layouts.main', ['title' => 'Peta Kelurahan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                                <th><strong>#</strong></th>
                                <th><strong>Gambar</strong></th>
                                <th><strong>Nama Lokasi</strong></th>
                                <th><strong>Dibuat Pada</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peta as $pet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('storage/' . $pet->gambar) }}" width="80" alt="">
                                    </td>
                                    <td>{{ $pet->nama_tempat }}</td>
                                    <td>{{ $pet->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <form class="d-flex" method="POST" action="{{ route('peta.delete', $pet->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"
                                                onclick="return confirm('anda yakin ingin menghapus {{ $pet->nama_tempat }} ini secara permanen?');event.preventDefault();
                                                                "><i
                                                    class="fe fe-trash-2"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('peta.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama">Nama Lokasi</label>
                            <input type="text" id="nama"
                                class="form-control  @error('nama_tempat') is-invalid @enderror" name="nama_tempat"
                                value="{{ old('nama_tempat') }}" placeholder="Nama Lokasi">
                            @error('nama_tempat')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="lat">Latitude</label>
                            <input type="text" id="lat" class="form-control  @error('lat') is-invalid @enderror"
                                name="lat" value="{{ old('lat') }}" placeholder="0.7964421975787448">
                            @error('lat')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="long">Longitude</label>
                            <input type="text" id="long" class="form-control  @error('long') is-invalid @enderror"
                                name="long" value="{{ old('long') }}" placeholder="127.37384728405367">
                            @error('long')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar">Gambar</label>
                            <input type="file" id="gambar"
                                class="form-control-file  @error('gambar') is-invalid @enderror" name="gambar">
                            <small for="example-fileinput">Max size 2mb. format : png, jpg, jpeg</small>
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="mb-5 mt-5" id="map" style=" height :650px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scrip')
    <script>
        var map = L.map('map').setView([2.0596416999452076, 128.42466012682303], 17);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        @foreach ($peta as $i)
            L.marker([{{ $i->lat }}, {{ $i->long }}]).addTo(map)
                .bindPopup(
                    " <img class='mt-1' width='200px' height='130px' src='{{ asset('storage/' . $i->gambar) }}' alt=''> <br> <h4 class='mt-3'>{{ $i->nama_tempat }}</h4>"
                )
        @endforeach
    </script>
@endsection
