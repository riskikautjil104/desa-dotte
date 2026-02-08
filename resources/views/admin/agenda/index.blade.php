@extends('admin.layouts.main',['title' => 'Manajemen Agenda'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Manajemen Agenda</h2>
                <p class="card-text">Kelola agenda dan kegiatan desa</p>

                <!-- Statistics Cards -->
                <div class="row my-4">
                    <div class="col-md-3">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="h2 mb-0">{{ \App\Models\Agenda::count() }}</span>
                                        <p class="small text-muted mb-0">Total Agenda</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-calendar text-muted"></span>
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
                                        <span class="h2 mb-0">{{ \App\Models\Agenda::where('status', 'akan_datang')->count() }}</span>
                                        <p class="small text-muted mb-0">Akan Datang</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-clock" style="color: #0dcdbd;"></span>
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
                                        <span class="h2 mb-0">{{ \App\Models\Agenda::where('status', 'sedang_berlangsung')->count() }}</span>
                                        <p class="small text-muted mb-0">Berlangsung</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-activity text-success"></span>
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
                                        <span class="h2 mb-0">{{ \App\Models\Agenda::where('is_published', true)->count() }}</span>
                                        <p class="small text-muted mb-0">Dipublikasi</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-check-circle text-info"></span>
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
                                            <strong class="card-title">Daftar Agenda</strong>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('admin.agenda.create') }}" class="btn" style="background-color: #0dcdbd; color: white;">
                                                <i class="fe fe-plus-circle fe-16"></i> Tambah Agenda
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter & Search -->
                                <div class="card-body border-bottom">
                                    <form method="GET" action="{{ route('admin.agenda.index') }}" class="form-inline">
                                        <div class="form-group mr-2 mb-2">
                                            <input type="text" name="search" class="form-control" 
                                                   placeholder="Cari agenda..." value="{{ request('search') }}">
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="kategori" class="form-control">
                                                <option value="">Semua Kategori</option>
                                                <option value="umum" {{ request('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                                                <option value="rapat" {{ request('kategori') == 'rapat' ? 'selected' : '' }}>Rapat</option>
                                                <option value="seleksi" {{ request('kategori') == 'seleksi' ? 'selected' : '' }}>Seleksi</option>
                                                <option value="acara_budaya" {{ request('kategori') == 'acara_budaya' ? 'selected' : '' }}>Acara Budaya</option>
                                                <option value="seminar" {{ request('kategori') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="status" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="akan_datang" {{ request('status') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
                                                <option value="sedang_berlangsung" {{ request('status') == 'sedang_berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn mb-2" style="background-color: #0dcdbd; color: white;">
                                            <i class="fe fe-search"></i> Cari
                                        </button>
                                        @if(request('search') || request('kategori') || request('status'))
                                        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary mb-2 ml-2">
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
                                            <th width="20%"><strong>Judul</strong></th>
                                            <th width="15%"><strong>Tanggal</strong></th>
                                            <th width="10%"><strong>Waktu</strong></th>
                                            <th width="12%"><strong>Lokasi</strong></th>
                                            <th width="10%"><strong>Kategori</strong></th>
                                            <th width="10%"><strong>Status</strong></th>
                                            <th width="8%"><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($agenda as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($agenda->currentPage() - 1) * $agenda->perPage() }}</td>
                                            <td>
                                                @if($item->gambar)
                                                <img src="{{ asset('storage/agenda/' . $item->gambar) }}" 
                                                     alt="{{ $item->judul }}" 
                                                     class="avatar-img rounded"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                <div class="avatar avatar-md">
                                                    <span class="avatar-title rounded bg-secondary">
                                                        <i class="fe fe-calendar"></i>
                                                    </span>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ Str::limit($item->judul, 30) }}</strong>
                                                @if(!$item->is_published)
                                                <span class="badge badge-secondary ml-1">Draft</span>
                                                @endif
                                                <br>
                                                @if($item->pembicara)
                                                <small class="text-muted">
                                                    <i class="fe fe-user"></i> {{ Str::limit($item->pembicara, 20) }}
                                                </small>
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fe fe-calendar text-muted"></i>
                                                {{ $item->tanggal_mulai->format('d M Y') }}
                                                @if($item->tanggal_selesai && $item->tanggal_mulai != $item->tanggal_selesai)
                                                <br><small class="text-muted">s/d {{ $item->tanggal_selesai->format('d M Y') }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->jam_mulai)
                                                <small>
                                                    <i class="fe fe-clock text-muted"></i>
                                                    {{ date('H:i', strtotime($item->jam_mulai)) }}
                                                    @if($item->jam_selesai)
                                                    - {{ date('H:i', strtotime($item->jam_selesai)) }}
                                                    @endif
                                                </small>
                                                @else
                                                <small class="text-muted">-</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->lokasi)
                                                <small>
                                                    <i class="fe fe-map-pin text-muted"></i>
                                                    {{ Str::limit($item->lokasi, 20) }}
                                                </small>
                                                @else
                                                <small class="text-muted">-</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge" style="background-color: #0dcdbd;">
                                                    {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->status == 'akan_datang')
                                                <span class="badge badge-info">Akan Datang</span>
                                                @elseif($item->status == 'sedang_berlangsung')
                                                <span class="badge badge-success">Berlangsung</span>
                                                @else
                                                <span class="badge badge-secondary">Selesai</span>
                                                @endif
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fe fe-eye"></i> {{ $item->views }}
                                                </small>
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
                                                    <a href="{{ route('admin.agenda.show', $item->id) }}" 
                                                       class="dropdown-item">
                                                        <i class="fe fe-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('admin.agenda.edit', $item->id) }}" 
                                                       class="dropdown-item">
                                                        <i class="fe fe-edit"></i> Edit
                                                    </a>
                                                    <form method="POST" 
                                                          action="{{ route('admin.agenda.destroy', $item->id) }}"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" 
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                                                            <i class="fe fe-trash-2"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fe fe-calendar fe-48 text-muted mb-3"></i>
                                                <p class="text-muted">Belum ada data agenda</p>
                                                <a href="{{ route('admin.agenda.create') }}" class="btn btn-sm" style="background-color: #0dcdbd; color: white;">
                                                    <i class="fe fe-plus-circle"></i> Tambah Agenda
                                                </a>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                @if($agenda->hasPages())
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        Menampilkan {{ $agenda->firstItem() }} - {{ $agenda->lastItem() }} dari {{ $agenda->total() }} data
                                    </span>
                                    {{ $agenda->links() }}
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
