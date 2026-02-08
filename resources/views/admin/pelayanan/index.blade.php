@extends('admin.layouts.main', ['title' => 'Pelayanan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Pelayanan</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>No Hp</strong></th>
                                            <th><strong>Foto Copy KK</strong></th>
                                            <th><strong>Foto Copy KTP</strong></th>
                                            <th><strong>Surat Pernyataan</strong></th>
                                            <th><strong>Surat Pengantar dari Ketua RT/RW setempat</strong></th>
                                            <th><strong>Jenis Pelayanan</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelayanan as $pel)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pel->masyarakat->nama }}</td>
                                                <td>{{ $pel->masyarakat->no_hp }}</td>
                                                <td>
                                                    <a download="" class="btn btn-success"
                                                        href="{{ url('storage/' . $pel->fc_kk) }}"><i
                                                            class="fe fe-download"></i> Download</a>
                                                </td>
                                                <td>
                                                    <a download="" class="btn btn-success"
                                                        href="{{ url('storage/' . $pel->fc_ktp) }}"><i
                                                            class="fe fe-download"></i> Download</a>
                                                </td>
                                                <td>
                                                    @if ($pel->surat_pernyataan)
                                                        <a download="" class="btn btn-success"
                                                            href="{{ url('storage/' . $pel->surat_pernyataan) }}"><i
                                                                class="fe fe-download"></i> Download</a>
                                                    @else

                                                    @endif
                                                </td>
                                                <td>
                                                    <a download="" class="btn btn-success"
                                                            href="{{ url('storage/' . $pel->pentantar_rt_rw) }}"><i
                                                                class="fe fe-download"></i> Download</a>
                                                </td>
                                                <td>{{ $pel->jenisPelayanan->nama_pelayanan }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ route('pelayanan.show', $pel->id) }}"
                                                            class="btn btn-primary dropdown-item"><i class="fe fe-eye"></i>
                                                            Detail</a>
                                                        <form class="d-flex" method="POST"
                                                            action="{{ route('pelayanan.delete', $pel->id) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger dropdown-item"
                                                                onclick="return confirm('anda yakin ingin menghapus data ini secara permanen?');event.preventDefault();
                                                            "><i
                                                                    class="fe fe-trash-2"></i> Hapus</button>
                                                        </form>
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
