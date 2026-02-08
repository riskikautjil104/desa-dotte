{{-- resources/views/admin/bansos/distribusi/index.blade.php --}}
@extends('admin.layouts.main',['title' => 'Distribusi Bansos'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Distribusi Bantuan Sosial</h2>
            <p class="card-text">Kelola jadwal dan realisasi distribusi bantuan</p>

            <!-- Statistics Cards -->
            <div class="row my-4">
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $totalDistribusi }}</span>
                                    <p class="small text-muted mb-0">Total Distribusi</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-truck text-muted"></span>
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
                                    <span class="h2 mb-0">{{ $terjadwal }}</span>
                                    <p class="small text-muted mb-0">Terjadwal</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-calendar text-info"></span>
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
                                    <span class="h2 mb-0">{{ $totalDiterima }}</span>
                                    <p class="small text-muted mb-0">Sudah Diterima</p>
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
                                    <span class="h6 mb-0">Rp {{ number_format($totalNominal, 0, ',', '.') }}</span>
                                    <p class="small text-muted mb-0">Total Nominal</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-dollar-sign text-primary"></span>
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
                                <strong class="card-title">Daftar Distribusi Bansos</strong>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                                    <i class="fe fe-plus"></i> Jadwalkan Distribusi
                                </button>
                            </div>

                            <!-- Filter & Search -->
                            <div class="card-body border-bottom">
                                <form method="GET" class="form-inline">
                                    <div class="form-group mr-2 mb-2">
                                        <input type="text" name="periode" class="form-control" 
                                               placeholder="Periode (YYYY-MM)" value="{{ request('periode') }}">
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
                                        <select name="status_penerimaan" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="terjadwal" {{ request('status_penerimaan') == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                                            <option value="diterima" {{ request('status_penerimaan') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                            <option value="ditunda" {{ request('status_penerimaan') == 'ditunda' ? 'selected' : '' }}>Ditunda</option>
                                            <option value="dibatalkan" {{ request('status_penerimaan') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">
                                        <i class="fe fe-search"></i> Cari
                                    </button>
                                    @if(request()->hasAny(['periode', 'jenis_bansos_id', 'status_penerimaan']))
                                    <a href="{{ route('admin.bansos.distribusi.index') }}" class="btn btn-secondary mb-2 ml-2">
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
                                        <th width="18%">Penerima</th>
                                        <th width="15%">Jenis Bantuan</th>
                                        <th width="10%">Periode</th>
                                        <th width="12%">Tgl Distribusi</th>
                                        <th width="12%">Nominal</th>
                                        <th width="10%">Status</th>
                                        <th width="18%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($distribusiBansos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($distribusiBansos->currentPage() - 1) * $distribusiBansos->perPage() }}</td>
                                        <td>
                                            <strong>{{ $item->penerimaBansos->nama_lengkap }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $item->penerimaBansos->nik }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $item->jenisBansos->nama_bantuan }}
                                            </span>
                                        </td>
                                        <td><strong>{{ $item->periode }}</strong></td>
                                        <td>
                                            <small>{{ \Carbon\Carbon::parse($item->tanggal_distribusi)->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            @if($item->nominal_diterima)
                                            <strong>Rp {{ number_format($item->nominal_diterima, 0, ',', '.') }}</strong>
                                            @else
                                            <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $item->status_badge }}">
                                                {{ $item->status_penerimaan_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="viewDetail({{ $item->id }})">
                                                <i class="fe fe-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success" onclick="updateStatus({{ $item->id }})">
                                                <i class="fe fe-check"></i> Update
                                            </button>
                                            <form method="POST" action="{{ route('admin.bansos.distribusi.destroy', $item->id) }}" class="d-inline">
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
                                            <p class="text-muted">Belum ada distribusi</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($distribusiBansos->hasPages())
                            <div class="card-footer">
                                {{ $distribusiBansos->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Distribusi -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.bansos.distribusi.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Jadwalkan Distribusi</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jenis Bantuan <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_bansos_id" id="jenis_bansos_select" required onchange="loadPenerima()">
                                <option value="">Pilih Jenis</option>
                                @foreach($jenisBansos as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->nama_bantuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Penerima <span class="text-danger">*</span></label>
                            <select class="form-control" name="penerima_bansos_id" id="penerima_select" required>
                                <option value="">Pilih penerima dulu</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Periode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="periode" 
                                   placeholder="2024-01 atau 2024-Q1" value="{{ date('Y-m') }}" required>
                            <small class="text-muted">Format: YYYY-MM atau YYYY-QX</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Distribusi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_distribusi" 
                                   value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nominal Diterima</label>
                            <input type="number" class="form-control" name="nominal_diterima" 
                                   placeholder="0" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Petugas</label>
                            <input type="text" class="form-control" name="petugas" 
                                   placeholder="Nama petugas">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Barang yang Diterima (Jika Bukan Uang)</label>
                            <textarea class="form-control" name="barang_diterima" rows="2" 
                                      placeholder="Contoh: Beras 10kg, Minyak 2L"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan" rows="2"></textarea>
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

<!-- Modal Update Status -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formStatus" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Distribusi</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="distribusi_id">
                    
                    <div class="form-group">
                        <label>Status Penerimaan <span class="text-danger">*</span></label>
                        <select class="form-control" name="status_penerimaan" required>
                            <option value="terjadwal">Terjadwal</option>
                            <option value="diterima">Sudah Diterima</option>
                            <option value="ditunda">Ditunda</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Diterima</label>
                        <input type="date" class="form-control" name="tanggal_diterima">
                    </div>

                    <div class="form-group">
                        <label>Bukti Penerimaan (Foto/Scan TTD)</label>
                        <input type="file" class="form-control-file" name="bukti_penerimaan" accept="image/*">
                        <small class="text-muted">Max 2MB</small>
                    </div>

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" name="catatan" rows="2"></textarea>
                    </div>

                    <div id="alertStatus"></div>
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
                <h5 class="modal-title">Detail Distribusi</h5>
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
function loadPenerima() {
    const jenisId = $('#jenis_bansos_select').val();
    if (!jenisId) return;

    $('#penerima_select').html('<option value="">Loading...</option>');

    // Load penerima berdasarkan jenis bantuan
    $.get(`/administrator/dashboard/bansos/penerima?jenis_bansos_id=${jenisId}&ajax=1`, function(data) {
        let options = '<option value="">Pilih Penerima</option>';
        data.forEach(p => {
            options += `<option value="${p.id}">${p.nama_lengkap} (${p.nik})</option>`;
        });
        $('#penerima_select').html(options);
    });
}

function viewDetail(id) {
    $('#modalDetail').modal('show');
    $('#modalDetailContent').html('<div class="text-center"><div class="spinner-border"></div></div>');

    $.get(`/administrator/dashboard/bansos/distribusi/${id}`, function(response) {
        if(response.success) {
            const d = response.distribusi;
            let html = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Data Penerima</h6>
                        <table class="table table-sm">
                            <tr><th width="40%">Nama</th><td>${d.penerima_bansos.nama_lengkap}</td></tr>
                            <tr><th>NIK</th><td>${d.penerima_bansos.nik}</td></tr>
                            <tr><th>No. HP</th><td>${d.penerima_bansos.no_hp || '-'}</td></tr>
                            <tr><th>Alamat</th><td>${d.penerima_bansos.alamat}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Data Distribusi</h6>
                        <table class="table table-sm">
                            <tr><th width="40%">Jenis Bantuan</th><td>${d.jenis_bansos.nama_bantuan}</td></tr>
                            <tr><th>Periode</th><td>${d.periode}</td></tr>
                            <tr><th>Tgl Distribusi</th><td>${new Date(d.tanggal_distribusi).toLocaleDateString('id-ID')}</td></tr>
                            <tr><th>Status</th><td><span class="badge ${d.status_badge}">${d.status_penerimaan_label}</span></td></tr>
                            <tr><th>Petugas</th><td>${d.petugas || '-'}</td></tr>
                        </table>
                    </div>
                    <div class="col-12 mt-3">
                        ${d.nominal_diterima ? `<h6>Nominal: <strong>Rp ${parseInt(d.nominal_diterima).toLocaleString()}</strong></h6>` : ''}
                        ${d.barang_diterima ? `<h6>Barang Diterima</h6><p>${d.barang_diterima}</p>` : ''}
                        ${d.catatan ? `<h6>Catatan</h6><p>${d.catatan}</p>` : ''}
                        ${d.bukti_penerimaan ? `<h6>Bukti Penerimaan</h6><img src="/storage/bansos/bukti/${d.bukti_penerimaan}" class="img-fluid">` : ''}
                    </div>
                </div>
            `;
            $('#modalDetailContent').html(html);
        }
    });
}

function updateStatus(id) {
    $('#modalStatus').modal('show');
    $('#distribusi_id').val(id);
    $('#formStatus')[0].reset();
    $('#alertStatus').html('');
}

$('#formStatus').on('submit', function(e) {
    e.preventDefault();
    const id = $('#distribusi_id').val();
    const formData = new FormData(this);

    $.ajax({
        url: `/administrator/dashboard/bansos/distribusi/${id}/status`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                $('#modalStatus').modal('hide');
                location.reload();
            }
        },
        error: function(xhr) {
            $('#alertStatus').html(`<div class="alert alert-danger">${xhr.responseJSON?.message || 'Terjadi kesalahan'}</div>`);
        }
    });
});
</script>
@endpush