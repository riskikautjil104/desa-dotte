@extends('admin.layouts.main', ['title' => 'Galeri Management'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Galeri Management</h2>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <button type="button" class="btn mb-2 btn-primary" data-toggle="modal"
                                        data-target="#AddGallery">
                                        <i class="fe fe-file-plus fe-16"></i>
                                        Tambah Galeri
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="AddGallery" tabindex="-1" role="dialog"
                                        aria-labelledby="AddGalleryLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="AddGalleryLabel">Tambah Galeri</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('galeris.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="galleryTitle">Judul Galeri</label>
                                                            <input type="text" id="galleryTitle"
                                                                class="form-control @error('title') is-invalid @enderror"
                                                                value="{{ old('title') }}" placeholder="Judul Galeri"
                                                                name="title" required>
                                                            @error('title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="galleryDescription">Deskripsi Galeri</label>
                                                            <textarea id="galleryDescription" class="form-control @error('description') is-invalid @enderror" name="description"
                                                                placeholder="Deskripsi Galeri" required>{{ old('description') }}</textarea>
                                                            @error('description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="galleryImage">Upload Gambar</label>
                                                            <input type="file" id="galleryImage"
                                                                class="form-control @error('image_path') is-invalid @enderror"
                                                                name="image_path" accept="image/*" required>
                                                            @error('image_path')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn mb-2 btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Judul</strong></th>
                                            <th><strong>Deskripsi</strong></th>
                                            <th><strong>Gambar</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $gallery)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $gallery->title }}</td>
                                                <td>{{ $gallery->description }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                                        alt="{{ $gallery->title }}" width="100">
                                                </td>
                                                <td>
                                                    <form class="d-flex" method="POST"
                                                        action="{{ route('galeris.destroy', $gallery->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Anda yakin ingin menghapus galeri {{ $gallery->title }} ini secara permanen?'); event.preventDefault();">
                                                            <i class="fe fe-trash-2"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
