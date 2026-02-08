@extends('admin.layouts.main', ['title' => 'Data Penduduk'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Penduduk</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    @can('isAdmin')
                                        <a href="{{ route('datapenduduk.tambah') }}" class="btn" style="background-color: #0dcdbd; color: white;"><i
                                                class="fe fe-file-plus fe-16"></i> Tambah
                                            Data Penduduk</a>
                                    @endcan
                                    <a href="{{ route('datapenduduk.export') }}" class="btn btn-success text-light"><i
                                            class="fe fe-download fe-16"></i> Download Data Penduduk</a>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Nik</strong></th>
                                            <th><strong>Alamat</strong></th>
                                            <th><strong>Usia</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_penduduk as $penduduk)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $penduduk->nama }}</td>
                                                <td>{{ $penduduk->nik }}</td>
                                                <td>{{ $penduduk->alamat }}</td>
                                                <td>{{ $penduduk->usia }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ route('datapenduduk.edit', $penduduk->nik) }}"
                                                            class="btn dropdown-item" style="color: #0dcdbd;"><i class="fe fe-edit"></i>
                                                            Edit</a>
                                                        <a href="#" class="dropdown-item" data-toggle="modal"
                                                            data-target="#modalPindah{{ $penduduk->id }}">
                                                            <i class="fe fe-move"></i> Pindah
                                                        </a>
                                                        <a href="#" class="dropdown-item" data-toggle="modal"
                                                            data-target="#modalMeninggal{{ $penduduk->id }}">
                                                            <i class="fe fe-user-x"></i> Meninggal
                                                        </a>
                                                        <form class="d-flex" method="POST"
                                                            action="{{ route('datapenduduk.delete', $penduduk->id) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger dropdown-item"
                                                                onclick="return confirm('anda yakin ingin menghapus data penduduk {{ $penduduk->nama }} ini secara permanen?');event.preventDefault();
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

                {{-- Modals for Pindah and Meninggal --}}
                @foreach ($data_penduduk as $penduduk)
                    {{-- Modal Pindah --}}
                    <div class="modal fade" id="modalPindah{{ $penduduk->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalPindahLabel{{ $penduduk->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPindahLabel{{ $penduduk->id }}">Pindah Penduduk:
                                        {{ $penduduk->nama }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('datapenduduk.update-status', $penduduk->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="PINDAH">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="tanggal_pindah{{ $penduduk->id }}">Tanggal Pindah</label>
                                            <input type="date" class="form-control"
                                                id="tanggal_pindah{{ $penduduk->id }}" name="tanggal_kejadian" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tujuan_pindah{{ $penduduk->id }}">Tujuan Pindah</label>
                                            <input type="text" class="form-control"
                                                id="tujuan_pindah{{ $penduduk->id }}" name="tempat_kejadian"
                                                placeholder="Masukkan tujuan pindah" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alasan_pindah{{ $penduduk->id }}">Alasan Pindah</label>
                                            <input type="text" class="form-control"
                                                id="alasan_pindah{{ $penduduk->id }}" name="alasan"
                                                placeholder="Masukkan alasan pindah" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_pindah{{ $penduduk->id }}">Jenis Pindah</label>
                                            <select class="form-control" id="jenis_pindah{{ $penduduk->id }}"
                                                name="jenis_pindah" required>
                                                <option value="">-- Pilih Jenis Pindah --</option>
                                                <option value="Dalam Kota">Dalam Kota</option>
                                                <option value="Luar Kota">Luar Kota</option>
                                                <option value="Luar Provinsi">Luar Provinsi</option>
                                                <option value="Luar Negeri">Luar Negeri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn" style="background-color: #0dcdbd; color: white;">Pindahkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Meninggal --}}
                    <div class="modal fade" id="modalMeninggal{{ $penduduk->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalMeninggalLabel{{ $penduduk->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalMeninggalLabel{{ $penduduk->id }}">Meninggal:
                                        {{ $penduduk->nama }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('datapenduduk.update-status', $penduduk->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="MENINGGAL">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="tanggal_kematian{{ $penduduk->id }}">Tanggal Kematian</label>
                                            <input type="date" class="form-control"
                                                id="tanggal_kematian{{ $penduduk->id }}" name="tanggal_kejadian"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_kematian{{ $penduduk->id }}">Tempat Kematian</label>
                                            <input type="text" class="form-control"
                                                id="tempat_kematian{{ $penduduk->id }}" name="tempat_kejadian"
                                                placeholder="Masukkan tempat kematian" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sebab_kematian{{ $penduduk->id }}">Sebab Kematian</label>
                                            <input type="text" class="form-control"
                                                id="sebab_kematian{{ $penduduk->id }}" name="alasan"
                                                placeholder="Masukkan sebab kematian" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Tandai Meninggal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
