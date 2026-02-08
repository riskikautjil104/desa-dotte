<?php

namespace App\Http\Controllers;

use App\Models\Datapenduduk;
use App\Models\PendudukKematian;
use App\Models\PendudukPindah;
use App\Models\PendudukSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerkembanganPendudukController extends Controller
{
    /**
     * Display the perkembangan penduduk page
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastYear = Carbon::now()->subMonth()->year;

        // Statistik Penduduk Tetap
        $totalPenduduk = Datapenduduk::count();
        $totalLakiLaki = Datapenduduk::where('jenis_kelamin', 'LAKI-LAKI')->count();
        $totalPerempuan = Datapenduduk::where('jenis_kelamin', 'PEREMPUAN')->count();
        $totalKK = Datapenduduk::distinct('no_kk')->count('no_kk');

        // Statistik Penduduk Sementara
        $totalPendudukSementara = PendudukSementara::where('status', true)->count();
        $sementaraLakiLaki = PendudukSementara::where('status', true)->where('jenis_kelamin', 'LAKI-LAKI')->count();
        $sementaraPerempuan = PendudukSementara::where('status', true)->where('jenis_kelamin', 'PEREMPUAN')->count();

        // Agama Penduduk Sementara
        $sementaraAgama = PendudukSementara::where('status', true)
            ->select('agama', DB::raw('count(*) as count'))
            ->groupBy('agama')
            ->pluck('count', 'agama');

        // Tujuan Tinggal Penduduk Sementara
        $sementaraTujuan = PendudukSementara::where('status', true)
            ->select('tujuan_tinggal', DB::raw('count(*) as count'))
            ->groupBy('tujuan_tinggal')
            ->pluck('count', 'tujuan_tinggal');

        // Perkembangan Penduduk Bulan Ini
        $kelahiranBulanIni = Datapenduduk::whereMonth('tanggal_lahir', $currentMonth)
            ->whereYear('tanggal_lahir', $currentYear)
            ->count();
        $masukBulanIni = Datapenduduk::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $keluarBulanIni = PendudukPindah::whereMonth('tanggal_pindah', $currentMonth)
            ->whereYear('tanggal_pindah', $currentYear)
            ->count();
        $meninggalBulanIni = PendudukKematian::whereMonth('tanggal_kematian', $currentMonth)
            ->whereYear('tanggal_kematian', $currentYear)
            ->count();

        // Perkembangan Penduduk Bulan Lalu
        $kelahiranBulanLalu = Datapenduduk::whereMonth('tanggal_lahir', $lastMonth)
            ->whereYear('tanggal_lahir', $lastYear)
            ->count();
        $masukBulanLalu = Datapenduduk::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastYear)
            ->count();
        $keluarBulanLalu = PendudukPindah::whereMonth('tanggal_pindah', $lastMonth)
            ->whereYear('tanggal_pindah', $lastYear)
            ->count();
        $meninggalBulanLalu = PendudukKematian::whereMonth('tanggal_kematian', $lastMonth)
            ->whereYear('tanggal_kematian', $lastYear)
            ->count();

        // Perkembangan Penduduk 6 Bulan Terakhir
        $perkembanganPenduduk = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $perkembanganPenduduk[] = [
                'month' => $month->format('M Y'),
                'kelahiran' => Datapenduduk::whereMonth('tanggal_lahir', $month->month)
                    ->whereYear('tanggal_lahir', $month->year)
                    ->count(),
                'masuk' => Datapenduduk::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count(),
                'keluar' => PendudukPindah::whereMonth('tanggal_pindah', $month->month)
                    ->whereYear('tanggal_pindah', $month->year)
                    ->count(),
                'meninggal' => PendudukKematian::whereMonth('tanggal_kematian', $month->month)
                    ->whereYear('tanggal_kematian', $month->year)
                    ->count(),
            ];
        }

        // Kelompok Umur Penduduk Sementara
        $sementaraKelompokUmur = [
            '0-5' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 5')->count(),
            '6-11' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 11')->count(),
            '12-17' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 12 AND 17')->count(),
            '18-25' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 25')->count(),
            '26-35' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 26 AND 35')->count(),
            '36-45' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 36 AND 45')->count(),
            '46-55' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 46 AND 55')->count(),
            '56-65' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 56 AND 65')->count(),
            '65+' => PendudukSementara::where('status', true)->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 65')->count(),
        ];

        // Data terbaru penduduk sementara untuk tabel
        $pendudukSementaraTerbaru = PendudukSementara::where('status', true)
            ->latest()
            ->take(10)
            ->get();

        // Rekap semua data
        $rekap = [
            'bulan_ini' => [
                'kelahiran' => $kelahiranBulanIni,
                'masuk' => $masukBulanIni,
                'keluar' => $keluarBulanIni,
                'meninggal' => $meninggalBulanIni,
            ],
            'bulan_lalu' => [
                'kelahiran' => $kelahiranBulanLalu,
                'masuk' => $masukBulanLalu,
                'keluar' => $keluarBulanLalu,
                'meninggal' => $meninggalBulanLalu,
            ],
        ];

        return view('pages.perkembangan-penduduk.index', compact(
            'totalPenduduk',
            'totalLakiLaki',
            'totalPerempuan',
            'totalKK',
            'totalPendudukSementara',
            'sementaraLakiLaki',
            'sementaraPerempuan',
            'sementaraAgama',
            'sementaraTujuan',
            'sementaraKelompokUmur',
            'pendudukSementaraTerbaru',
            'perkembanganPenduduk',
            'rekap'
        ));
    }
}

