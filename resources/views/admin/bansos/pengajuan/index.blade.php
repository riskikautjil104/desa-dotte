{{-- resources/views/admin/bansos/pengajuan/index.blade.php --}}
@extends('admin.layouts.main',['title' => 'Pengajuan Bansos'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Pengajuan Bantuan Sosial dari Warga</h2>
            <p class="card-text">Kelola dan verifikasi pengajuan bansos dari warga</p>

            <!-- Statistics Cards -->
            <div class="row my-4">
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h2 mb-0">{{ $totalPengajuan }}</span>
                                    <p class="small text-muted mb-0">Total Pengajuan</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-file-text text-muted"></span>
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
                                    <span class="h2 mb-0">{{ $menunggu }}</span>
                                    <p class="small text-muted mb-0">Menunggu</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-clock text-warning"></span>
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
                                    <span class="h2 mb-0">{{ $disetujui }}</span>
                                    <p class="small text-muted mb-0">Disetujui</p>
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
                                    <span class="h2 mb-0">{{ $ditolak }}</span>
                                    <p class="small text-muted mb-0">Ditolak</p>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 fe-x-circle text-danger"></span>
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

                            <div class="card-header">
                                <strong class="card-title">Daftar Pengajuan Bansos</strong>
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
                                        <select name="status_pengajuan" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="menunggu" {{ request('status_pengajuan') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="diverifikasi" {{ request('status_pengajuan') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                            <option value="disetujui" {{ request('status_pengajuan') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="ditolak" {{ request('status_pengajuan') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">
                                        <i class="fe fe-search"></i> Cari
                                    </button>
                                    @if(request()->hasAny(['search', 'jenis_bansos_id', 'status_pengajuan']))
                                    <a href="{{ route('admin.bansos.pengajuan.index') }}" class="btn btn-secondary mb-2 ml-2">
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
                                        <th width="20%">Pemohon</th>
                                        <th width="18%">Jenis Bantuan</th>
                                        <th width="12%">Status</th>
                                        <th width="12%">Tanggal Pengajuan</th>
                                        <th width="15%">Verifikator</th>
                                        <th width="18%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengajuanBansos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($pengajuanBansos->currentPage() - 1) * $pengajuanBansos->perPage() }}</td>
                                        <td>
                                            <strong>{{ $item->nama_lengkap }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fe fe-credit-card"></i> {{ $item->nik }}
                                            </small>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fe fe-phone"></i> {{ $item->no_hp }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $item->jenisBansos->nama_bantuan }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $item->status_badge }}">
                                                {{ $item->status_pengajuan_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <small>{{ $item->created_at->format('d M Y') }}</small>
                                            <br>
                                            <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            @if($item->verifikator)
                                            <small>{{ $item->verifikator }}</small>
                                            <br>
                                            <small class="text-muted">{{ $item->tanggal_verifikasi ? $item->tanggal_verifikasi->format('d M Y') : '' }}</small>
                                            @else
                                            <small class="text-muted">Belum diverifikasi</small>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="viewDetail({{ $item->id }})">
                                                <i class="fe fe-eye"></i> Detail
                                            </button>
                                            <button class="btn btn-sm btn-primary" onclick="verifyPengajuan({{ $item->id }})">
                                                <i class="fe fe-check-square"></i> Verifikasi
                                            </button>
                                            <form method="POST" action="{{ route('admin.bansos.pengajuan.destroy', $item->id) }}" class="d-inline">
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
                                            <p class="text-muted">Belum ada pengajuan bansos</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($pengajuanBansos->hasPages())
                            <div class="card-footer">
                                {{ $pengajuanBansos->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengajuan Bansos</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDetailContent">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="modalVerify" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formVerify">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pengajuan_id" name="pengajuan_id">
                    
                    <div class="form-group">
                        <label>Status Verifikasi <span class="text-danger">*</span></label>
                        <select class="form-control" name="status_pengajuan" required>
                            <option value="diverifikasi">Sedang Diverifikasi</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Catatan Verifikasi</label>
                        <textarea class="form-control" name="catatan_verifikasi" rows="3"></textarea>
                    </div>

                    <div id="alertVerify"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fe fe-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function viewDetail(id) {
    $('#modalDetail').modal('show');
    $('#modalDetailContent').html('<div class="text-center"><div class="spinner-border"></div></div>');

    $.get(`/administrator/dashboard/bansos/pengajuan/${id}`, function(response) {
        if(response.success) {
            const p = response.pengajuan;
            let html = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Data Pemohon</h6>
                        <table class="table table-sm">
                            <tr><th width="40%">NIK</th><td>${p.nik}</td></tr>
                            <tr><th>Nama</th><td>${p.nama_lengkap}</td></tr>
                            <tr><th>No. KK</th><td>${p.no_kk}</td></tr>
                            <tr><th>No. HP</th><td>${p.no_hp}</td></tr>
                            <tr><th>RT/RW</th><td>${p.rt_rw}</td></tr>
                            <tr><th>Tanggungan</th><td>${p.jumlah_tanggungan} orang</td></tr>
                            <tr><th>Penghasilan</th><td>Rp ${p.penghasilan_perbulan ? parseInt(p.penghasilan_perbulan).toLocaleString() : '0'}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Info Bantuan</h6>
                        <table class="table table-sm">
                            <tr><th width="40%">Jenis Bantuan</th><td>${p.jenis_bansos.nama_bantuan}</td></tr>
                            <tr><th>Status</th><td><span class="badge ${p.status_badge}">${p.status_pengajuan_label}</span></td></tr>
                            <tr><th>Tanggal Pengajuan</th><td>${new Date(p.created_at).toLocaleDateString('id-ID')}</td></tr>
                            ${p.tanggal_verifikasi ? `<tr><th>Verifikator</th><td>${p.verifikator}</td></tr>` : ''}
                        </table>
                    </div>
                    <div class="col-12 mt-3">
                        <h6>Alamat</h6>
                        <p>${p.alamat}</p>
                        <h6>Alasan Pengajuan</h6>
                        <p>${p.alasan_pengajuan}</p>
                        ${p.catatan_verifikasi ? `<h6>Catatan Verifikasi</h6><div class="alert alert-info">${p.catatan_verifikasi}</div>` : ''}
                    </div>
                    <div class="col-12 mt-3">
                        <h6>Dokumen</h6>
                        <div class="row">
                            ${p.foto_ktp ? `<div class="col-4"><a href="/storage/bansos/pengajuan/${p.foto_ktp}" target="_blank"><img src="/storage/bansos/pengajuan/${p.foto_ktp}" class="img-fluid"><p class="text-center small">KTP</p></a></div>` : ''}
                            ${p.foto_kk ? `<div class="col-4"><a href="/storage/bansos/pengajuan/${p.foto_kk}" target="_blank"><img src="/storage/bansos/pengajuan/${p.foto_kk}" class="img-fluid"><p class="text-center small">KK</p></a></div>` : ''}
                            ${p.foto_rumah ? `<div class="col-4"><a href="/storage/bansos/pengajuan/${p.foto_rumah}" target="_blank"><img src="/storage/bansos/pengajuan/${p.foto_rumah}" class="img-fluid"><p class="text-center small">Rumah</p></a></div>` : ''}
                        </div>
                    </div>
                </div>
            `;
            $('#modalDetailContent').html(html);
        }
    });
}

function verifyPengajuan(id) {
    $('#modalVerify').modal('show');
    $('#pengajuan_id').val(id);
    $('#formVerify')[0].reset();
    $('#alertVerify').html('');
}

$('#formVerify').on('submit', function(e) {
    e.preventDefault();
    const id = $('#pengajuan_id').val();
    const formData = $(this).serialize();

    $.post(`/administrator/dashboard/bansos/pengajuan/${id}/verify`, formData, function(response) {
        if(response.success) {
            $('#modalVerify').modal('hide');
            location.reload();
        }
    }).fail(function(xhr) {
        $('#alertVerify').html(`<div class="alert alert-danger">${xhr.responseJSON.message || 'Terjadi kesalahan'}</div>`);
    });
});
</script>
@endpush