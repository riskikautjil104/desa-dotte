{{-- resources/views/pages/bansos/my-pengajuan.blade.php --}}
@extends('layouts.main', ['title' => 'Pengajuan Saya'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Riwayat Pengajuan Bansos',
        'subtitle' => 'Pantau status pengajuan bantuan sosial Anda',
        'breadcrumb' => 'Pengajuan Saya',
        'showBreadcrumb' => true
    ])
@endsection

<section class="blog py-5">
    <div class="container" data-aos="fade-up">
        
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('frontend.bansos') }}" class="btn btn-secondary">
                <i class="fe fe-arrow-left"></i> Kembali ke Bansos
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card text-center shadow-sm h-100 bg-info text-white">
                    <div class="card-body">
                        <i class="fe fe-file-text fe-32 mb-2"></i>
                        <h4 class="mb-0">{{ $pengajuanSaya->count() }}</h4>
                        <p class="mb-0 small">Total Pengajuan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center shadow-sm h-100 bg-warning text-white">
                    <div class="card-body">
                        <i class="fe fe-clock fe-32 mb-2"></i>
                        <h4 class="mb-0">{{ $pengajuanSaya->where('status_pengajuan', 'menunggu')->count() }}</h4>
                        <p class="mb-0 small">Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center shadow-sm h-100 text-white" style="background-color: #0dcdbd;">
                    <div class="card-body">
                        <i class="fe fe-activity fe-32 mb-2"></i>
                        <h4 class="mb-0">{{ $pengajuanSaya->where('status_pengajuan', 'diverifikasi')->count() }}</h4>
                        <p class="mb-0 small">Diverifikasi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center shadow-sm h-100 bg-success text-white">
                    <div class="card-body">
                        <i class="fe fe-check-circle fe-32 mb-2"></i>
                        <h4 class="mb-0">{{ $pengajuanSaya->where('status_pengajuan', 'disetujui')->count() }}</h4>
                        <p class="mb-0 small">Disetujui</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Pengajuan -->
        <div class="card shadow">
            <div class="card-header text-white" style="background-color: #0dcdbd;">
                <h5 class="mb-0"><i class="fe fe-list"></i> Daftar Pengajuan Bansos Saya</h5>
            </div>
            <div class="card-body">
                @if($pengajuanSaya->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Bantuan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajuanSaya as $index => $pengajuan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $pengajuan->jenisBansos->nama_bantuan }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $pengajuan->jenisBansos->kategori_label }}</small>
                                </td>
                                <td>
                                    {{ $pengajuan->created_at->format('d F Y') }}
                                    <br>
                                    <small class="text-muted">{{ $pengajuan->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td>
                                    <span class="badge {{ $pengajuan->status_badge }} badge-lg">
                                        {{ $pengajuan->status_pengajuan_label }}
                                    </span>
                                    @if($pengajuan->tanggal_verifikasi)
                                    <br>
                                    <small class="text-muted">
                                        Diverifikasi: {{ $pengajuan->tanggal_verifikasi->format('d M Y') }}
                                    </small>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="viewDetail({{ $pengajuan->id }})">
                                        <i class="fe fe-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fe fe-inbox fe-48 text-muted mb-3"></i>
                    <h5 class="text-muted">Anda belum memiliki pengajuan bansos</h5>
                    <p class="text-muted">Silakan ajukan bantuan dari halaman utama</p>
                    <a href="{{ route('frontend.bansos') }}" class="btn mt-3" style="background-color: #0dcdbd; color: white;">
                        <i class="fe fe-plus"></i> Ajukan Bansos
                    </a>
                </div>
                @endif
            </div>
        </div>

    </div>
</section>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #0dcdbd;">
                <h5 class="modal-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDetailContent">
                <div class="text-center py-4">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
function viewDetail(id) {
    const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
    modal.show();
    
    document.getElementById('modalDetailContent').innerHTML = '<div class="text-center py-4"><div class="spinner-border"></div></div>';

    // Get detail via AJAX
    fetch(`/bansos/pengajuan/${id}`)
        .then(response => response.json())
        .then(data => {
            const p = data.pengajuan;
            let html = `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3"><strong>Informasi Pengajuan</strong></h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th width="40%">Jenis Bantuan:</th>
                                <td><span class="badge" style="background-color: #0dcdbd;">${p.jenis_bansos.nama_bantuan}</span></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><span class="badge ${p.status_badge}">${p.status_pengajuan_label}</span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan:</th>
                                <td>${new Date(p.created_at).toLocaleDateString('id-ID', {day: '2-digit', month: 'long', year: 'numeric'})}</td>
                            </tr>
                            ${p.tanggal_verifikasi ? `
                            <tr>
                                <th>Tanggal Verifikasi:</th>
                                <td>${new Date(p.tanggal_verifikasi).toLocaleDateString('id-ID', {day: '2-digit', month: 'long', year: 'numeric'})}</td>
                            </tr>
                            <tr>
                                <th>Verifikator:</th>
                                <td>${p.verifikator || '-'}</td>
                            </tr>
                            ` : ''}
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3"><strong>Data Pemohon</strong></h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th width="40%">Nama:</th>
                                <td>${p.nama_lengkap}</td>
                            </tr>
                            <tr>
                                <th>NIK:</th>
                                <td>${p.nik}</td>
                            </tr>
                            <tr>
                                <th>No. KK:</th>
                                <td>${p.no_kk}</td>
                            </tr>
                            <tr>
                                <th>No. HP:</th>
                                <td>${p.no_hp}</td>
                            </tr>
                            <tr>
                                <th>RT/RW:</th>
                                <td>${p.rt_rw}</td>
                            </tr>
                            <tr>
                                <th>Tanggungan:</th>
                                <td>${p.jumlah_tanggungan} orang</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 mt-3">
                        <h6><strong>Alamat:</strong></h6>
                        <p>${p.alamat}</p>
                        
                        <h6><strong>Alasan Pengajuan:</strong></h6>
                        <p>${p.alasan_pengajuan}</p>
                        
                        ${p.catatan_verifikasi ? `
                        <div class="alert alert-info">
                            <h6><i class="fe fe-info"></i> <strong>Catatan dari Admin:</strong></h6>
                            <p class="mb-0">${p.catatan_verifikasi}</p>
                        </div>
                        ` : ''}
                    </div>
                    <div class="col-12 mt-3">
                        <h6><strong>Dokumen Pendukung:</strong></h6>
                        <div class="row">
                            ${p.foto_ktp ? `
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/storage/bansos/pengajuan/${p.foto_ktp}" class="card-img-top" alt="KTP">
                                    <div class="card-body text-center py-2">
                                        <small><strong>KTP</strong></small>
                                    </div>
                                </div>
                            </div>
                            ` : ''}
                            ${p.foto_kk ? `
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/storage/bansos/pengajuan/${p.foto_kk}" class="card-img-top" alt="KK">
                                    <div class="card-body text-center py-2">
                                        <small><strong>Kartu Keluarga</strong></small>
                                    </div>
                                </div>
                            </div>
                            ` : ''}
                            ${p.foto_rumah ? `
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/storage/bansos/pengajuan/${p.foto_rumah}" class="card-img-top" alt="Rumah">
                                    <div class="card-body text-center py-2">
                                        <small><strong>Foto Rumah</strong></small>
                                    </div>
                                </div>
                            </div>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('modalDetailContent').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('modalDetailContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fe fe-alert-triangle"></i> Gagal memuat detail pengajuan
                </div>
            `;
        });
}
</script>

<style>
.badge-lg {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
}
.fe-48 {
    font-size: 3rem;
}
.fe-32 {
    font-size: 2rem;
}
</style>

@endsection
