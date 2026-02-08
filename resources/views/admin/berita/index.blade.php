@extends('admin.layouts.main',['title' => 'Semua Berita'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Semua Berita</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <a href="{{ route('berita.tambah') }}" class="btn" style="background-color: #0dcdbd; color: white;"><i class="fe fe-file-plus fe-16"></i> Tambah
                                        Berita</a>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Gambar</strong></th>
                                            <th><strong>Judul</strong></th>
                                            <th><strong>Dibuat Pada</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($beritas as $berita)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ Storage::url($berita->gambar) }}" width="80" alt="">
</td>
                                                <td>{{ $berita->judul }}</td>
                                                <td>{{ $berita->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ route('berita.edit', $berita->slug) }}"
                                                            class="btn dropdown-item" style="color: #0dcdbd;"><i class="fe fe-edit"></i>
                                                            Edit</a>
                                                        <form class="d-flex" method="POST"
                                                            action="{{ route('berita.delete', $berita->slug) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger dropdown-item" onclick="return confirm('anda yakin ingin menghapus berita ini secara permanen?');event.preventDefault();
                                                            "><i class="fe fe-trash-2"></i> Hapus</button>
                                                        </form>
                                                        {{-- <a class="dropdown-item" href="#">Edit</a>
                                                            <a class="btn btn-danger d-flex dropdown-item"
                                                                    href="{{ route('berita.delete', $berita->slug) }}"
                                                                    onclick="return confirm('anda yakin ingin menghapus berita?');event.preventDefault();
                                                        "><i
                                                                        class="fe fe-trash-2"></i> Hapus</a>
                                                    <a class="dropdown-item" href="#">Remove</a> --}}
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
