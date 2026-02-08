@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Penduduk Pindah</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <h5 class="card-title">Total Data: {{ $pendudukPindah->total() }}</h5>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>NIK</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Tanggal Pindah</strong></th>
                                            <th><strong>Alamat Asal</strong></th>
                                            <th><strong>Tujuan Pindah</strong></th>
                                            <th><strong>Alasan Pindah</strong></th>
                                            <th><strong>Jenis Pindah</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendudukPindah as $pindah)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pindah->nik }}</td>
                                                <td>{{ $pindah->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pindah->tanggal_pindah)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $pindah->alamat_asal ?? '-' }}</td>
                                                <td>{{ $pindah->tujuan_pindah ?? '-' }}</td>
                                                <td>{{ $pindah->alasan_pindah ?? '-' }}</td>
                                                <td>{{ $pindah->jenis_pindah ?? '-' }}</td>
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
=======
@extends('admin.layouts.main', ['title' => 'Data Penduduk Pindah'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Penduduk Pindah</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <h5 class="card-title">Total Data: {{ $pendudukPindah->total() }}</h5>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>NIK</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Tanggal Pindah</strong></th>
                                            <th><strong>Alamat Asal</strong></th>
                                            <th><strong>Tujuan Pindah</strong></th>
                                            <th><strong>Alasan Pindah</strong></th>
                                            <th><strong>Jenis Pindah</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendudukPindah as $pindah)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pindah->nik }}</td>
                                                <td>{{ $pindah->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pindah->tanggal_pindah)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $pindah->alamat_asal ?? '-' }}</td>
                                                <td>{{ $pindah->tujuan_pindah ?? '-' }}</td>
                                                <td>{{ $pindah->alasan_pindah ?? '-' }}</td>
                                                <td>{{ $pindah->jenis_pindah ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center">
                                    {{ $pendudukPindah->links() }}
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
