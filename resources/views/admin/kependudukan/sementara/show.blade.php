@extends('admin.layouts.main', ['title' => 'Detail Penduduk Sementara'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Detail Penduduk Sementara</h2>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a href="{{ route('penduduk-sementara.index') }}" class="btn btn-secondary">
                                        <i class="fe fe-arrow-left"></i> Kembali
                                    </a>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('penduduk-sementara.edit', $sementara) }}"
                                            class="btn btn-warning">
                                            <i class="fe fe-edit"></i> Edit
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Data Pribadi -->
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="card-title mb-0">Data Pribadi</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td width="40%"><strong>NIK</strong></td>
                                                        <td>{{ $sementara->nik }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Nama</strong></td>
                                                        <td>{{ $sementara->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Jenis Kelamin</strong></td>
                                                        <td>{{ $sementara->jenis_kelamin }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tempat/Tanggal Lahir</strong></td>
                                                        <td>{{ $sementara->tempat_lahir }},
                                                            {{ $sementara->tanggal_lahir->format('d/m/Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Usia</strong></td>
                                                        <td>{{ $sementara->usia }} tahun</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Agama</strong></td>
                                                        <td>{{ $sementara->agama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Status Perkawinan</strong></td>
                                                        <td>{{ $sementara->status_perkawinan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Pendidikan Terakhir</strong></td>
                                                        <td>{{ $sementara->pendidikan_terakhir }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Pekerjaan</strong></td>
                                                        <td>{{ $sementara->jenis_pekerjaan }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Domisili -->
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="card-title mb-0">Data Domisili</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td width="40%"><strong>Alamat Asal</strong></td>
                                                        <td>{{ $sementara->alamat_asal }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Alamat Sementara</strong></td>
                                                        <td>{{ $sementara->alamat_sementara }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tujuan Tinggal</strong></td>
                                                        <td>{{ $sementara->tujuan_tinggal }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Estimasi Waktu</strong></td>
                                                        <td>{{ $sementara->estimasi_waktu }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dokumen -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                            <div class="card-header bg-info text-white">
                                                <h5 class="card-title mb-0">Dokumen Pendukung</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @if ($sementara->ktp_path)
                                                        <div class="col-md-3 text-center">
                                                            <label>KTP-el</label><br>
                                                            <a href="{{ Storage::url($sementara->ktp_path) }}"
                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="fe fe-file"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if ($sementara->kk_path)
                                                        <div class="col-md-3 text-center">
                                                            <label>Kartu Keluarga</label><br>
                                                            <a href="{{ Storage::url($sementara->kk_path) }}"
                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="fe fe-file"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if ($sementara->surat_pengantar_path)
                                                        <div class="col-md-3 text-center">
                                                            <label>Surat Pengantar</label><br>
                                                            <a href="{{ Storage::url($sementara->surat_pengantar_path) }}"
                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="fe fe-file"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if ($sementara->pas_foto_path)
                                                        <div class="col-md-3 text-center">
                                                            <label>Pas Foto</label><br>
                                                            <a href="{{ Storage::url($sementara->pas_foto_path) }}"
                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="fe fe-image"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <strong>Status:</strong>
                                                    <span
                                                        class="ml-2 badge {{ $sementara->status ? 'badge-success' : 'badge-secondary' }} badge-pill">
                                                        {{ $sementara->status ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </div>
                                                <small class="text-muted">Dicatat pada:
                                                    {{ $sementara->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection