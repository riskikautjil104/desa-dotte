@extends('admin.layouts.main', ['title' => 'Data Penduduk Meninggal'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Penduduk Meninggal</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <h5 class="card-title">Total Data: {{ $pendudukKematian->total() }}</h5>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>NIK</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Tanggal Kematian</strong></th>
                                            <th><strong>Sebab Kematian</strong></th>
                                            <th><strong>Tempat Kematian</strong></th>
                                            <th><strong>Yang Melaporkan</strong></th>
                                            <th><strong>Hubungan</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendudukKematian as $kematian)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $kematian->nik }}</td>
                                                <td>{{ $kematian->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($kematian->tanggal_kematian)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $kematian->sebab_kematian ?? '-' }}</td>
                                                <td>{{ $kematian->tempat_kematian ?? '-' }}</td>
                                                <td>{{ $kematian->yang_melaporkan ?? '-' }}</td>
                                                <td>{{ $kematian->hub_dengan_almarhum ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center">
                                    {{ $pendudukKematian->links() }}
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
