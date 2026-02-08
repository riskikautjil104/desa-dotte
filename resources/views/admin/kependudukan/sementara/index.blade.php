@extends('admin.layouts.main', ['title' => 'Data Penduduk Sementara'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Penduduk Sementara</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Total Data: {{ $pendudukSementaras->total() }}</h5>
                                    </div>
                                    <a href="{{ route('penduduk-sementara.create') }}" class="btn btn-primary">
                                        <i class="fe fe-plus"></i> Tambah Data
                                    </a>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>NIK</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Jenis Kelamin</strong></th>
                                            <th><strong>Tujuan Tinggal</strong></th>
                                            <th><strong>Estimasi</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Aksi</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendudukSementaras as $sementara)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sementara->nik }}</td>
                                                <td>{{ $sementara->nama }}</td>
                                                <td>{{ $sementara->jenis_kelamin }}</td>
                                                <td>{{ $sementara->tujuan_tinggal }}</td>
                                                <td>{{ $sementara->estimasi_waktu }}</td>
                                                <td>
                                                    @if ($sementara->status)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-secondary">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('penduduk-sementara.show', $sementara) }}"
                                                            class="btn btn-sm btn-info" title="Lihat">
                                                            <i class="fe fe-eye"></i>
                                                        </a>
                                                        <a href="{{ route('penduduk-sementara.edit', $sementara) }}"
                                                            class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('penduduk-sementara.destroy', $sementara) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="Hapus">
                                                                <i class="fe fe-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center">
                                    {{ $pendudukSementaras->links() }}
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection