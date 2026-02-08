@extends('admin.layouts.main',['title' => 'Manajemen UMKM'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Manajemen UMKM</h2>
                <p class="card-text">Kelola data UMKM desa</p>

                <!-- Statistics Cards -->
                <div class="row my-4">
                    <div class="col-md-3">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="h2 mb-0">{{ \App\Models\UMKM::count() }}</span>
                                        <p class="small text-muted mb-0">Total UMKM</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-shopping-bag text-muted"></span>
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
                                        <span class="h2 mb-0">{{ \App\Models\UMKM::where('status', 'aktif')->count() }}</span>
                                        <p class="small text-muted mb-0">UMKM Aktif</p>
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
                                        <span class="h2 mb-0">{{ \App\Models\UMKM::where('status', 'verifikasi')->count() }}</span>
                                        <p class="small text-muted mb-0">Verifikasi</p>
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
                                        <span class="h2 mb-0">{{ \App\Models\UMKM::where('is_featured', true)->count() }}</span>
                                        <p class="small text-muted mb-0">Featured</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-star text-primary"></span>
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
                                            <strong class="card-title">Daftar UMKM</strong>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary">
                                                <i class="fe fe-plus-circle fe-16"></i> Tambah UMKM
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter & Search -->
                                <div class="card-body border-bottom">
                                    <form method="GET" action="{{ route('admin.umkm.index') }}" class="form-inline">
                                        <div class="form-group mr-2 mb-2">
                                            <input type="text" name="search" class="form-control" 
                                                   placeholder="Cari UMKM..." value="{{ request('search') }}">
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="kategori" class="form-control">
                                                <option value="">Semua Kategori</option>
                                                <option value="makanan" {{ request('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                                <option value="minuman" {{ request('kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                                <option value="fashion" {{ request('kategori') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                                <option value="jasa" {{ request('kategori') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                                                <option value="kerajinan" {{ request('kategori') == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                                <option value="teknologi" {{ request('kategori') == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                                                <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="status" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                                <option value="verifikasi" {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">
                                            <i class="fe fe-search"></i> Cari
                                        </button>
                                        @if(request('search') || request('kategori') || request('status'))
                                        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary mb-2 ml-2">
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
                                            <th width="10%"><strong>Gambar</strong></th>
                                            <th width="20%"><strong>Nama Usaha</strong></th>
                                            <th width="15%"><strong>Pemilik</strong></th>
                                            <th width="10%"><strong>Kategori</strong></th>
                                            <th width="10%"><strong>Kontak</strong></th>
                                            <th width="10%"><strong>Status</strong></th>
                                            <th width="8%"><strong>Views</strong></th>
                                            <th width="12%"><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($umkm as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($umkm->currentPage() - 1) * $umkm->perPage() }}</td>
                                            <td>
                                                @if($item->gambar_utama)
                                                <img src="{{ asset('storage/umkm/' . $item->gambar_utama) }}" 
                                                     alt="{{ $item->nama_usaha }}" 
                                                     class="avatar-img rounded"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                <div class="avatar avatar-md">
                                                    <span class="avatar-title rounded bg-secondary">
                                                        <i class="fe fe-shopping-bag"></i>
                                                    </span>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->nama_usaha }}</strong>
                                                @if($item->is_featured)
                                                <span class="badge badge-warning ml-1">
                                                    <i class="fe fe-star"></i> Featured
                                                </span>
                                                @endif
                                            </td>
                                            <td>{{ $item->pemilik }}</td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ ucfirst($item->kategori) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $item->no_hp }}</small>
                                                @if($item->email)
                                                <br><small class="text-muted">{{ Str::limit($item->email, 15) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status == 'aktif')
                                                <span class="badge badge-success">Aktif</span>
                                                @elseif($item->status == 'verifikasi')
                                                <span class="badge badge-warning">Verifikasi</span>
                                                @else
                                                <span class="badge badge-secondary">Non-aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fe fe-eye text-muted"></i> {{ $item->views }}
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
                                                    <a href="{{ route('admin.umkm.show', $item->id) }}" 
                                                       class="dropdown-item">
                                                        <i class="fe fe-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('admin.umkm.edit', $item->id) }}" 
                                                       class="dropdown-item">
                                                        <i class="fe fe-edit"></i> Edit
                                                    </a>
                                                    <form method="POST" 
                                                          action="{{ route('admin.umkm.destroy', $item->id) }}"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" 
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?')">
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
                                                <p class="text-muted">Belum ada data UMKM</p>
                                                <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary btn-sm">
                                                    <i class="fe fe-plus-circle"></i> Tambah UMKM
                                                </a>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                @if($umkm->hasPages())
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        Menampilkan {{ $umkm->firstItem() }} - {{ $umkm->lastItem() }} dari {{ $umkm->total() }} data
                                    </span>
                                    {{ $umkm->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection