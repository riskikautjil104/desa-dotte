{{-- resources/views/admin/bansos/laporan/index.blade.php --}}
@extends('admin.layouts.main',['title' => 'Laporan Bansos'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-0 page-title">Laporan Bantuan Sosial</h2>
                    <p class="card-text">Laporan dan statistik distribusi bantuan sosial</p>
                </div>
                <div>
                    <a href="{{ route('admin.bansos.laporan.export') }}" class="btn btn-success">
                        <i class="fe fe-download"></i> Export Excel
                    </a>
                </div>
            </div>

            <!-- Filter -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="GET" class="form-inline">
                                <div class="form-group mr-2 mb-2">
                                    <label class="mr-2">Tahun:</label>
                                    <select name="tahun" class="form-control">
                                        @foreach($tahunList as $thn)
                                        <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>
                                            {{ $thn }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mr-2 mb-2">
                                    <label class="mr-2">Jenis Bantuan:</label>
                                    <select name="jenis_bansos_id" class="form-control">
                                        <option value="">Semua Jenis</option>
                                        @foreach($jenisBansos as $jenis)
                                        <option value="{{ $jenis->id }}" {{ $jenisBansosId == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->nama_bantuan }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">
                                    <i class="fe fe-filter"></i> Filter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-left-primary shadow h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Distribusi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalDistribusi }} kali
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fe fe-truck fe-32 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-left-success shadow h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Penerima
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalPenerima }} orang
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fe fe-users fe-32 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-left-info shadow h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Nominal
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp {{ number_format($totalNominal, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fe fe-dollar-sign fe-32 text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Per Jenis Bantuan -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0">Laporan Per Jenis Bantuan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Bantuan</th>
                                            <th>Kategori</th>
                                            <th>Jumlah Distribusi</th>
                                            <th>Jumlah Penerima</th>
                                            <th>Total Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dataPerJenis as $index => $jenis)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $jenis->nama_bantuan }}</strong></td>
                                            <td>
                                                <span class="badge badge-{{ $jenis->kategori == 'reguler' ? 'primary' : 'warning' }}">
                                                    {{ $jenis->kategori_label }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $jenis->distribusi_bansos_count }}</td>
                                            <td class="text-center">{{ $jenis->penerima_bansos_count ?? 0 }}</td>
                                            <td class="text-right">
                                                <strong>Rp {{ number_format($jenis->total_nominal_distribusi ?? 0, 0, ',', '.') }}</strong>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <i class="fe fe-inbox fe-32 text-muted mb-2"></i>
                                                <p class="text-muted mb-0">Belum ada data</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    @if($dataPerJenis->count() > 0)
                                    <tfoot class="font-weight-bold">
                                        <tr class="table-active">
                                            <td colspan="3" class="text-right">TOTAL:</td>
                                            <td class="text-center">{{ $totalDistribusi }}</td>
                                            <td class="text-center">{{ $totalPenerima }}</td>
                                            <td class="text-right">Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Distribusi -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0">Detail Distribusi Tahun {{ $tahun }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableDistribusi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Periode</th>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Jenis Bantuan</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th>Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($distribusi as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $item->periode }}</strong></td>
                                            <td>{{ $item->tanggal_distribusi->format('d/m/Y') }}</td>
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
                                            <td class="text-right">
                                                @if($item->nominal_diterima)
                                                Rp {{ number_format($item->nominal_diterima, 0, ',', '.') }}
                                                @else
                                                <small class="text-muted">-</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $item->status_badge }}">
                                                    {{ $item->status_penerimaan_label }}
                                                </span>
                                            </td>
                                            <td>{{ $item->petugas ?? '-' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <i class="fe fe-inbox fe-32 text-muted mb-2"></i>
                                                <p class="text-muted mb-0">Belum ada distribusi untuk tahun ini</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #0dcdbd !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.card {
    margin-bottom: 1.5rem;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#tableDistribusi').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "order": [[1, "desc"]]
    });
});
</script>
@endpush
