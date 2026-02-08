@extends('admin.layouts.main',['title' => 'Pendidikan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                
                <h2 class="mb-2 page-title">Pendidikan</h2>
                <div class="row my-4">
                    <!-- pendidikan table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <button type="button" class="btn mb-2 btn-primary" data-toggle="modal"
                                        data-target="#pendidikan"> <i class="fe fe-file-plus fe-16"></i>
                                        Tambah Pendidikan </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="pendidikan" tabindex="-1" role="dialog"
                                        aria-labelledby="defaultModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="defaultModalLabel">Tambah Pendidikan </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('pendidikan.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="simple-select2">Nama Pendidikan</label>
                                                            <input type="text" id="simpleinput"
                                                                class="form-control  @error('nama_pendidikan') is-invalid @enderror"
                                                                value="{{ old('nama_pendidikan') }}"
                                                                placeholder="Nama pendidikan" name="nama_pendidikan" required>
                                                            @error('nama_pendidikan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div> <!-- Rt -->
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
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Nama Pendidikan</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendidikan as $pendidikan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pendidikan->nama_pendidikan }}</td>
                                                <td>
                                                    <form class="d-flex" method="POST" action="{{ route('pendidikan.delete', $pendidikan->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('anda yakin ingin menghapus {{ $pendidikan->nama_pendidikan }} ini secara permanen?');event.preventDefault();
                                                            "><i
                                                                class="fe fe-trash-2"></i> Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="col-lg-6 col-sm-12"></div>
                                <!-- table -->

                            </div>
                        </div>
                    </div> <!-- end pendidikan table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
