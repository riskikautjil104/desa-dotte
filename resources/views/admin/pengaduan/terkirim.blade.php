@extends('admin.layouts.main', ['title' => 'Pengaduan Terkirirm'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Pengaduan Terkirim</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Email</strong></th>
                                            <th><strong>Jenis Pengaduan</strong></th>
                                            <th><strong>Lampiran</strong></th>
                                            <th><strong>Aprove</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengaduan as $pengaduan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengaduan->nama }} </td>
                                                <td>{{ $pengaduan->email }}</td>
                                                <td>{{ $pengaduan->jenis_pengaduan }}</td>
                                                <td><a download="lampiran_pengaduan_{{ $pengaduan->nama }}"
                                                        class="btn btn-success"
                                                        href="{{ url('storage/' . $pengaduan->lampiran) }}"><i
                                                            class="fe fe-download"></i> Download</a></td>
                                                <td>
                                                    @if ($pengaduan->aprove == 1)
                                                        <span class="badge badge-pill badge-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Belum
                                                            Terverifikasi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ route('pengaduan.edit', $pengaduan->id) }}"
                                                            class="btn btn-primary dropdown-item"><i class="fe fe-eye"></i>
                                                            Detail</a>
                                                        @can('isAdmin')
                                                            <form class="d-flex" method="POST"
                                                                action="{{ route('pengaduan.delete', $pengaduan->id) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-danger dropdown-item"
                                                                    onclick="return confirm('anda yakin ingin menghapus berita ini secara permanen?');event.preventDefault();
                                                            "><i
                                                                        class="fe fe-trash-2"></i> Hapus</button>
                                                            </form>
                                                        @endcan
                                                    </div>
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
