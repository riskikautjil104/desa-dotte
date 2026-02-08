{{-- resources/views/admin/bansos/jenis/index.blade.php --}}
@extends('admin.layouts.main',['title' => 'Jenis Bantuan Sosial'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Manajemen Jenis Bantuan Sosial</h2>
            <p class="card-text">Kelola jenis-jenis bantuan sosial yang tersedia</p>

            <!-- Statistics Cards -->
            <div class="row my-4">
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $totalJenis }}</span>
                                    <p class="small text-muted mb-0">Total Jenis</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-package text-muted"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $totalAktif }}</span>
                                    <p class="small text-muted mb-0">Program Aktif</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-check-circle text-success"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $totalPenerima }}</span>
                                    <p class="small text-muted mb-0">Total Penerima</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-users text-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $totalDistribusi }}</span>
                                    <p class="small text-muted mb-0">Total Distribusi</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-truck text-primary"></span>
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
                                <strong class="card-title">Daftar Jenis Bantuan</strong>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                                    <i class="fe fe-plus"></i> Tambah Jenis Bantuan
                                </button>
                            </div>

                            <!-- Filter & Search -->
                            <div class="card-body border-bottom">
                                <form method="GET" class="form-inline">
                                    <div class="form-group mr-2 mb-2">
                                        <input type="text" name="search" class="form-control" 
                                               placeholder="Cari..." value="{{ request('search') }}">
                                    </div>
                                    <div class="form-group mr-2 mb-2">
                                        <select name="kategori" class="form-control">
                                            <option value="">Semua Kategori</option>
                                            <option value="reguler" {{ request('kategori') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                                            <option value="darurat" {{ request('kategori') == 'darurat' ? 'selected' : '' }}>Darurat</option>
                                            <option value="khusus" {{ request('kategori') == 'khusus' ? 'selected' : '' }}>Khusus</option>
                                            <option value="musiman" {{ request('kategori') == 'musiman' ? 'selected' : '' }}>Musiman</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">
                                        <i class="fe fe-search"></i> Cari
                                    </button>
                                    @if(request()->hasAny(['search', 'kategori']))
                                    <a href="{{ route('admin.bansos.jenis.index') }}" class="btn btn-secondary mb-2 ml-2">
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
                                        <th width="15%">Kode</th>
                                        <th width="20%">Nama Bantuan</th>
                                        <th width="12%">Kategori</th>
                                        <th width="12%">Jenis</th>
                                        <th width="12%">Nominal</th>
                                        <th width="10%">Status</th>
                                        <th width="14%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jenisBansos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($jenisBansos->currentPage() - 1) * $jenisBansos->perPage() }}</td>
                                        <td><code>{{ $item->kode_bantuan }}</code></td>
                                        <td>
                                            <strong>{{ $item->nama_bantuan }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $item->sumber_dana_label }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $item->kategori == 'reguler' ? 'primary' : ($item->kategori == 'darurat' ? 'danger' : 'warning') }}">
                                                {{ $item->kategori_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ ucfirst($item->jenis_bantuan) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->nominal_bantuan)
                                            <strong>Rp {{ number_format($item->nominal_bantuan, 0, ',', '.') }}</strong>
                                            @else
                                            <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                            @else
                                            <span class="badge badge-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="viewDetail({{ $item->id }})">
                                                <i class="fe fe-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" onclick="editJenis({{ $item->id }})">
                                                <i class="fe fe-edit"></i>
                                            </button>
                                            <form method="POST" action="{{ route('admin.bansos.jenis.destroy', $item->id) }}" class="d-inline">
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
                                        <td colspan="8" class="text-center py-5">
                                            <i class="fe fe-inbox fe-48 text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada jenis bantuan</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($jenisBansos->hasPages())
                            <div class="card-footer">
                                {{ $jenisBansos->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.bansos.jenis.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Bantuan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Bantuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_bantuan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kode Bantuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kode_bantuan" 
                                   placeholder="Contoh: BLT-001" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="reguler">Reguler</option>
                                <option value="darurat">Darurat</option>
                                <option value="khusus">Khusus</option>
                                <option value="musiman">Musiman</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sumber Dana <span class="text-danger">*</span></label>
                            <select class="form-control" name="sumber_dana" required>
                                <option value="">Pilih Sumber</option>
                                <option value="apbd">APBD Kabupaten</option>
                                <option value="apbn">APBN</option>
                                <option value="desa">APBDes</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jenis Bantuan <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_bantuan" required>
                                <option value="">Pilih Jenis</option>
                                <option value="uang">Uang Tunai</option>
                                <option value="barang">Barang</option>
                                <option value="campuran">Campuran</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nominal Bantuan</label>
                            <input type="number" class="form-control" name="nominal_bantuan" 
                                   placeholder="0" min="0">
                            <small class="text-muted">Kosongkan jika bukan uang</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" 
                                      placeholder="Deskripsi bantuan..."></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked>
                                <label class="custom-control-label" for="is_active">Program Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fe fe-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jenis Bantuan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Bantuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nama_bantuan" name="nama_bantuan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kode Bantuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_kode_bantuan" name="kode_bantuan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" id="edit_kategori" name="kategori" required>
                                <option value="reguler">Reguler</option>
                                <option value="darurat">Darurat</option>
                                <option value="khusus">Khusus</option>
                                <option value="musiman">Musiman</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sumber Dana <span class="text-danger">*</span></label>
                            <select class="form-control" id="edit_sumber_dana" name="sumber_dana" required>
                                <option value="apbd">APBD Kabupaten</option>
                                <option value="apbn">APBN</option>
                                <option value="desa">APBDes</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jenis Bantuan <span class="text-danger">*</span></label>
                            <select class="form-control" id="edit_jenis_bantuan" name="jenis_bantuan" required>
                                <option value="uang">Uang Tunai</option>
                                <option value="barang">Barang</option>
                                <option value="campuran">Campuran</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nominal Bantuan</label>
                            <input type="number" class="form-control" id="edit_nominal_bantuan" name="nominal_bantuan" min="0">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="edit_is_active" name="is_active">
                                <label class="custom-control-label" for="edit_is_active">Program Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fe fe-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Jenis Bantuan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDetailContent">
                <div class="text-center">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function viewDetail(id) {
    $('#modalDetail').modal('show');
    $('#modalDetailContent').html('<div class="text-center"><div class="spinner-border"></div></div>');

    $.get(`/administrator/dashboard/bansos/jenis/${id}`, function(response) {
        if(response.success) {
            const b = response.jenisBansos;
            let html = `
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr><th width="40%">Nama Bantuan</th><td>${b.nama_bantuan}</td></tr>
                            <tr><th>Kode</th><td><code>${b.kode_bantuan}</code></td></tr>
                            <tr><th>Kategori</th><td>${b.kategori_label}</td></tr>
                            <tr><th>Sumber Dana</th><td>${b.sumber_dana_label}</td></tr>
                            <tr><th>Jenis</th><td>${b.jenis_bantuan}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr><th width="40%">Nominal</th><td>${b.nominal_bantuan ? 'Rp ' + parseInt(b.nominal_bantuan).toLocaleString() : '-'}</td></tr>
                            <tr><th>Status</th><td><span class="badge badge-${b.is_active ? 'success' : 'secondary'}">${b.is_active ? 'Aktif' : 'Nonaktif'}</span></td></tr>
                            <tr><th>Jumlah Penerima</th><td>${response.jumlah_penerima} orang</td></tr>
                            <tr><th>Total Distribusi</th><td>Rp ${parseInt(response.total_nominal || 0).toLocaleString()}</td></tr>
                        </table>
                    </div>
                    ${b.deskripsi ? `
                    <div class="col-12 mt-3">
                        <h6>Deskripsi</h6>
                        <p>${b.deskripsi}</p>
                    </div>
                    ` : ''}
                </div>
            `;
            $('#modalDetailContent').html(html);
        }
    });
}

function editJenis(id) {
    $.get(`/administrator/dashboard/bansos/jenis/${id}`, function(response) {
        if(response.success) {
            const b = response.jenisBansos;
            $('#edit_nama_bantuan').val(b.nama_bantuan);
            $('#edit_kode_bantuan').val(b.kode_bantuan);
            $('#edit_kategori').val(b.kategori);
            $('#edit_sumber_dana').val(b.sumber_dana);
            $('#edit_jenis_bantuan').val(b.jenis_bantuan);
            $('#edit_nominal_bantuan').val(b.nominal_bantuan);
            $('#edit_deskripsi').val(b.deskripsi);
            $('#edit_is_active').prop('checked', b.is_active);
            
            $('#formEdit').attr('action', `/administrator/dashboard/bansos/jenis/${id}`);
            $('#modalEdit').modal('show');
        }
    });
}
</script>
@endpush