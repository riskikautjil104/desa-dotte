{{-- resources/views/pages/surat-online/detail.blade.php --}}
@extends('layouts.main', ['title' => 'Detail Surat'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Detail Pengajuan Surat',
        'subtitle' => 'Informasi lengkap pengajuan surat Anda',
        'breadcrumb' => 'Detail Surat',
        'showBreadcrumb' => true
    ])
@endsection

<section class="blog py-5">
    <div class="container" data-aos="fade-up">
        
        <div class="row">
            <div class="col-md-8">
                <!-- Informasi Surat -->
                <div class="card shadow mb-4">
                    <div class="card-header text-white" style="background-color: #0dcdbd;">
                        <h5 class="mb-0"><i class="fe fe-file-text"></i> Informasi Pengajuan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Nomor Surat:</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge badge-lg badge-dark">{{ $suratOnline->nomor_surat }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Jenis Surat:</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge" style="background-color: #0dcdbd;">{{ $suratOnline->jenis_surat_label }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Status:</strong>
                            </div>
                            <div class="col-md-8">
                                @if($suratOnline->status == 'menunggu')
                                    <span class="badge badge-warning"><i class="fe fe-clock"></i> Menunggu Verifikasi</span>
                                @elseif($suratOnline->status == 'diproses')
                                    <span class="badge badge-info"><i class="fe fe-activity"></i> Sedang Diproses</span>
                                @elseif($suratOnline->status == 'selesai')
                                    <span class="badge badge-success"><i class="fe fe-check-circle"></i> Selesai</span>
                                @else
                                    <span class="badge badge-danger"><i class="fe fe-x-circle"></i> Ditolak</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Tanggal Pengajuan:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $suratOnline->created_at->format('d F Y, H:i') }} WIB
                            </div>
                        </div>

                        @if($suratOnline->tanggal_selesai)
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Tanggal Selesai:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::parse($suratOnline->tanggal_selesai)->format('d F Y, H:i') }} WIB
                            </div>
                        </div>
                        @endif

                        <hr>

                        <h6 class="mb-3"><strong>Data Pemohon:</strong></h6>
                        
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>Nama Lengkap:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $suratOnline->nama_pemohon }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>NIK:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $suratOnline->nik }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $suratOnline->email ?? '-' }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>No. HP/WhatsApp:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $suratOnline->no_hp }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>Alamat:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $suratOnline->alamat }}
                            </div>
                        </div>

                        <hr>

                        <h6 class="mb-3"><strong>Keperluan/Keterangan:</strong></h6>
                        <p class="text-justify">{{ $suratOnline->keterangan }}</p>

                        @if($suratOnline->catatan_admin)
                        <hr>
                        <div class="alert alert-info">
                            <h6><i class="fe fe-info"></i> <strong>Catatan dari Admin:</strong></h6>
                            <p class="mb-0">{{ $suratOnline->catatan_admin }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Status Timeline -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="mb-0"><i class="fe fe-activity"></i> Timeline Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item {{ $suratOnline->status == 'menunggu' || $suratOnline->status == 'diproses' || $suratOnline->status == 'selesai' ? 'active' : '' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Pengajuan Diterima</h6>
                                    <small>{{ $suratOnline->created_at->format('d M Y, H:i') }}</small>
                                </div>
                            </div>

                            <div class="timeline-item {{ $suratOnline->status == 'diproses' || $suratOnline->status == 'selesai' ? 'active' : '' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Sedang Diproses</h6>
                                    @if($suratOnline->status == 'diproses' || $suratOnline->status == 'selesai')
                                    <small>Surat sedang diproses</small>
                                    @endif
                                </div>
                            </div>

                            <div class="timeline-item {{ $suratOnline->status == 'selesai' ? 'active' : '' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Selesai</h6>
                                    @if($suratOnline->tanggal_selesai)
                                    <small>{{ \Carbon\Carbon::parse($suratOnline->tanggal_selesai)->format('d M Y, H:i') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download File -->
                @if($suratOnline->file_hasil)
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0"><i class="fe fe-download"></i> Unduh Surat</h6>
                    </div>
                    <div class="card-body text-center">
                        <i class="fe fe-file-text fe-48 text-success mb-3"></i>
                        <p class="mb-3">Surat Anda sudah siap!</p>
                        <a href="{{ route('frontend.surat-online.download', $suratOnline->id) }}" 
                           class="btn btn-success btn-block">
                            <i class="fe fe-download"></i> Unduh File PDF
                        </a>
                    </div>
                </div>
                @endif

                <!-- Info Bantuan -->
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fe fe-help-circle"></i> Bantuan</h6>
                    </div>
                    <div class="card-body">
                        <p><small>Jika ada pertanyaan tentang pengajuan surat Anda, silakan hubungi:</small></p>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fe fe-phone text-info"></i> 
                                <small><strong>Telepon:</strong> (021) 1234567</small>
                            </li>
                            <li class="mb-2">
                                <i class="fe fe-mail text-info"></i> 
                                <small><strong>Email:</strong> admin@desaku.id</small>
                            </li>
                            <li>
                                <i class="fe fe-message-square text-info"></i> 
                                <small><strong>WhatsApp:</strong> 08123456789</small>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <a href="{{ route('frontend.surat-online') }}" class="btn btn-secondary">
                        <i class="fe fe-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@include('layouts.footer')

<style>
.badge-lg {
    padding: 0.5rem 1rem;
    font-size: 1rem;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e0e0e0;
}

.timeline-item {
    position: relative;
    padding-bottom: 25px;
    opacity: 0.5;
}

.timeline-item.active {
    opacity: 1;
}

.timeline-marker {
    position: absolute;
    left: -25px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #e0e0e0;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #e0e0e0;
}

.timeline-item.active .timeline-marker {
    background: #28a745;
    box-shadow: 0 0 0 2px #28a745;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.timeline-content small {
    color: #666;
}

.card {
    border: none;
    border-radius: 10px;
}
</style>

@endsection
