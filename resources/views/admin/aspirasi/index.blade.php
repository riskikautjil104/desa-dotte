{{-- resources/views/admin/aspirasi/index.blade.php --}}
@extends('admin.layouts.main',['title' => 'Manajemen Aspirasi Warga'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Manajemen Aspirasi Warga</h2>
                <p class="card-text">Kelola dan tanggapi aspirasi dari warga</p>

                <!-- Statistics Cards -->
                <div class="row my-4">
                    <div class="col-md-3">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="h2 mb-0">{{ \App\Models\Aspirasi::count() }}</span>
                                        <p class="small text-muted mb-0">Total Aspirasi</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-message-square text-muted"></span>
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
                                        <span class="h2 mb-0">{{ \App\Models\Aspirasi::status('baru')->count() }}</span>
                                        <p class="small text-muted mb-0">Aspirasi Baru</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-alert-circle text-primary"></span>
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
                                        <span class="h2 mb-0">{{ \App\Models\Aspirasi::status('diproses')->count() }}</span>
                                        <p class="small text-muted mb-0">Dalam Proses</p>
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
                                        <span class="h2 mb-0">{{ \App\Models\Aspirasi::status('selesai')->count() }}</span>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fe fe-alert-circle"></i> {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <strong class="card-title">Daftar Aspirasi</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter & Search -->
                                <div class="card-body border-bottom">
                                    <form method="GET" action="{{ route('admin.aspirasi.index') }}" class="form-inline">
                                        <div class="form-group mr-2 mb-2">
                                            <input type="text" name="search" class="form-control" 
                                                   placeholder="Cari aspirasi..." value="{{ request('search') }}">
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="kategori" class="form-control">
                                                <option value="">Semua Kategori</option>
                                                <option value="infrastruktur" {{ request('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                                <option value="pendidikan" {{ request('kategori') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                                <option value="kesehatan" {{ request('kategori') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                                <option value="ekonomi" {{ request('kategori') == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                                <option value="sosial" {{ request('kategori') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                                                <option value="lingkungan" {{ request('kategori') == 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                                <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="status" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Dalam Proses</option>
                                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">
                                            <i class="fe fe-search"></i> Cari
                                        </button>
                                        @if(request('search') || request('kategori') || request('status'))
                                        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-secondary mb-2 ml-2">
                                            <i class="fe fe-x"></i> Reset
                                        </a>
                                        @endif
                                    </form>
                                </div>

                                <!-- Table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th width="5%"><strong>#</strong></th>
                                            <th width="20%"><strong>Aspirasi</strong></th>
                                            <th width="15%"><strong>Pengirim</strong></th>
                                            <th width="10%"><strong>Kategori</strong></th>
                                            <th width="10%"><strong>Status</strong></th>
                                            <th width="8%"><strong>Votes</strong></th>
                                            <th width="8%"><strong>Views</strong></th>
                                            <th width="12%"><strong>Tanggal</strong></th>
                                            <th width="12%"><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($aspirasi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($aspirasi->currentPage() - 1) * $aspirasi->perPage() }}</td>
                                            <td>
                                                <strong>{{ Str::limit($item->judul, 40) }}</strong>
                                                <br>
                                                <small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                                @if($item->foto)
                                                <br>
                                                <span class="badge badge-info badge-sm mt-1">
                                                    <i class="fe fe-image"></i> Ada Foto
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->nama }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fe fe-phone"></i> {{ $item->no_hp }}
                                                </small>
                                                @if($item->email)
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fe fe-mail"></i> {{ Str::limit($item->email, 20) }}
                                                </small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $item->kategori_label }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->status == 'baru')
                                                <span class="badge badge-primary">Baru</span>
                                                @elseif($item->status == 'diproses')
                                                <span class="badge badge-warning">Dalam Proses</span>
                                                @elseif($item->status == 'selesai')
                                                <span class="badge badge-success">Selesai</span>
                                                @else
                                                <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fe fe-thumbs-up text-primary"></i> {{ $item->votes }}
                                            </td>
                                            <td>
                                                <i class="fe fe-eye text-muted"></i> {{ $item->views }}
                                            </td>
                                            <td>
                                                <small>{{ $item->created_at->format('d M Y') }}</small>
                                                <br>
                                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm dropdown-toggle more-horizontal" 
                                                        type="button" 
                                                        data-toggle="dropdown" 
                                                        aria-haspopup="true" 
                                                        aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" 
                                                       class="dropdown-item"
                                                       onclick="viewDetail({{ $item->id }}); return false;">
                                                        <i class="fe fe-eye"></i> Detail
                                                    </a>
                                                    <a href="#" 
                                                       class="dropdown-item"
                                                       onclick="updateStatus({{ $item->id }}); return false;">
                                                        <i class="fe fe-edit"></i> Update Status
                                                    </a>
                                                    <a href="{{ route('frontend.aspirasi.show', $item->id) }}" 
                                                       class="dropdown-item"
                                                       target="_blank">
                                                        <i class="fe fe-external-link"></i> Lihat di Frontend
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form method="POST" 
                                                          action="{{ route('admin.aspirasi.destroy', $item->id) }}"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" 
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                                            <i class="fe fe-trash-2"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fe fe-inbox fe-48 text-muted mb-3"></i>
                                                <p class="text-muted">Belum ada aspirasi dari warga</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                @if($aspirasi->hasPages())
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        Menampilkan {{ $aspirasi->firstItem() }} - {{ $aspirasi->lastItem() }} dari {{ $aspirasi->total() }} data
                                    </span>
                                    {{ $aspirasi->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Aspirasi -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Aspirasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detailContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
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
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Aspirasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="statusForm">
                    <div class="modal-body">
                        <input type="hidden" id="aspirasi_id" name="aspirasi_id">
                        
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="baru">Baru</option>
                                <option value="diproses">Dalam Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggapan">Tanggapan</label>
                            <textarea class="form-control" id="tanggapan" name="tanggapan" rows="4" 
                                      placeholder="Berikan tanggapan untuk aspirasi ini..."></textarea>
                            <small class="form-text text-muted">Tanggapan akan ditampilkan ke publik</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function viewDetail(id) {
            $('#detailModal').modal('show');
            $('#detailContent').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            `);

            $.ajax({
                url: '/administrator/dashboard/aspirasi/' + id + '/detail',
                method: 'GET',
                success: function(response) {
                    let html = `
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5>${response.aspirasi.judul}</h5>
                                <div class="mb-2">
                                    <span class="badge badge-primary">${response.kategori_label}</span>
                                    <span class="badge ${getStatusBadgeClass(response.aspirasi.status)}">${response.status_label}</span>
                                </div>
                            </div>
                        </div>

                        ${response.aspirasi.foto ? `
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <img src="/storage/aspirasi/${response.aspirasi.foto}" 
                                     class="img-fluid rounded" alt="Foto Aspirasi">
                            </div>
                        </div>
                        ` : ''}

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h6>Deskripsi</h6>
                                <p style="white-space: pre-wrap;">${response.aspirasi.deskripsi}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6>Data Pengirim</h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="40%">Nama</td>
                                        <td><strong>${response.aspirasi.nama}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>No HP</td>
                                        <td><strong>${response.aspirasi.no_hp}</strong></td>
                                    </tr>
                                    ${response.aspirasi.email ? `
                                    <tr>
                                        <td>Email</td>
                                        <td><strong>${response.aspirasi.email}</strong></td>
                                    </tr>
                                    ` : ''}
                                    <tr>
                                        <td>Alamat</td>
                                        <td><strong>${response.aspirasi.alamat}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Statistik</h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="40%">Votes</td>
                                        <td><strong>${response.aspirasi.votes}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Views</td>
                                        <td><strong>${response.aspirasi.views}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Dibuat</td>
                                        <td><strong>${formatDate(response.aspirasi.created_at)}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        ${response.aspirasi.tanggapan ? `
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <h6><i class="fe fe-message-square"></i> Tanggapan</h6>
                                    <p class="mb-0" style="white-space: pre-wrap;">${response.aspirasi.tanggapan}</p>
                                    <small class="text-muted">Ditanggapi pada: ${formatDate(response.aspirasi.tanggal_tanggapan)}</small>
                                </div>
                            </div>
                        </div>
                        ` : ''}
                    `;
                    $('#detailContent').html(html);
                },
                error: function() {
                    $('#detailContent').html(`
                        <div class="alert alert-danger">
                            <i class="fe fe-alert-circle"></i> Gagal memuat detail aspirasi
                        </div>
                    `);
                }
            });
        }

        function updateStatus(id) {
            $('#statusModal').modal('show');
            $('#aspirasi_id').val(id);

            // Load current data
            $.ajax({
                url: '/administrator/dashboard/aspirasi/' + id + '/detail',
                method: 'GET',
                success: function(response) {
                    $('#status').val(response.aspirasi.status);
                    $('#tanggapan').val(response.aspirasi.tanggapan || '');
                }
            });
        }

        $('#statusForm').on('submit', function(e) {
            e.preventDefault();
            
            const id = $('#aspirasi_id').val();
            const formData = {
                status: $('#status').val(),
                tanggapan: $('#tanggapan').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '/administrator/dashboard/aspirasi/' + id + '/update-status',
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#statusModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });

        function getStatusBadgeClass(status) {
            const badges = {
                'baru': 'badge-primary',
                'diproses': 'badge-warning',
                'selesai': 'badge-success',
                'ditolak': 'badge-danger'
            };
            return badges[status] || 'badge-secondary';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return date.toLocaleDateString('id-ID', options);
        }
    </script>
    @endpush
@endsection