@extends('admin.layouts.main')

@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection

@section('main')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 text-gray-800 mb-0">📄 Dokumen Desa</h1>
            <small class="text-muted">Kelola seluruh dokumen desa di sini</small>
        </div>
        <a href="{{ route('admin.dokumen.create') }}" class="btn shadow-sm" style="background-color: #0dcdbd; color: white;">
            <i class="fas fa-plus mr-1"></i> Tambah Dokumen
        </a>
    </div>

    {{-- Alert --}}
    @foreach (['success' => 'success', 'error' => 'danger'] as $key => $type)
        @if (session($key))
            <div class="alert alert-{{ $type }} alert-dismissible fade show">
                {{ session($key) }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
    @endforeach

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-folder-open mr-1"></i> Daftar Dokumen
            </h6>
        </div>

        <div class="card-body p-0">
            @if($dokumens->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Dokumen</th>
                            <th width="15%">Jenis</th>
                            <th width="18%">File</th>
                            <th width="10%">Ukuran</th>
                            <th width="10%" class="text-center">Download</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumens as $index => $dokumen)
                        <tr>
                            <td class="text-center">
                                {{ $index + 1 + ($dokumens->currentPage() - 1) * $dokumens->perPage() }}
                            </td>

                            <td>
                                <div class="font-weight-bold">{{ $dokumen->nama_dokumen }}</div>
                                @if ($dokumen->deskripsi)
                                    <small class="text-muted">
                                        {{ Str::limit($dokumen->deskripsi, 60) }}
                                    </small>
                                @endif
                            </td>

                            <td>
                                <span class="badge px-2 py-1 text-white"
                                      style="background-color: {{ $dokumen->jenisDokumen->warna ?? '#0dcdbd' }}">
                                    <i class="{{ $dokumen->jenisDokumen->icon ?? 'bi bi-file-earmark' }} mr-1"></i>
                                    {{ $dokumen->jenisDokumen->nama_jenis ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <i class="fas fa-file-alt text-secondary mr-1"></i>
                                <span title="{{ $dokumen->nama_file_asli }}">
                                    {{ Str::limit($dokumen->nama_file_asli, 30) }}
                                </span>
                            </td>

                            <td>{{ $dokumen->ukuran_file_formatted }}</td>

                            <td class="text-center">
                                <span class="badge badge-info">
                                    <i class="fas fa-download mr-1"></i>
                                    {{ $dokumen->formatted_download_count }}
                                </span>
                            </td>

                            <td class="text-center">
                                @if ($dokumen->is_published)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Publish
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-clock"></i> Draft
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.dokumen.show', $dokumen->id) }}"
                                   class="btn btn-secondary btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}"
                                   class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.dokumen.download', $dokumen->id) }}"
                                   class="btn btn-info btn-sm" title="Download" target="_blank">
                                    <i class="fas fa-download"></i>
                                </a>
                                <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-3">
                {{ $dokumens->links() }}
            </div>

            @else
            {{-- Empty State --}}
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-3">Belum ada dokumen yang ditambahkan</p>
                <a href="{{ route('admin.dokumen.create') }}" class="btn" style="background-color: #0dcdbd; color: white;">
                    <i class="fas fa-plus"></i> Tambah Dokumen
                </a>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
