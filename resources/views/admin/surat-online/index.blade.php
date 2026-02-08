{{-- resources/views/admin/surat-online/index.blade.php --}}
@extends('admin.layouts.main',['title' => 'Manajemen Surat Online'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Manajemen Surat Online</h2>
                <p class="card-text">Kelola pengajuan surat dari warga</p>

                <!-- Statistics Cards -->
                <div class="row my-4">
                    <div class="col-md-3">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="h2 mb-0">{{ $totalSurat }}</span>
                                        <p class="small text-muted mb-0">Total Surat</p>
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
                                        <span class="h2 mb-0">{{ $suratMenunggu }}</span>
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
                                        <span class="h2 mb-0">{{ $suratDiproses }}</span>
                                        <p class="small text-muted mb-0">Diproses</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-activity text-info"></span>
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
                                        <span class="h2 mb-0">{{ $suratSelesai }}</span>
                                        <p class="small text-muted mb-0">Selesai</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-check-circle text-success"></span>
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
                                <!-- Alert Messages -->
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fe fe-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                @endif

                                <div class="card-header">
                                    <strong class="card-title">Daftar Pengajuan Surat</strong>
                                </div>

                                <!-- Filter & Search -->
                                <div class="card-body border-bottom">
                                    <form method="GET" class="form-inline">
                                        <div class="form-group mr-2 mb-2">
                                            <input type="text" name="search" class="form-control" 
                                                   placeholder="Cari..." value="{{ request('search') }}">
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="jenis_surat" class="form-control">
                                                <option value="">Semua Jenis</option>
                                                <option value="keterangan_tinggal" {{ request('jenis_surat') == 'keterangan_tinggal' ? 'selected' : '' }}>Keterangan Tinggal</option>
                                                <option value="skck" {{ request('jenis_surat') == 'skck' ? 'selected' : '' }}>Pengantar SKCK</option>
                                                <option value="keterangan_usaha" {{ request('jenis_surat') == 'keterangan_usaha' ? 'selected' : '' }}>Keterangan Usaha</option>
                                                <option value="keterangan_tidak_mampu" {{ request('jenis_surat') == 'keterangan_tidak_mampu' ? 'selected' : '' }}>Tidak Mampu</option>
                                                <option value="keterangan_domisili" {{ request('jenis_surat') == 'keterangan_domisili' ? 'selected' : '' }}>Keterangan Domisili</option>
                                                <option value="keterangan_lain" {{ request('jenis_surat') == 'keterangan_lain' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="status" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn mb-2" style="background-color: #0dcdbd; color: white;">
                                            <i class="fe fe-search"></i> Cari
                                        </button>
                                        @if(request()->hasAny(['search', 'jenis_surat', 'status']))
                                        <a href="{{ route('admin.surat-online.index') }}" class="btn btn-secondary mb-2 ml-2">
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
                                            <th width="12%">No. Surat</th>
                                            <th width="18%">Pemohon</th>
                                            <th width="15%">Jenis Surat</th>
                                            <th width="10%">Status</th>
                                            <th width="12%">Tanggal</th>
                                            <th width="10%">File</th>
                                            <th width="18%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($suratOnline as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($suratOnline->currentPage() - 1) * $suratOnline->perPage() }}</td>
                                            <td>
                                                <strong>{{ $item->nomor_surat }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $item->nama_pemohon }}</strong>
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
                                                <span class="badge" style="background-color: #0dcdbd;">
                                                    {{ $item->jenis_surat_label }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->status == 'menunggu')
                                                <span class="badge badge-warning">Menunggu</span>
                                                @elseif($item->status == 'diproses')
                                                <span class="badge badge-info">Diproses</span>
                                                @elseif($item->status == 'selesai')
                                                <span class="badge badge-success">Selesai</span>
                                                @else
                                                <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>{{ $item->created_at->format('d M Y') }}</small>
                                                <br>
                                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                @if($item->file_hasil)
                                                <a href="{{ route('admin.surat-online.download', $item->id) }}" 
                                                   class="btn btn-sm btn-success">
                                                    <i class="fe fe-download"></i>
                                                </a>
                                                @else
                                                <small class="text-muted">Belum ada</small>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="viewDetail({{ $item->id }})">
                                                    <i class="fe fe-eye"></i> Detail
                                                </button>
                                                <button class="btn btn-sm" onclick="updateStatus({{ $item->id }})" style="background-color: #0dcdbd; color: white;">
                                                    <i class="fe fe-edit"></i> Proses
                                                </button>
                                                <form method="POST" action="{{ route('admin.surat-online.destroy', $item->id) }}" class="d-inline">
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
                                                <p class="text-muted">Belum ada pengajuan surat</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                @if($suratOnline->hasPages())
                                <div class="card-footer">
                                    {{ $suratOnline->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Surat -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengajuan Surat</h5>
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

    <!-- Modal Update Status -->
    <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="formStatus" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status Surat</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="surat_id" name="surat_id">
                        
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat_display" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Pemohon</label>
                            <input type="text" class="form-control" id="nama_pemohon_display" readonly>
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="menunggu">Menunggu</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="catatan_admin">Catatan Admin</label>
                            <textarea class="form-control" id="catatan_admin" name="catatan_admin" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="file_hasil">Upload File Hasil (PDF)</label>
                            <input type="file" class="form-control-file" id="file_hasil" name="file_hasil" accept=".pdf">
                            <small class="form-text text-muted">Upload file surat yang sudah jadi (Format: PDF, Max: 2MB)</small>
                        </div>

                        <div id="alertStatus"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn" style="background-color: #0dcdbd; color: white;">
                            <i class="fe fe-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // View Detail
    function viewDetail(id) {
        $('#modalDetail').modal('show');
        $('#modalDetailContent').html(`
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `);

        $.ajax({
            url: `/administrator/dashboard/surat-online/${id}`,
            type: 'GET',
            success: function(response) {
                if(response.success) {
                    const surat = response.surat;
                    let html = `
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="40%">Nomor Surat</th>
                                        <td>${surat.nomor_surat}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pemohon</th>
                                        <td>${surat.nama_pemohon}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>${surat.nik}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>${surat.email || '-'}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <td>${surat.no_hp}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="40%">Jenis Surat</th>
                                        <td><span class="badge" style="background-color: #0dcdbd;">${response.jenis_surat_label}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span class="badge badge-${surat.status == 'menunggu' ? 'warning' : surat.status == 'diproses' ? 'info' : surat.status == 'selesai' ? 'success' : 'danger'}">${response.status_text}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengajuan</th>
                                        <td>${new Date(surat.created_at).toLocaleDateString('id-ID', {day: '2-digit', month: 'long', year: 'numeric'})}</td>
                                    </tr>
                                    ${surat.tanggal_selesai ? `
                                    <tr>
                                        <th>Tanggal Selesai</th>
                                        <td>${new Date(surat.tanggal_selesai).toLocaleDateString('id-ID', {day: '2-digit', month: 'long', year: 'numeric'})}</td>
                                    </tr>
                                    ` : ''}
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h6>Alamat:</h6>
                                <p>${surat.alamat}</p>
                                <h6>Keperluan/Keterangan:</h6>
                                <p>${surat.keterangan}</p>
                                ${surat.catatan_admin ? `
                                <h6>Catatan Admin:</h6>
                                <div class="alert alert-info">${surat.catatan_admin}</div>
                                ` : ''}
                            </div>
                        </div>
                    `;
                    $('#modalDetailContent').html(html);
                } else {
                    $('#modalDetailContent').html('<div class="alert alert-danger">Gagal memuat data</div>');
                }
            },
            error: function() {
                $('#modalDetailContent').html('<div class="alert alert-danger">Terjadi kesalahan</div>');
            }
        });
    }

    // Update Status
    function updateStatus(id) {
        $('#modalStatus').modal('show');
        $('#surat_id').val(id);
        $('#formStatus')[0].reset();
        $('#alertStatus').html('');

        // Load data surat
        $.ajax({
            url: `/administrator/dashboard/surat-online/${id}`,
            type: 'GET',
            success: function(response) {
                if(response.success) {
                    const surat = response.surat;
                    $('#nomor_surat_display').val(surat.nomor_surat);
                    $('#nama_pemohon_display').val(surat.nama_pemohon);
                    $('#status').val(surat.status);
                    $('#catatan_admin').val(surat.catatan_admin || '');
                }
            }
        });
    }

    // Submit Form Status
    $('#formStatus').on('submit', function(e) {
        e.preventDefault();
        
        const id = $('#surat_id').val();
        const formData = new FormData(this);

        $.ajax({
            url: `/administrator/dashboard/surat-online/${id}/status`,
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
                } else {
                    $('#alertStatus').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${response.message}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    `);
                }
            },
            error: function(xhr) {
                let errorMsg = 'Terjadi kesalahan';
                if(xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $('#alertStatus').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${errorMsg}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                `);
            }
        });
    });
</script>
@endpush
