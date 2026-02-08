@extends('admin.layouts.main', ['title' => 'Video Management'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Video Management</h2>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <button type="button" class="btn mb-2 btn-primary" data-toggle="modal"
                                        data-target="#AddVideo">
                                        <i class="fe fe-file-plus fe-16"></i>
                                        Tambah Video
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="AddVideo" tabindex="-1" role="dialog"
                                        aria-labelledby="AddVideoLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="AddVideoLabel">Tambah Video</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('videos.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="videoTitle">Judul Video</label>
                                                            <input type="text" id="videoTitle"
                                                                class="form-control @error('title') is-invalid @enderror"
                                                                value="{{ old('title') }}" placeholder="Judul Video"
                                                                name="title" required>
                                                            @error('title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="videoDescription">Deskripsi Video</label>
                                                            <textarea id="videoDescription" class="form-control @error('description') is-invalid @enderror" name="description"
                                                                placeholder="Deskripsi Video" required>{{ old('description') }}</textarea>
                                                            @error('description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="videoPath">Upload Video</label>
                                                            <input type="file" id="videoPath"
                                                                class="form-control @error('video_path') is-invalid @enderror"
                                                                name="video_path" accept="video/*" required>
                                                            @error('video_path')
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
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($videos as $video)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $video->title }}</td>
                                                <td>{{ $video->description }}</td>
                                                <td>
                                                    <form class="d-flex" method="POST"
                                                        action="{{ route('videos.destroy', $video->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Anda yakin ingin menghapus video {{ $video->title }} ini secara permanen?'); event.preventDefault();">
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
