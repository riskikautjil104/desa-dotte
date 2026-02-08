{{-- resources/views/admin/bansos/penerima/index.blade.php --}}
@extends('admin.layouts.main',['title' => 'Data Penerima Bansos'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Data Penerima Bantuan Sosial</h2>
            <p class="card-text">Kelola data penerima bantuan sosial</p>

            <!-- Statistics Cards -->
            <div class="row my-4">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $totalPenerima }}</span>
                                    <p class="small text-muted mb-0">Total Penerima</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-users text-muted"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $penerimaVerified }}</span>
                                    <p class="small text-muted mb-0">Terverifikasi</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-check-circle text-success"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $penerimaMenunggu }}</span>
                                    <p class="small text-muted mb-0">Menunggu Verifikasi</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-clock text-warning"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fe fe-check-circle"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="card-header d-flex justify-content-between">
                                <strong class="card-title">Daftar Penerima Bansos</strong>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                                    <i class="fe fe-plus"></i> Tambah Penerima
                                </button>
                            </div>

                            <!-- Filter & Search -->
                            <div class="card-body border-bottom">
                                <form method="GET" class="form-inline">
                                    <div class="form-group mr-2 mb-2">
                                        <input type="text" name="search" class="form-control" 
                                               placeholder="Cari NIK/Nama/No.KK..." value="{{ request('search') }}">
                                    </div>
                                    <div class="form-group mr-2 mb-2">
                                        <select name="jenis_bansos_id" class="form-control">
                                            <option value="">Semua Jenis Bantuan</option>
                                            @foreach($jenisBansos as $jenis)
                                            <option value="{{ $jenis->id }}" {{ request('jenis_bansos_id') == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->nama_bantuan }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mr-2 mb-2">
                                        <select name="status_verifikasi" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="menunggu" {{ request('status_verifikasi') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="diverifikasi" {{ request('status_verifikasi') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                            <option value="ditolak" {{ request('status_verifikasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">
                                        <i class="fe fe-search"></i> Cari
                                    </button>
                                    @if(request()->hasAny(['search', 'jenis_bansos_id', 'status_verifikasi']))
                                    <a href="{{ route('admin.bansos.penerima.index') }}" class="btn btn-secondary mb-2 ml-2">
                                        <i class="fe fe-x"></i> Reset
                                    </a>
                                    @endif
                                </form>
                            </div>

                            <!-- Table -->
                            <table class="table datatables">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="20%">Penerima</th>
                                        <th width="18%">Jenis Bantuan</th>
                                        <th width="12%">Status Ekonomi</th>
                                        <th width="10%">Tanggungan</th>
                                        <th width="12%">Status</th>
                                        <th width="23%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penerimaBansos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($penerimaBansos->currentPage() - 1) * $penerimaBansos->perPage() }}</td>
                                        <td>
                                            <strong>{{ $item->nama_lengkap }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fe fe-credit-card"></i> {{ $item->nik }}
                                            </small>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fe fe-phone"></i> {{ $item->no_hp ?? '-' }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $item->jenisBansos->nama_bantuan }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $item->status_ekonomi == 'sangat_miskin' ? 'danger' : ($item->status_ekonomi == 'miskin' ? 'warning' : 'info') }}">
                                                {{ $item->status_ekonomi_label }}
                                            </span>
                                        </td>
                                        <td>{{ $item->jumlah_tanggungan }} orang</td>
                                        <td>
                                            <span class="badge badge-{{ $item->status_verifikasi == 'diverifikasi' ? 'success' : ($item->status_verifikasi == 'menunggu' ? 'warning' : 'danger') }}">
                                                {{ $item->status_verifikasi_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="viewDetail({{ $item->id }})">
                                                <i class="fe fe-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success" onclick="verifyPenerima({{ $item->id }})">
                                                <i class="fe fe-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" onclick="editPenerima({{ $item->id }})">
                                                <i class="fe fe-edit"></i>
                                            </button>
                                            <form method="POST" action="{{ route('admin.bansos.penerima.destroy', $item->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fe fe-inbox fe-48 text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada data penerima</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($penerimaBansos->hasPages())
                            <div class="card-footer">
                                {{ $penerimaBansos->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modals akan ditambahkan di comment berikutnya karena terlalu panjang --}}
{{-- Untuk sementara, copy modal dari admin_bansos_pengajuan dan sesuaikan field-nya --}}

@endsection